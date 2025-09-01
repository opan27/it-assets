<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\ActivityModel;

class Kategori extends BaseController
{
    protected $kategoriModel;
    protected $activityModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->activityModel = new ActivityModel();
    }

    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('kategori/index', $data);
    }

    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $jenis = $this->request->getPost('jenis');

        $this->kategoriModel->save([
            'jenis' => $jenis
        ]);

        // 🔥 log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'create',
            'Kategori',
            'Menambahkan kategori: ' . $jenis
        );

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->kategoriModel->find($id);
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $jenis = $this->request->getPost('jenis');

        $this->kategoriModel->update($id, [
            'jenis' => $jenis
        ]);

        // 🔥 log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'update',
            'Kategori',
            'Mengubah kategori ID: ' . $id
        );

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function delete($id)
    {
        $kategori = $this->kategoriModel->find($id); // ✅ ambil data dulu

        $this->kategoriModel->delete($id);

        // 🔥 log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'delete',
            'Kategori',
            'Menghapus kategori: ' . ($kategori['jenis'] ?? $id)
        );

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
