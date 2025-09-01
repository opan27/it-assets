<?php

namespace App\Controllers;

use App\Models\AssetLokasiModel;
use App\Models\AssetModel;
use App\Models\LokasiModel;
use App\Models\ActivityModel; 

class AssetLokasi extends BaseController
{
    protected $assetLokasiModel;
    protected $assetModel;
    protected $lokasiModel;
    protected $activityModel; // ✅ tambahin

    public function __construct()
    {
        $this->assetLokasiModel = new AssetLokasiModel();
        $this->assetModel       = new AssetModel();
        $this->lokasiModel      = new LokasiModel();
        $this->activityModel    = new ActivityModel(); 
    }

    public function index()
    {
        $keyword  = $this->request->getGet('keyword');
        $lokasiId = $this->request->getGet('lokasi_id');

        $builder = $this->assetLokasiModel
            ->select('
                asset_lokasi.id,
                assets.id as asset_id,
                assets.nama_item as nama_asset,
                assets.kode_asset,
                assets.kode_ga,
                assets.status as status,
                lokasi.id as lokasi_id,
                lokasi.lokasi,
                asset_lokasi.assigned_at
            ')
            ->join('assets', 'assets.id = asset_lokasi.asset_id', 'left')
            ->join('lokasi', 'lokasi.id = asset_lokasi.lokasi_id', 'left');

        if ($lokasiId) {
            $builder->where('asset_lokasi.lokasi_id', $lokasiId);
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('assets.nama_item', $keyword)
                ->orLike('assets.kode_asset', $keyword)
                ->orLike('assets.kode_ga', $keyword)
                ->orLike('lokasi.lokasi', $keyword)
                ->groupEnd();
        }

        $asset_lokasi = $builder->orderBy('asset_lokasi.assigned_at', 'DESC')->findAll();

        $assets = $this->assetModel
            ->where('status', 'tersedia')
            ->orderBy('id', 'DESC')
            ->findAll();

        $data = [
            'asset_lokasi' => $asset_lokasi,
            'assets'       => $assets,
            'lokasi'       => $this->lokasiModel->findAll(),
            'keyword'      => $keyword,
            'lokasiId'     => $lokasiId
        ];

        return view('asset_lokasi/index', $data);
    }

    public function store()
    {
        $assetId  = $this->request->getPost('asset_id');
        $lokasiId = $this->request->getPost('lokasi_id');

        $this->assetLokasiModel->insert([
            'asset_id'   => $assetId,
            'lokasi_id'  => $lokasiId,
            'assigned_at'=> date('Y-m-d H:i:s')
        ]);

        $this->assetModel->update($assetId, ['status' => 'terpakai']);

        // ✅ log aktivitas
        $asset  = $this->assetModel->find($assetId);
        $lokasi = $this->lokasiModel->find($lokasiId);
        $this->activityModel->log(
            session()->get('user_id'),
            'assign',
            'Asset Lokasi',
            'Menempatkan asset ' . ($asset['nama_item'] ?? $assetId) . 
            ' ke lokasi ' . ($lokasi['lokasi'] ?? $lokasiId)
        );

        return redirect()->to('/asset_lokasi')->with('success', 'Asset berhasil ditempatkan di lokasi');
    }

    public function edit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $assetId  = $this->request->getPost('asset_id');
            $lokasiId = $this->request->getPost('lokasi_id');

            $this->assetLokasiModel->update($id, [
                'asset_id'  => $assetId,
                'lokasi_id' => $lokasiId,
            ]);

            // ✅ log update
            $asset  = $this->assetModel->find($assetId);
            $lokasi = $this->lokasiModel->find($lokasiId);
            $this->activityModel->log(
                session()->get('user_id'),
                'update',
                'Asset Lokasi',
                'Update lokasi asset ' . ($asset['nama_item'] ?? $assetId) . 
                ' ke lokasi ' . ($lokasi['lokasi'] ?? $lokasiId)
            );

            return redirect()->to('/asset_lokasi')->with('success', 'Data berhasil diupdate!');
        }

        $data = [
            'asset_lokasi' => $this->assetLokasiModel->find($id),
            'assets'       => $this->assetModel->where('status', 'tersedia')->findAll(),
            'lokasi'       => $this->lokasiModel->findAll()
        ];

        return view('asset_lokasi/edit', $data);
    }

    public function delete($id)
    {
        $alokasi = $this->assetLokasiModel->find($id);

        if ($alokasi) {
            $this->assetModel->update($alokasi['asset_id'], ['status' => 'tersedia']);
            $this->assetLokasiModel->delete($id);

            // ✅ log delete
            $asset  = $this->assetModel->find($alokasi['asset_id']);
            $lokasi = $this->lokasiModel->find($alokasi['lokasi_id']);
            $this->activityModel->log(
                session()->get('user_id'),
                'delete',
                'Asset Lokasi',
                'Menghapus penempatan asset ' . ($asset['nama_item'] ?? $alokasi['asset_id']) . 
                ' dari lokasi ' . ($lokasi['lokasi'] ?? $alokasi['lokasi_id'])
            );
        }

        return redirect()->to('/asset_lokasi')->with('success', 'Data berhasil dihapus!');
    }
}
