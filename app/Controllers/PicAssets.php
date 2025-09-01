<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AssetModel;
use App\Models\PicAssetsModel;
use App\Models\ActivityModel;
use App\Models\MaintenanceModel;

class PicAssets extends BaseController
{
    protected $pegawaiModel;
    protected $assetModel;
    protected $picAssetsModel;
    protected $activityModel;
    protected $maintenanceModel;

    public function __construct()
    {
        $this->pegawaiModel    = new PegawaiModel();
        $this->assetModel      = new AssetModel();
        $this->picAssetsModel  = new PicAssetsModel();
        $this->activityModel   = new ActivityModel();
        $this->maintenanceModel = new MaintenanceModel();
    }

    public function index()
    {
        $status  = $this->request->getGet('status');
        $keyword = $this->request->getGet('keyword');

        // --- Ambil data PIC assets ---
        $builder = $this->picAssetsModel
            ->select('
                pic_assets.id,
                pegawai.nama as nama_pegawai,
                pegawai.jabatan as jabatan_pegawai,
                assets.id as asset_id,
                assets.nama_item as nama_asset,
                assets.kode_asset,
                assets.kode_ga,
                assets.spesifikasi,
                assets.status as asset_status,
                pic_assets.assigned_at
            ')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id', 'left')
            ->join('assets', 'assets.id = pic_assets.asset_id', 'left')
            ->where('pic_assets.released_at IS NULL');

        // Filter status asset
        if ($status) {
            $builder->where('assets.status', $status);
        }

        // Filter/search keyword
        if ($keyword) {
            $builder->groupStart()
                ->like('pegawai.nama', $keyword)
                ->orLike('assets.nama_item', $keyword)
                ->orLike('assets.kode_asset', $keyword)
                ->orLike('assets.kode_ga', $keyword)
                ->groupEnd();
        }

        $pic = $builder->orderBy('pic_assets.assigned_at', 'DESC')->findAll();

        // --- Dropdown: assets tersedia ---
        $assets = $this->assetModel
            ->where('status', 'tersedia')
            ->orderBy('id', 'DESC')
            ->findAll();

        // --- Dropdown: pegawai yang belum punya asset ---
        $assignedPegawai = $this->picAssetsModel
            ->select('pegawai_id')
            ->where('released_at', NULL)
            ->findAll();

        $assignedIds = array_column($assignedPegawai, 'pegawai_id');

        if (!empty($assignedIds)) {
            $pegawai = $this->pegawaiModel
                ->whereNotIn('id', $assignedIds)
                ->findAll();
        } else {
            $pegawai = $this->pegawaiModel->findAll();
        }

        $data = [
            'pegawai' => $pegawai,
            'assets'  => $assets,
            'pic'     => $pic,
            'status'  => $status,
            'keyword' => $keyword
        ];

        return view('picassets/index', $data);
    }

    public function store()
    {
        $pegawai_id = $this->request->getPost('pegawai_id');
        $asset_id   = $this->request->getPost('asset_id');

        // Insert PIC Asset
        $this->picAssetsModel->insert([
            'pegawai_id'  => $pegawai_id,
            'asset_id'    => $asset_id,
            'assigned_at' => date('Y-m-d H:i:s')
        ]);

        // Update status asset menjadi terpakai
        $this->assetModel->update($asset_id, ['status' => 'terpakai']);

        // Log aktivitas
        $pegawai = $this->pegawaiModel->find($pegawai_id);
        $asset   = $this->assetModel->find($asset_id);

        $this->activityModel->log(
            session()->get('user_id'),
            'assign',
            'PIC Assets',
            'Memberikan asset ' . ($asset['nama_item'] ?? $asset_id) . ' ke pegawai ' . ($pegawai['nama'] ?? $pegawai_id)
        );

        return redirect()->to('/picassets')->with('success', 'Asset berhasil diberikan.');
    }

    public function release($id)
    {
        $pic = $this->picAssetsModel->find($id);
        if ($pic) {
            $this->picAssetsModel->update($id, ['released_at' => date('Y-m-d H:i:s')]);
            $this->assetModel->update($pic['asset_id'], ['status' => 'tersedia']);

            $pegawai = $this->pegawaiModel->find($pic['pegawai_id']);
            $asset   = $this->assetModel->find($pic['asset_id']);

            $this->activityModel->log(
                session()->get('user_id'),
                'release',
                'PIC Assets',
                'Melepaskan asset ' . ($asset['nama_item'] ?? $pic['asset_id']) . ' dari pegawai ' . ($pegawai['nama'] ?? $pic['pegawai_id'])
            );
        }

        return redirect()->to('/picassets')->with('success', 'Asset berhasil dilepas.');
    }

    public function maintenance($id)
    {
        $pic = $this->picAssetsModel->find($id);
        if (!$pic) return redirect()->to('/picassets')->with('error', 'Data PIC Assets tidak ditemukan.');

        $this->maintenanceModel->insert([
            'pic_asset_id' => $id,
            'asset_id'     => $pic['asset_id'],
            'status'       => 'maintenance',
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/maintenance/create/' . $id);
    }

    public function selesaiMaintenance($id)
    {
        $pic = $this->picAssetsModel
            ->select('
                pic_assets.*,
                assets.nama_item,
                pegawai.nama as nama_pegawai
            ')
            ->join('assets', 'assets.id = pic_assets.asset_id')
            ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id')
            ->where('pic_assets.id', $id)
            ->first();

        if ($pic) {
            // Update status asset kembali jadi terpakai
            $this->assetModel->update($pic['asset_id'], ['status' => 'terpakai']);

            // 🔥 log aktivitas pakai nama asset & pegawai
            $this->activityModel->log(
                session()->get('user_id'),
                'update',
                'Maintenance',
                'Menyelesaikan maintenance untuk asset: ' . ($pic['nama_item'] ?? $pic['asset_id'])
                . ' milik ' . ($pic['nama_pegawai'] ?? $pic['pegawai_id'])
            );
        }

        return redirect()->to('/picassets')->with('success', 'Asset selesai maintenance & kembali digunakan.');
    }

}
