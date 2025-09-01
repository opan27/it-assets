<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetLokasiModel extends Model
{
    protected $table = 'asset_lokasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['asset_id', 'lokasi_id', 'assigned_at'];

public function getAll()
{
    return $this->select('
            asset_lokasi.*, 
            assets.nama_item as nama_asset, 
            assets.kode_asset, 
            assets.kode_ga, 
            assets.status as status, 
            lokasi.lokasi
        ')
        ->join('assets', 'assets.id = asset_lokasi.asset_id', 'left')
        ->join('lokasi', 'lokasi.id = asset_lokasi.lokasi_id', 'left')
        ->findAll();
}



}
