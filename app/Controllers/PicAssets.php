<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AssetModel;
use App\Models\PicAssetsModel;
use App\Models\ActivityModel;
use App\Models\MaintenanceModel;
use App\Models\EntitasModel;
use App\Models\BeritaAcaraModel;
use PhpOffice\PhpWord\TemplateProcessor;

class PicAssets extends BaseController
{
    protected $pegawaiModel;
    protected $assetModel;
    protected $picAssetsModel;
    protected $activityModel;
    protected $maintenanceModel;
    protected $entitasModel;
    protected $beritaAcaraModel;

    public function __construct()
    {
        $this->pegawaiModel     = new PegawaiModel();
        $this->assetModel       = new AssetModel();
        $this->picAssetsModel   = new PicAssetsModel();
        $this->activityModel    = new ActivityModel();
        $this->maintenanceModel = new MaintenanceModel();
        $this->entitasModel     = new EntitasModel();
        $this->beritaAcaraModel = new BeritaAcaraModel();
    }

    /**
     * List data PIC Assets
     */
    public function index()
    {
        $status      = $this->request->getGet('status');
        $keyword     = $this->request->getGet('keyword');
        $entitas_id  = $this->request->getGet('entitas_id');

        $builder = $this->picAssetsModel
            ->select(
                'pic_assets.id,
                pegawai.nama AS nama_pegawai,
                pegawai.jabatan AS jabatan_pegawai,
                assets.id AS asset_id,
                assets.nama_item AS nama_asset,
                assets.kode_asset,
                assets.kode_ga,
                assets.spesifikasi,
                assets.status AS asset_status,
                entitas.nama AS nama_entitas,
                pic_assets.assigned_at'
            )
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id', 'left')
            ->join('assets', 'assets.id = pic_assets.asset_id', 'left')
            ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
            ->where('pic_assets.released_at IS NULL');

        if ($status) {
            $builder->where('assets.status', $status);
        }

        if ($entitas_id) {
            $builder->where('assets.entitas_id', $entitas_id);
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('pegawai.nama', $keyword)
                ->orLike('assets.nama_item', $keyword)
                ->orLike('assets.kode_asset', $keyword)
                ->orLike('assets.kode_ga', $keyword)
                ->orLike('entitas.nama', $keyword)
                ->groupEnd();
        }

        $pic = $builder->orderBy('pic_assets.assigned_at', 'DESC')->findAll();

        $assets = $this->assetModel
            ->where('status', 'tersedia')
            ->orderBy('id', 'DESC')
            ->findAll();

        $assignedPegawai = $this->picAssetsModel
            ->select('pegawai_id')
            ->where('released_at', null)
            ->findAll();
        $assignedIds = array_column($assignedPegawai, 'pegawai_id');

        if (!empty($assignedIds)) {
            $pegawai = $this->pegawaiModel
                ->whereNotIn('id', $assignedIds)
                ->findAll();
        } else {
            $pegawai = $this->pegawaiModel->findAll();
        }

        $entitas = $this->entitasModel->findAll();

        $data = [
            'pegawai'    => $pegawai,
            'assets'     => $assets,
            'pic'        => $pic,
            'status'     => $status,
            'keyword'    => $keyword,
            'entitas'    => $entitas,
            'entitas_id' => $entitas_id,
        ];

        return view('picassets/index', $data);
    }

