<?php

namespace App\Controllers;

use App\Models\KondisiModel;
use App\Models\ActivityModel;

class Kondisi extends BaseController
{
    protected $kondisiModel;
    protected $activityModel;

    public function __construct()
    {
        $this->kondisiModel  = new KondisiModel();
        $this->activityModel = new ActivityModel();
    }

    // List semua kondisi
    public function index()
    {
        $data['kondisi'] = $this->kondisiModel->findAll();
        return view('kondisi/index', $data);
    }

    // Form tambah
    public function create()
    {
        return view('kondisi/create');
    }

    // Simpan kondisi baru
    public function store()
    {
        $kondisi = $this->request->getPost('kondisi');

        $this->kondisiModel->save([
            'kondisi' => $kondisi
        ]);

        // 🔥 log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'create',
            'Kondisi',
            'Menambahkan kondisi: ' . $kondisi
        );

        return redirect()->to('/kondisi')->with('success', 'Kondisi berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $data['kondisi'] = $this->kondisiModel->find($id);
        return view('kondisi/edit', $data);
    }

    // Update kondisi
    public function update($id)
    {
        $kondisi = $this->request->getPost('kondisi');

        $this->kondisiModel->update($id, [
            'kondisi' => $kondisi
        ]);

        // 🔥 log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'update',
            'Kondisi',
            'Mengubah kondisi ID: ' . $id
        );

        return redirect()->to('/kondisi')->with('success', 'Kondisi berhasil diupdate');
    }

    // Hapus kondisi
    public function delete($id)
    {
        $kondisi = $this->kondisiModel->find($id); // ✅ ambil nama kondisi

        $this->kondisiModel->delete($id);

        // 🔥 log aktivitas
        $this->activityModel->log(
            session()->get('user_id'),
            'delete',
            'Kondisi',
            'Menghapus kondisi: ' . ($kondisi['kondisi'] ?? $id)
        );

        return redirect()->to('/kondisi')->with('success', 'Kondisi berhasil dihapus');
    }
}
