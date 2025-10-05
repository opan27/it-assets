<?php

namespace App\Controllers;

use App\Models\MaintenanceModel;
use App\Models\MaintenanceMessageModel;
use App\Models\ProgressModel;
use App\Models\AssetModel;
use App\Models\PicAssetsModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;
use App\Libraries\Notifier;

class Teknisi extends Controller
{
    protected $maintenanceModel;
    protected $messageModel;
    protected $assetModel;
    protected $picModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->maintenanceModel  = new MaintenanceModel();
        $this->messageModel      = new MaintenanceMessageModel();
        $this->assetModel        = new AssetModel();
        $this->picModel          = new PicAssetsModel();
        $this->notificationModel = new NotificationModel();
    }

    /** Dashboard teknisi */
    public function dashboard()
    {
        $teknisiId = session()->get('user_id');

        $data['tickets'] = $this->maintenanceModel
            ->select('
                maintenance.*,
                maintenance.due_date,
                assets.nama_item AS asset_nama,
                assets.kode_asset,
                pegawai_pic.nama AS pic_nama
            ')
            ->join('assets', 'assets.id = maintenance.asset_id', 'left')
            ->join('pic_assets', 'pic_assets.id = maintenance.pic_id', 'left')
            ->join('pegawai AS pegawai_pic', 'pegawai_pic.id = pic_assets.pegawai_id', 'left')
            ->where('maintenance.assigned_to', $teknisiId)
            ->orderBy('maintenance.created_at', 'DESC')
            ->findAll();

        // Notifikasi
        $data['notifCount'] = $this->notificationModel->where('user_id', $teknisiId)
                                                     ->where('is_read', 0)
                                                     ->countAllResults();
        $data['notifications'] = $this->notificationModel->where('user_id', $teknisiId)
                                                        ->orderBy('created_at', 'DESC')
                                                        ->findAll();

        return view('teknisi/dashboard', $data);
    }

    /** Detail tiket teknisi */
    public function detail($id)
    {
        $maintenance = $this->maintenanceModel
            ->select('
                maintenance.*,
                maintenance.due_date,
                assets.nama_item AS asset_nama,
                assets.kode_asset,
                assets.kode_ga,
                assets.spesifikasi,
                entitas.nama AS entitas_nama,
                lokasi.lokasi AS lokasi_nama,
                pegawai_pic.nama AS pic_nama
            ')
            ->join('assets', 'assets.id = maintenance.asset_id', 'left')
            ->join('pic_assets', 'pic_assets.id = maintenance.pic_id', 'left')
            ->join('pegawai AS pegawai_pic', 'pegawai_pic.id = pic_assets.pegawai_id', 'left')
            ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
            ->join('lokasi', 'lokasi.id = assets.lokasi_id', 'left')
            ->where('maintenance.id', $id)
            ->first();

        if (!$maintenance) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Maintenance ID $id tidak ditemukan");
        }

        // Ambil pesan forum
        $messages = $this->messageModel->getMessagesWithSender($id);

        // Ambil progress
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

        return view('teknisi/detail', [
            'maintenance'   => $maintenance,
            'messages'      => $messages,
            'progress'      => $progress,
            'progress_list' => $progress_list
        ]);
    }

    /** Terima tiket */
    public function acceptTicket($ticketId)
    {
        $ticket = $this->maintenanceModel->find($ticketId);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        if ($ticket['assigned_to'] != session()->get('user_id')) {
            return redirect()->back()->with('error', 'Anda bukan teknisi untuk tiket ini.');
        }

        $this->maintenanceModel->update($ticketId, [
            'status'     => 'in_progress',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/teknisi/detail/'.$ticketId)
                         ->with('success', 'Tiket diterima, status sekarang In Progress.');
    }

    /** Update progress / status tiket */
    public function updateStatus()
    {
        $ticketId  = $this->request->getPost('ticket_id');
        $status    = $this->request->getPost('status');
        $deskripsi = $this->request->getPost('deskripsi');
        $fotoFile  = $this->request->getFile('foto');

        if ($status === 'done' && (empty($deskripsi) || !$fotoFile || !$fotoFile->isValid())) {
            return redirect()->back()->with('error', 'Saat selesai, deskripsi & foto wajib diisi.');
        }

        $fotoName = null;
        if ($fotoFile && $fotoFile->isValid()) {
            $fotoName = $fotoFile->getRandomName();
            $fotoFile->move(FCPATH . 'uploads/progress', $fotoName);
        }

        $progressModel = new \App\Models\ProgressModel();
        $progressModel->insert([
            'maintenance_id' => $ticketId,
            'user_id'        => session()->get('user_id'),
            'deskripsi'      => $deskripsi,
            'foto'           => $fotoName,
            'status'         => $status,
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        $this->maintenanceModel->update($ticketId, [
            'status'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($status === 'done') {
            $ticket = $this->maintenanceModel->find($ticketId);
            if ($ticket) {
                $assetId = $ticket['asset_id'];
                $picId   = $ticket['pic_id'];

                $picRow = $this->picModel->find($picId);
                $picActive = false;
                if ($picRow) {
                    $released = $picRow['released_at'] ?? null;
                    $picActive = ($released === null || $released === '' );
                }

                if ($picActive) {
                    $this->assetModel->setStatus($assetId, 'terpakai');
                    $this->picModel->setStatus($picId, 'terpakai');
                } else {
                    $this->assetModel->setStatus($assetId, 'tersedia');
                    $this->picModel->setStatus($picId, 'tersedia');
                }
            }
        }

        // 🔔 Notifikasi realtime ke creator tiket
        $ticket = $this->maintenanceModel->find($ticketId);
        if (!empty($ticket['created_by'])) {
            $message = "Progress tiket #{$ticketId} telah diperbarui oleh teknisi.";

            $this->notificationModel->insert([
                'user_id'    => $ticket['created_by'],
                'role'       => 'admin',
                'message'    => $message,
                'is_read'    => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // realtime push
            $notifier = new Notifier();
            $notifier->sendToUser($ticket['created_by'], $message);
        }

        return redirect()->to('/teknisi/detail/'.$ticketId)
                         ->with('success', 'Progress berhasil diperbarui.');
    }

    /** Kirim pesan */
    public function sendMessage()
    {
        $maintenanceId = $this->request->getPost('maintenance_id');
        $message       = $this->request->getPost('message');
        $senderId      = session()->get('user_id');

        if ($maintenanceId && $message) {
            $this->messageModel->insert([
                'maintenance_id' => $maintenanceId,
                'sender_id'      => $senderId,
                'message'        => $message,
                'created_at'     => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to(base_url("teknisi/detail/$maintenanceId"))
                         ->with('success', 'Pesan terkirim.');
    }

    /** Update progress manual (opsional) */
    public function updateProgress($ticketId)
    {
        $progress = $this->request->getPost('progress');

        $this->maintenanceModel->update($ticketId, [
            'progress'   => $progress,
            'status'     => 'in_progress',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // contoh: admin ID = 1
        $adminId = 1;
        $message = "Tiket #$ticketId diperbarui oleh teknisi.";

        $this->notificationModel->insert([
            'user_id'    => $adminId,
            'role'       => 'admin',
            'message'    => $message,
            'is_read'    => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // realtime push
        $notifier = new Notifier();
        $notifier->sendToUser($adminId, $message);

        return redirect()->back()->with('success', 'Progress tiket berhasil di-update');
    }
}