    /**
     * Assign asset ke pegawai + buat berita acara
     */
    public function store()
    {

            // debug cepat: pastikan ada POST
    $post = $this->request->getPost();
    if (empty($post)) {
        // tampilkan info berguna untuk debugging
        dd([
            'msg'     => 'POST KOSONG — cek form / CSRF / method',
            'rawBody' => $this->request->getBody(),   // isi body request
            'server'  => $_SERVER,
        ]);
    }

    // ambil values
    $pegawai_id = $post['pegawai_id'] ?? null;
    $asset_id   = $post['asset_id'] ?? null;

        $pegawai_id = $this->request->getPost('pegawai_id');
        $asset_id   = $this->request->getPost('asset_id');

        // Validasi input
        if (!$pegawai_id || !$asset_id) {
            return redirect()->back()->with('error', 'Pegawai dan Asset harus dipilih.');
        }

        // Simpan ke DB PIC Assets
        $insertPic = $this->picAssetsModel->insert([
            'pegawai_id'  => $pegawai_id,
            'asset_id'    => $asset_id,
            'assigned_at' => date('Y-m-d H:i:s'),
        ]);

        $picId = $this->picAssetsModel->getInsertID();
        if (!$picId) {
            return redirect()->back()->with('error', 'Gagal membuat data PIC Asset.');
        }

        // Update status asset
        $this->assetModel->updateStatusByPIC($asset_id);


        // Ambil data lengkap untuk template
        $pic = $this->picAssetsModel
            ->select('pegawai.nama as nama_pegawai, pegawai.jabatan, pegawai.department,
                      assets.nama_item, assets.kode_asset, assets.spesifikasi,
                      kondisi.kondisi as kondisi')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('kondisi', 'kondisi.id = assets.kondisi_id', 'left')
            ->where('pic_assets.id', $picId)
            ->first();

        if (!$pic) {
            return redirect()->back()->with('error', 'Data PIC Asset tidak ditemukan untuk dibuat berita acara.');
        }

        // Generate berita acara
        $template = new \PhpOffice\PhpWord\TemplateProcessor(FCPATH . 'templates/berita_acara_template.docx');
        $template->setValue('hari', date('l'));
        $template->setValue('tanggal', date('d'));
        $template->setValue('bulan', date('F'));
        $template->setValue('tahun', date('Y'));
        $template->setValue('nama', $pic['nama_pegawai']);
        $template->setValue('department', $pic['department']);
        $template->setValue('jabatan', $pic['jabatan']);
        $template->setValue('kode_asset', $pic['kode_asset']);
        $template->setValue('nama_asset', $pic['nama_item']);
        $template->setValue('spesifikasi', $pic['spesifikasi']);
        $template->setValue('kondisi', $pic['kondisi']);

        $filename = 'berita_acara_' . $picId . '_' . time() . '.docx';
        $savePath = WRITEPATH . 'berita_acara/' . $filename;
        if (!is_dir(WRITEPATH . 'berita_acara')) {
            mkdir(WRITEPATH . 'berita_acara', 0777, true);
        }
        $template->saveAs($savePath);

        // Simpan ke tabel berita_acara
        $this->beritaAcaraModel->insert([
            'pic_asset_id' => $picId,
            'filename'     => $filename,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        // Log aktivitas
        $pegawai = $this->pegawaiModel->find($pegawai_id);
        $asset   = $this->assetModel->find($asset_id);

        $this->activityModel->log(
            session()->get('user_id'),
            'assign',
            'PIC Assets',
            'Memberikan asset ' . ($asset['nama_item'] ?? $asset_id) .
            ' ke pegawai ' . ($pegawai['nama'] ?? $pegawai_id)
        );

        return redirect()->to('/picassets')
            ->with('success', 'Asset berhasil diberikan & berita acara dibuat.');
    }

    /**
     * Kirim asset ke maintenance
     */
    public function maintenance($id)
    {
        $pic = $this->picAssetsModel->find($id);
        if (!$pic) {
            return redirect()->to('/picassets')->with('error', 'Data PIC Assets tidak ditemukan.');
        }

        $this->maintenanceModel->insert([
            'pic_asset_id' => $id,
            'asset_id'     => $pic['asset_id'],
            'status'       => 'maintenance',
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/maintenance/create/' . $id);
    }

    /**
     * Tandai maintenance selesai
     */
    public function selesaiMaintenance($id)
    {
        $pic = $this->picAssetsModel
            ->select('pic_assets.*, assets.nama_item, pegawai.nama AS nama_pegawai')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->where('pic_assets.id', $id)
            ->first();

        if ($pic) {
            $this->assetModel->updateStatusByPIC($pic['asset_id']);

            $this->activityModel->log(
                session()->get('user_id'),
                'update',
                'Maintenance',
                'Menyelesaikan maintenance untuk asset: ' . ($pic['nama_item'] ?? $pic['asset_id']) .
                ' milik ' . ($pic['nama_pegawai'] ?? $pic['pegawai_id'])
            );
        }

        return redirect()->to('/picassets')->with('success', 'Asset selesai maintenance & kembali digunakan.');
    }

    /**
     * Detail PIC Asset
     */
    public function detail($id)
    {
        $pic = $this->picAssetsModel
            ->select('pic_assets.id, pegawai.nama AS nama_pegawai, pegawai.jabatan AS jabatan_pegawai,
                      assets.nama_item AS nama_asset, assets.kode_asset, assets.kode_ga, assets.spesifikasi, 
                      assets.foto, assets.status AS asset_status, entitas.nama AS nama_entitas, 
                      lokasi.lokasi AS nama_lokasi')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
            ->join('lokasi', 'lokasi.id = assets.lokasi_id', 'left')
            ->where('pic_assets.id', $id)
            ->first();

        if (!$pic) {
            return redirect()->to(base_url('picassets'))->with('error', 'Data PIC Asset tidak ditemukan.');
        }

        return view('picassets/detail', ['pic' => $pic]);
    }

    public function create()
    {
        $assets = $this->assetModel
            ->where('status', 'tersedia')
            ->orderBy('id', 'DESC')
            ->findAll();

        $assignedPegawai = $this->picAssetsModel
            ->select('pegawai_id')
            ->where('released_at', null)
            ->findAll();
        $assignedIds = array_column($assignedPegawai, 'pegawai_id');

        if (!empty($assignedIds)) {
            $pegawai = $this->pegawaiModel
                ->whereNotIn('id', $assignedIds)
                ->findAll();
        } else {
            $pegawai = $this->pegawaiModel->findAll();
        }

        return view('picassets/create', [
            'pegawai' => $pegawai,
            'assets'  => $assets
        ]);
    }

    /**
     * Lepas asset dari pegawai
     */
    public function release($id)
{
    $pic = $this->picAssetsModel
        ->select('pic_assets.*, pegawai.nama as nama_pegawai, pegawai.jabatan, pegawai.department,
                  assets.nama_item, assets.kode_asset, assets.spesifikasi')
        ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
        ->join('assets', 'assets.id = pic_assets.asset_id')
        ->where('pic_assets.id', $id)
        ->first();

    if (!$pic) {
        return redirect()->to('/picassets')->with('error', 'Data PIC Asset tidak ditemukan.');
    }

    // ✅ 1. tandai released_at dulu
    $this->picAssetsModel->update($id, ['released_at' => date('Y-m-d H:i:s')]);

    // ✅ 2. baru update status asset (akan otomatis jadi "tersedia")
    $this->assetModel->updateStatusByPIC($pic['asset_id']);

    // buat berita acara pengembalian
    $filename = $this->generateBeritaAcaraPengembalian($pic);

    // simpan arsip berita acara
    $this->beritaAcaraModel->insert([
        'pic_asset_id' => $id,
        'tipe'         => 'pengembalian',
        'filename'     => $filename,
        'created_at'   => date('Y-m-d H:i:s'),
    ]);

    // log aktivitas
    $this->activityModel->log(
        session()->get('user_id'),
        'release',
        'PIC Assets',
        'Melepas asset: ' . ($pic['nama_item'] ?? '') . ' dari pegawai: ' . ($pic['nama_pegawai'] ?? '')
    );

    return redirect()->to('/picassets')->with('success', 'Asset berhasil dilepas & berita acara pengembalian dibuat.');
}


    /**
     * Generate dokumen berita acara pengembalian
     */
       private function generateBeritaAcaraPenyerahan(array $pic = [], int $picId): string
    {
        // gunakan WRITEPATH karena file template kamu ada di writable/templates
        $templatePath = WRITEPATH . 'templates/berita_acara_pengembalian.docx';
        if (!file_exists($templatePath)) {
            throw new \RuntimeException("Template penyerahan tidak ditemukan di: {$templatePath}");
        }

        $template = new TemplateProcessor($templatePath);

        $template->setValue('hari', date('l'));
        $template->setValue('tanggal', date('d'));
        $template->setValue('bulan', date('F'));
        $template->setValue('tahun', date('Y'));
        $template->setValue('nama', $pic['nama_pegawai'] ?? '-');
        $template->setValue('department', $pic['department'] ?? '-');
        $template->setValue('jabatan', $pic['jabatan'] ?? '-');
        $template->setValue('kode_asset', $pic['kode_asset'] ?? '-');
        $template->setValue('nama_asset', $pic['nama_item'] ?? '-');
        $template->setValue('spesifikasi', $pic['spesifikasi'] ?? '-');
        $template->setValue('kondisi', $pic['kondisi'] ?? '-');

        $dir = WRITEPATH . 'berita_acara';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $filename = 'berita_acara_' . $picId . '_' . time() . '.docx';
        $template->saveAs($dir . '/' . $filename);

        return $filename;
    }

    /**
     * Generate dokumen berita acara pengembalian
     */
    private function generateBeritaAcaraPengembalian(array $pic = []): string
    {
        // gunakan WRITEPATH karena file template ada di writable/templates
        $templatePath = WRITEPATH . 'templates/berita_acara_pengembalian.docx';
        if (!file_exists($templatePath)) {
            throw new \RuntimeException("Template pengembalian tidak ditemukan di: {$templatePath}");
        }

        $template = new TemplateProcessor($templatePath);

        $template->setValue('hari', date('l'));
        $template->setValue('tanggal', date('d'));
        $template->setValue('bulan', date('F'));
        $template->setValue('tahun', date('Y'));
        $template->setValue('nama', $pic['nama_pegawai'] ?? '-');
        $template->setValue('department', $pic['department'] ?? '-');
        $template->setValue('jabatan', $pic['jabatan'] ?? '-');
        $template->setValue('kode_asset', $pic['kode_asset'] ?? '-');
        $template->setValue('nama_asset', $pic['nama_item'] ?? '-');
        $template->setValue('spesifikasi', $pic['spesifikasi'] ?? '-');
        $template->setValue('kondisi', $pic['kondisi'] ?? '-');

        $dir = WRITEPATH . 'berita_acara_pengembalian';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $filename = 'berita_acara_pengembalian_' . ($pic['id'] ?? 'unknown') . '_' . time() . '.docx';
        $template->saveAs($dir . '/' . $filename);

        return $filename;
    }
  }
