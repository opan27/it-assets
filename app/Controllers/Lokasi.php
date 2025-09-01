<?php

namespace App\Controllers;

use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    protected $lokasiModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
    }

    public function index()
    {
        $data['lokasi'] = $this->lokasiModel->findAll();
        return view('lokasi/index', $data);
    }

    public function store()
    {
        $this->lokasiModel->save([
            'lokasi' => $this->request->getPost('lokasi')
        ]);
        return redirect()->to('/lokasi');
    }

    public function update($id)
    {
        $this->lokasiModel->update($id, [
            'lokasi' => $this->request->getPost('lokasi')
        ]);
        return redirect()->to('/lokasi');
    }

    public function delete($id)
    {
        $this->lokasiModel->delete($id);
        return redirect()->to('/lokasi');
    }
}
