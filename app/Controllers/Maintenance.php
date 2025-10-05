<?php

namespace App\Controllers;

use App\Models\MaintenanceModel;
use App\Models\MaintenanceMessageModel;
use App\Models\AssetModel;
use App\Models\UserModel;
use App\Models\PicAssetsModel;
use App\Models\ProgressModel;
use App\Models\NotificationModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Libraries\Notifier;

class Maintenance extends BaseController
{
    protected $maintenanceModel;
    protected $messageModel;
    protected $assetModel;
    protected $userModel;
    protected $picModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->maintenanceModel   = new MaintenanceModel();
        $this->messageModel       = new MaintenanceMessageModel();
        $this->assetModel         = new AssetModel();
        $this->userModel          = new UserModel();
        $this->picModel           = new PicAssetsModel();
        $this->notificationModel  = new NotificationModel();
    }

    /** Dashboard Admin / Index */
    public function index()
    {
        $data['tickets'] = $this->maintenanceModel->getAllWithDetails();

        // Notifikasi
        $userId = session('user_id');
        $data['notifCount'] = $this->notificationModel->where('user_id', $userId)
                                                     ->where('is_read', 0)
                                                     ->countAllResults();
        $data['notifications'] = $this->notificationModel->where('user_id', $userId)
                                                        ->orderBy('created_at', 'DESC')
                                                        ->findAll();

        return view('maintenance/admin/index', $data);
    }

    /** Form create tiket */
    public function create()
    {
        $data['assets']  = $this->assetModel->findAll();
        $data['teknisi'] = $this->userModel->getTeknisiWithPegawai();

        return view('maintenance/admin/create', $data);
    }

    /** Simpan tiket baru */
    public function store()
    {
        $assetId    = $this->request->getPost('asset_id');
        $assignedTo = $this->request->getPost('assigned_to');
        $kendala    = $this->request->getPost('kendala');
        $priority   = $this->request->getPost('priority');

        $pic = $this->picModel->where('asset_id', $assetId)->first();
        if (!$pic) {
            return redirect()->back()->with('error', 'PIC untuk asset ini tidak ditemukan.');
        }

        // Tentukan due_date sesuai prioritas
        $days = 7; // default
        if ($priority === 'high') {
            $days = 2;
        } elseif ($priority === 'medium') {
            $days = 5;
        } elseif ($priority === 'low') {
            $days = 7;
        }
        $dueDate = date('Y-m-d H:i:s', strtotime("+$days days"));

        $this->maintenanceModel->save([
            'asset_id'    => $assetId,
            'pic_id'      => $pic['id'] ?? null,
            'kendala'     => $kendala,
            'created_by'  => session()->get('user_id'),
            'assigned_to' => $assignedTo,
            'priority'    => $priority,
            'due_date'    => $dueDate,
            'status'      => 'pending',
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        // Set asset & PIC status jadi maintenance
        $this->assetModel->setStatus($assetId, 'maintenance');
        $this->picModel->setStatus($pic['id'], 'maintenance');

// 🔔 Notifikasi ke teknisi
    if ($assignedTo) {
    $ticketId = $this->maintenanceModel->getInsertID();

    $this->notificationModel->insert([
        'user_id' => $assignedTo,
        'role'    => 'teknisi',
        'message' => "Anda mendapat tugas maintenance baru: #$ticketId",
        'is_read' => 0
    ]);

    // real-time socket
    $notifier = new Notifier();
    $notifier->sendToUser($assignedTo, "Anda mendapat tugas maintenance baru: #$ticketId");
}


        return redirect()->to('/maintenance')->with('success', 'Tiket berhasil dibuat.');
    }

    /** Assign tiket ke teknisi */
    public function assignTicket()
    {
        $technicianId = $this->request->getPost('technician_id');
        $ticketId     = $this->request->getPost('ticket_id');

        $this->maintenanceModel->update($ticketId, [
            'technician_id' => $technicianId,
            'status'        => 'assigned'
        ]);

        $this->notificationModel->insert([
            'user_id' => $technicianId,
            'role'    => 'teknisi',
            'message' => "Anda mendapat tiket baru ID #$ticketId",
            'is_read' => 0
        ]);

        $notifier = new Notifier();
        $notifier->sendToUser($technicianId, "Anda mendapat tiket baru ID #$ticketId");


        return redirect()->back()->with('success', 'Tiket berhasil di-assign ke teknisi');
    }

    /** Detail tiket */
    public function detail($id)
    {
        $maintenance = $this->maintenanceModel->getWithDetails($id);
        if (!$maintenance) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tiket maintenance tidak ditemukan");
        }

        $messages = $this->messageModel->getMessagesWithSender($id);

        $progressRows = (new ProgressModel())
            ->select('maintenance_progress.*, users.username AS user_nama')
            ->join('users', 'users.id = maintenance_progress.user_id', 'left')
            ->where('maintenance_id', $id)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $progress = [];
        $progress_list = [];
        foreach ($progressRows as $i => $row) {
            $tanggal = date('Y-m-d', strtotime($row['created_at']));
            $progress[] = [
                'id'           => 'Task_' . ($i+1),
                'name'         => $row['status'].' - '.$row['user_nama'].' ('.$row['deskripsi'].')',
                'start'        => $tanggal,
                'end'          => $tanggal,
                'progress'     => 100,
                'custom_class' => strtolower($row['status'])
            ];

            $progress_list[] = [
                'deskripsi'  => $row['deskripsi'] ?? 'Progress ' . ($i+1),
                'created_at' => $row['created_at'],
                'user_nama'  => $row['user_nama'] ?? ($maintenance['assigned_to_nama'] ?? '-'),
                'status'     => $row['status'] ?? $maintenance['status'],
                'foto'       => $row['foto'] ?? null
            ];
        }

        return view('maintenance/admin/detail', [
            'maintenance'   => $maintenance,
            'messages'      => $messages,
            'progress'      => $progress,
            'progress_list' => $progress_list
        ]);
    }

    /** Kirim pesan */
    public function sendMessage()
    {
        $maintenanceId = $this->request->getPost('maintenance_id');
        $message       = $this->request->getPost('message');

        if (!$maintenanceId || !$message) {
            return redirect()->back()->with('error', 'Pesan tidak boleh kosong.');
        }

        $this->messageModel->insert([
            'maintenance_id' => $maintenanceId,
            'sender_id'      => session()->get('user_id'),
            'message'        => $message,
        ]);

        $ticket = $this->maintenanceModel->find($maintenanceId);
        if (!empty($ticket['assigned_to'])) {
            $this->notificationModel->insert([
                'user_id' => $ticket['assigned_to'],
                'message' => "Admin mengirim pesan baru pada tiket #{$maintenanceId}."
            ]);

            // 🔔 real-time ke teknisi
            $notifier = new Notifier();
            $notifier->sendToUser($ticket['assigned_to'], "Admin mengirim pesan baru pada tiket #{$maintenanceId}.");
        }

        return redirect()->to(base_url('maintenance/detail/'.$maintenanceId))
                         ->with('success', 'Pesan berhasil dikirim.');
    }

    /** Update progress teknisi */
    public function updateProgress()
    {
        $maintenanceId = $this->request->getPost('maintenance_id');
        $status        = $this->request->getPost('status');
        $deskripsi     = $this->request->getPost('deskripsi');
        $fotoFile      = $this->request->getFile('foto');

        if ($status === 'done' && (empty($deskripsi) || !$fotoFile || !$fotoFile->isValid())) {
            return redirect()->back()->with('error', 'Saat selesai, deskripsi & foto wajib diisi.');
        }

        $fotoName = null;
        if ($fotoFile && $fotoFile->isValid()) {
            $fotoName = $fotoFile->getRandomName();
            $fotoFile->move('uploads/progress', $fotoName);
        }

        (new ProgressModel())->insert([
            'maintenance_id' => $maintenanceId,
            'deskripsi'      => $deskripsi,
            'foto'           => $fotoName,
            'status'         => $status,
            'sender_id'      => session()->get('user_id'),
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        $this->maintenanceModel->update($maintenanceId, ['status' => $status]);

        if ($status === 'done') {
            $ticket = $this->maintenanceModel->find($maintenanceId);
            $pic = $this->picModel->find($ticket['pic_id']);
            if ($pic) {
                $this->assetModel->setStatus($ticket['asset_id'], 'terpakai');
                $this->picModel->setStatus($ticket['pic_id'], 'terpakai');
            } else {
                $this->assetModel->setStatus($ticket['asset_id'], 'tersedia');
            }
        }

        $ticket = $this->maintenanceModel->find($maintenanceId);
        if (!empty($ticket['created_by'])) {
$this->notificationModel->insert([
    'user_id' => $ticket['assigned_to'],
    'role'    => 'teknisi',
    'message' => "Admin mengirim pesan baru pada tiket #{$maintenanceId}.",
    'is_read' => 0
]);

            // 🔔 real-time ke admin
            $notifier = new Notifier();
$notifier->sendToUser($ticket['assigned_to'], "Admin mengirim pesan baru pada tiket #{$maintenanceId}.");
        }

        return redirect()->back()->with('success', 'Progress berhasil diperbarui.');
    }

    /** Tracking admin */
    public function tracking()
    {
        $tickets = $this->maintenanceModel
            ->select('maintenance.*, assets.nama_item AS asset_nama, pegawai_pic.nama AS pic_nama')
            ->join('assets', 'assets.id = maintenance.asset_id', 'left')
            ->join('pic_assets', 'pic_assets.id = maintenance.pic_id', 'left')
            ->join('pegawai AS pegawai_pic', 'pegawai_pic.id = pic_assets.pegawai_id', 'left')
            ->orderBy('maintenance.created_at', 'DESC')
            ->findAll();

        return view('maintenance/admin/tracking', [
            'tickets' => $tickets
        ]);
    }

    public function getAssetDetail($id)
    {
        $asset = $this->assetModel
            ->select('assets.*, pic_assets.id as pic_id, pegawai.nama as pic_nama')
            ->join('pic_assets', 'pic_assets.asset_id = assets.id', 'left')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id', 'left')
            ->where('assets.id', $id)
            ->first();

        if (!$asset) {
            return $this->response->setJSON(['error' => 'Asset tidak ditemukan']);
        }

        return $this->response->setJSON([
            'kode_asset'  => $asset['kode_asset'],
            'kode_ga'     => $asset['kode_ga'] ?? '-',
            'nama_item'   => $asset['nama_item'],
            'spesifikasi' => $asset['spesifikasi'] ?? '-',
            'status'      => $asset['status'],
            'pic_nama'    => $asset['pic_nama'] ?? '-'
        ]);
    }

    public function downloadReport($id)
    {
        $maintenance = $this->maintenanceModel->getWithDetails($id);
        if (!$maintenance) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tiket tidak ditemukan");
        }

        $messages = $this->messageModel->getMessagesWithSender($id);
        $progressRows = (new ProgressModel())
            ->select('maintenance_progress.*, users.username AS user_nama')
            ->join('users', 'users.id = maintenance_progress.user_id', 'left')
            ->where('maintenance_id', $id)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $progress_list = [];
        foreach ($progressRows as $i => $row) {
            $progress_list[] = [
                'deskripsi'  => $row['deskripsi'] ?? '-',
                'created_at' => $row['created_at'],
                'user_nama'  => $row['user_nama'] ?? ($maintenance['assigned_to_nama'] ?? '-'),
                'status'     => $row['status'] ?? $maintenance['status'],
                'foto'       => $row['foto'] ?? null
            ];
        }

        $html = view('maintenance/admin/report_pdf', [
            'maintenance'   => $maintenance,
            'progress_list' => $progress_list,
            'messages'      => $messages
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Laporan-Maintenance-{$id}.pdf", ["Attachment" => true]);
    }

    public function assignAsset($maintenanceId)
{
    $teknisiId = $this->request->getPost('teknisi_id');

    // update tiket -> assign ke teknisi
    $this->maintenanceModel->update($maintenanceId, [
        'assigned_to' => $teknisiId,
        'status'      => 'assigned'
    ]);

    // ambil data teknisi
    $technician = $this->userModel->find($teknisiId);
    $admin      = $this->userModel->find(session()->get('user_id')); // admin yg assign
    $ticket     = $this->maintenanceModel->find($maintenanceId);

    if ($technician && !empty($technician['email'])) {
        // kirim email ke teknisi
        $email = \Config\Services::email();
        $email->setFrom('it-support@namadomain.com', 'Helpdesk IT');
        $email->setTo($technician['email']);
        $email->setSubject("Tiket Baru Ditugaskan: #" . $maintenanceId);
        $email->setMessage("
            Halo {$technician['name']},<br><br>
            Anda telah ditugaskan untuk menangani tiket berikut:<br><br>
            <strong>ID Tiket:</strong> #{$maintenanceId}<br>
            <strong>Judul:</strong> {$ticket['title']} <br>
            <strong>Deskripsi:</strong> {$ticket['description']} <br>
            <strong>Ditugaskan oleh:</strong> {$admin['name']} <br><br>
            Silakan login ke sistem untuk detail lebih lanjut.<br><br>
            Terima kasih,<br>
            Tim IT Support
        ");

        if (!$email->send()) {
            log_message('error', 'Gagal kirim email assign tiket ke teknisi: ' . $technician['email']);
        }
    }

    return redirect()->back()->with('success', 'Tiket berhasil di-assign ke teknisi.');
}

}
