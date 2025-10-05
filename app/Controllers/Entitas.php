<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AssetModel;

class Entitas extends BaseController
{
    protected $pegawaiModel;
    protected $assetModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
        $this->assetModel  = new AssetModel();
    }

public function dashboard($kode)
{
    $db = db_connect();
    $entitas = $db->table('entitas')
        ->where('kode', strtoupper($kode))
        ->get()
        ->getRowArray();

    if (!$entitas) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Entitas $kode tidak ditemukan");
    }

    // Hitung total
    $totalPegawai = $this->pegawaiModel
        ->where('entitas_id', $entitas['id'])
        ->countAllResults();

    $totalAssets = $this->assetModel
        ->where('entitas_id', $entitas['id'])
        ->countAllResults();

    // List pegawai
    $pegawaiList = $this->pegawaiModel
        ->where('entitas_id', $entitas['id'])
        ->findAll();

    // List asset (join kategori, kondisi, lokasi supaya info lengkap)
    $assetList = $this->assetModel
        ->select('assets.*, kategori.jenis as kategori, kondisi.kondisi as kondisi, lokasi.lokasi as lokasi')
        ->join('kategori', 'kategori.id=assets.kategori_id', 'left')
        ->join('kondisi', 'kondisi.id=assets.kondisi_id', 'left')
        ->join('lokasi', 'lokasi.id=assets.lokasi_id', 'left')
        ->where('assets.entitas_id', $entitas['id'])
        ->findAll();

    // Data untuk grafik
    $rows = $db->table('assets')
        ->select('MONTH(created_at) as bulan, COUNT(id) as jumlah')
        ->where('entitas_id', $entitas['id'])
        ->groupBy('MONTH(created_at)')
        ->get()
        ->getResultArray();

    $bulan = [];
    $jumlahAset = [];
    foreach ($rows as $row) {
        $bulan[] = date("F", mktime(0, 0, 0, $row['bulan'], 1));
        $jumlahAset[] = $row['jumlah'];
    }

    return view('entitas/dashboard', [
        'title'        => "Dashboard {$entitas['kode']}",
        'entitas'      => $entitas,
        'totalPegawai' => $totalPegawai,
        'totalAssets'  => $totalAssets,
        'pegawaiList'  => $pegawaiList,
        'assetList'    => $assetList,
        'bulan'        => $bulan,
        'jumlahAset'   => $jumlahAset,
    ]);
}

}
