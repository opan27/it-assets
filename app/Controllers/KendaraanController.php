<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\EntitasModel;
use App\Models\LokasiModel;
use CodeIgniter\Controller;

class KendaraanController extends Controller
{
    protected $kendaraanModel;
    protected $entitasModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->entitasModel   = new EntitasModel();
        $this->lokasiModel    = new LokasiModel();
    }

    public function index()
    {
        $builder = $this->kendaraanModel
            ->select('kendaraan.*, entitas.nama AS nama_entitas, lokasi.lokasi AS nama_lokasi')
            ->join('entitas', 'entitas.id = kendaraan.entitas_id', 'left')
            ->join('lokasi', 'lokasi.id = kendaraan.lokasi_id', 'left');

        $data['kendaraan'] = $builder->findAll();
        return view('kendaraan/index', $data);
    }

    public function create()
    {
        $data['entitas'] = $this->entitasModel->findAll();
        $data['lokasi']  = $this->lokasiModel->findAll();
        return view('kendaraan/create', $data);
    }

    public function store()
    {
        $this->kendaraanModel->insert($this->request->getPost());
        return redirect()->to('/kendaraan')->with('success','Kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['kendaraan'] = $this->kendaraanModel->find($id);
        $data['entitas']   = $this->entitasModel->findAll();
        $data['lokasi']    = $this->lokasiModel->findAll();
        return view('kendaraan/edit', $data);
    }

    public function update($id)
    {
        $this->kendaraanModel->update($id, $this->request->getPost());
        return redirect()->to('/kendaraan')->with('success','Data kendaraan diperbarui');
    }

    public function delete($id)
    {
        $this->kendaraanModel->delete($id);
        return redirect()->to('/kendaraan')->with('success','Data kendaraan dihapus');
    }
}
