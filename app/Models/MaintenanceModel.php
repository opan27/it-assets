<?php
namespace App\Models;

use CodeIgniter\Model;

class MaintenanceModel extends Model
{
    protected $table         = 'maintenance';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
    'asset_id', 'pic_id', 'created_by', 'assigned_to',
    'status', 'kendala', 'priority', 'due_date', 'created_at'
];
    protected $returnType    = 'array';
    protected $useTimestamps = true;

    /**
     * Ambil semua tiket lengkap untuk dashboard admin
     */
public function getAllWithDetails()
{
    return $this->select('
                maintenance.*,
                assets.nama_item AS asset_nama,
                assets.kode_asset AS kode_asset,
                maintenance.due_date,   
                maintenance.priority,   
                pic_assets.id AS pic_id,
                pegawai_pic.nama AS pic_nama,
                pegawai_created.nama AS created_by_nama,
                teknisi.nama AS teknisi_nama
            ')
            ->join('assets', 'assets.id = maintenance.asset_id', 'left')
            ->join('pic_assets', 'pic_assets.id = maintenance.pic_id', 'left')
            ->join('pegawai AS pegawai_pic', 'pegawai_pic.id = pic_assets.pegawai_id', 'left')
            ->join('pegawai AS pegawai_created', 'pegawai_created.id = maintenance.created_by', 'left')
            ->join('pegawai AS teknisi', 'teknisi.id = maintenance.assigned_to', 'left')
            ->orderBy('maintenance.created_at', 'DESC')
            ->findAll();
}


    /**
     * Ambil satu tiket lengkap berdasarkan ID
     */
public function getWithDetails($id)
{
    return $this->select('
            maintenance.*,
            assets.nama_item AS asset_nama,
            assets.kode_asset,
            assets.kode_ga,
            assets.spesifikasi,
            pegawai.nama AS pic_nama,
            entitas.nama AS entitas_nama,
            lokasi.lokasi AS lokasi,
            teknisi.username AS assigned_to_nama,
            pegawai_created.nama AS created_by_nama
        ')
        ->join('assets', 'assets.id = maintenance.asset_id', 'left')
        ->join('pic_assets', 'pic_assets.id = maintenance.pic_id', 'left')
        ->join('pegawai', 'pegawai.id = pic_assets.pegawai_id', 'left')
        ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
        ->join('lokasi', 'lokasi.id = assets.lokasi_id', 'left')
        ->join('users AS teknisi', 'teknisi.id = maintenance.assigned_to', 'left')
        ->join('pegawai AS pegawai_created', 'pegawai_created.id = maintenance.created_by', 'left') // ✅ tambahan
        ->where('maintenance.id', $id)
        ->first();
}


}
