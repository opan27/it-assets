<?php
namespace App\Models;
use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table = 'maintenance';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'asset_id',
        'pic_id',
        'kendala',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getAllWithAssets()
    {
        return $this->select('maintenance.*, a.nama_item, a.kode_asset, p.nama as nama_pegawai')
            ->join('assets a', 'a.id = maintenance.asset_id')
            ->join('pic_assets pa', 'pa.id = maintenance.pic_id') // pakai pic_id
            ->join('pegawai p', 'p.id = pa.pegawai_id')
            ->findAll();
    }
}
