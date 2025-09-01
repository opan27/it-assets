<?php

namespace App\Controllers;

use App\Models\AssetModel;
use App\Models\KategoriModel;
use App\Models\KondisiModel;
use App\Models\ActivityModel; // ✅ Tambah

class AssetController extends BaseController
{
    protected $assetModel;
    protected $kategoriModel;
    protected $kondisiModel;
    protected $activityModel; // ✅ Tambah

    public function __construct()
    {
        $this->assetModel    = new AssetModel();
        $this->kategoriModel = new KategoriModel();
        $this->kondisiModel  = new KondisiModel();
        $this->activityModel = new ActivityModel(); // ✅ Tambah
    }

        public function index()
    {
        $status  = $this->request->getGet('status');
        $keyword = $this->request->getGet('keyword');

        // Mulai query builder
        $builder = $this->assetModel;

        // Filter status
        if ($status) {
            $builder = $builder->where('status', $status);
        }

        // Search berdasarkan nama_item, kode_asset, kode_ga, dan kategori
        if ($keyword) {
            $builder = $builder->groupStart()
                            ->like('assets.nama_item', $keyword)
                            ->orLike('assets.kode_asset', $keyword)
                            ->orLike('assets.kode_ga', $keyword)  // ✅ filter No.GA
                            ->orLike('kategori.jenis', $keyword)
                            ->groupEnd();
        }

        // Panggil getAssets() untuk mengambil data
        $data['assets']   = $builder->getAssets();
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['kondisi']  = $this->kondisiModel->findAll();
        $data['status']   = $status;
        $data['keyword']  = $keyword;

        return view('assets/index', $data);
    }


    public function store()
    {
        $data = [
            'nama_item'   => $this->request->getPost('nama_item'),
            'kode_asset'  => $this->request->getPost('kode_asset'),
            'kode_ga'     => $this->request->getPost('kode_ga'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kondisi_id'  => $this->request->getPost('kondisi_id'),
            'status'      => 'tersedia',
        ];

        $this->assetModel->insert($data);


        // ✅ Catat aktivitas
        $this->activityModel->log(
            user_id: session()->get('user_id'),
            action: 'create',
            module: 'Asset',
            description: 'Menambahkan asset: ' . $data['nama_item']
        );

        return redirect()->to(base_url('assets'))->with('success', 'Asset berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $asset = $this->assetModel->find($id);
        $this->assetModel->delete($id);

        // ✅ Catat aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'delete',
            'Asset',
            'Menghapus asset: ' . ($asset['nama_item'] ?? $id)
        );

        return redirect()->to('/assets')->with('success', 'Asset berhasil dihapus.');
    }

    public function edit($id)
    {
        $data['asset']    = $this->assetModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['kondisi']  = $this->kondisiModel->findAll();

        return view('assets/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_item'   => $this->request->getPost('nama_item'),
            'kode_asset'  => $this->request->getPost('kode_asset'),
            'kode_ga'     => $this->request->getPost('kode_ga'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'kondisi_id'  => $this->request->getPost('kondisi_id'),
            'status'      => $this->request->getPost('status'),
        ];

        $this->assetModel->update($id, $data);

        // ✅ Catat aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'update',
            'Asset',
            'Mengubah asset ID: ' . $id
        );

        return redirect()->to(base_url('assets'))->with('success', 'Data berhasil diperbarui.');
    }
}
