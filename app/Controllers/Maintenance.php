<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MaintenanceModel;
use App\Models\PicAssetsModel;
use App\Models\ActivityModel;

class Maintenance extends BaseController
{
    protected $maintenanceModel;
    protected $picAssetsModel;
    protected $activityModel;

    public function __construct()
    {
        $this->maintenanceModel = new MaintenanceModel();
        $this->picAssetsModel   = new PicAssetsModel();
        $this->activityModel    = new ActivityModel();
    }

    // Daftar maintenance
    public function index()
    {
        $builder = $this->maintenanceModel->builder();
        $builder->select('
            maintenance.id,
            maintenance.status as status_maintenance,
            maintenance.kendala,
            assets.nama_item,
            assets.kode_asset,
            assets.status as status_asset,
            pegawai.nama as nama_pegawai,
            (
                SELECT MAX(m2.id)
                FROM maintenance m2
                WHERE m2.asset_id = maintenance.asset_id
            ) as last_id
        ');
        $builder->join('assets', 'assets.id = maintenance.asset_id');
        $builder->join('pic_assets', 'pic_assets.id = maintenance.pic_id');
        $builder->join('pegawai', 'pegawai.id = pic_assets.pegawai_id');
        $builder->orderBy('maintenance.created_at', 'DESC');

        $maintenance = $builder->get()->getResultArray();

        return view('maintenance/index', ['maintenance' => $maintenance]);
    }

    // Form create
    public function create($picId)
    {
        $picAsset = $this->picAssetsModel
            ->select('
                pic_assets.id as pic_id,
                assets.id as asset_id,
                assets.nama_item,
                assets.kode_asset,
                pegawai.nama as nama_pegawai
            ')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->where('pic_assets.id', $picId)
            ->first();

        if (!$picAsset) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("PIC Asset tidak ditemukan");
        }

        return view('maintenance/create', ['picAsset' => $picAsset]);
    }

    // Simpan maintenance baru
    public function store()
    {
        $picId   = $this->request->getPost('pic_id');
        $assetId = $this->request->getPost('asset_id');
        $kendala = $this->request->getPost('kendala');

        // Tutup semua maintenance lama asset ini (case insensitive)
        $this->maintenanceModel->where('asset_id', $assetId)
            ->groupStart()
                ->where('status', 'maintenance')
                ->orWhere('status', 'Maintenance')
            ->groupEnd()
            ->set(['status' => 'selesai'])
            ->update();

        // Insert maintenance baru
        $this->maintenanceModel->insert([
            'pic_id'    => $picId,
            'asset_id'  => $assetId,
            'kendala'   => $kendala,
            'status'    => 'maintenance',
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        // Update status asset
        $this->picAssetsModel->db->table('assets')
            ->where('id', $assetId)
            ->update(['status' => 'maintenance']);

        // ambil nama asset & pegawai
        $picAsset = $this->picAssetsModel
            ->select('assets.nama_item, pegawai.nama as nama_pegawai')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->where('assets.id', $assetId)
            ->first();

        // log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'create',
            'Maintenance',
            'Menambahkan maintenance untuk asset: ' . ($picAsset['nama_item'] ?? 'Unknown')
            . ' milik ' . ($picAsset['nama_pegawai'] ?? '-') 
            . ' (Kendala: ' . $kendala . ')'
        );

        return redirect()->to(base_url('maintenance'))
                        ->with('success', 'Maintenance berhasil ditambahkan');
    }

    // Tandai selesai maintenance
    public function selesai($id)
    {
        $maintenance = $this->maintenanceModel->find($id);
        if (!$maintenance) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data Maintenance tidak ditemukan");
        }

        // Pastikan hanya last_id yg bisa diselesaikan
        $lastId = $this->maintenanceModel->selectMax('id')
                    ->where('asset_id', $maintenance['asset_id'])
                    ->get()->getRowArray()['id'];

        if ($maintenance['id'] != $lastId) {
            return redirect()->to(base_url('maintenance'))
                ->with('error', 'Hanya maintenance terbaru yang dapat diselesaikan');
        }

        // Update status maintenance
        $this->maintenanceModel->update($id, [
            'status' => 'selesai',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Update status asset kembali
        $this->picAssetsModel->db->table('assets')
            ->where('id', $maintenance['asset_id'])
            ->update(['status' => 'terpakai']);

        // ambil nama asset & pegawai
        $picAsset = $this->picAssetsModel
            ->select('assets.nama_item, pegawai.nama as nama_pegawai')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->where('assets.id', $maintenance['asset_id'])
            ->first();

        // log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'update',
            'Maintenance',
            'Menyelesaikan maintenance untuk asset: ' . ($picAsset['nama_item'] ?? 'Unknown')
            . ' milik ' . ($picAsset['nama_pegawai'] ?? '-')
        );

        return redirect()->to(base_url('maintenance'))
                         ->with('success', 'Maintenance selesai dan status asset diperbarui');
    }
}
