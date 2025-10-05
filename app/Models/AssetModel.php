<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetModel extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_item', 'kode_asset', 'kode_ga', 'spesifikasi',
        'kategori_id', 'kondisi_id', 'status', 'entitas_id', 'lokasi_id', 'foto' // ✅ tambah lokasi_id
    ];

    /**
     * Ambil data assets dengan join kategori, kondisi, entitas, dan lokasi
     * Bisa difilter status & keyword
     */
    public function getAssets($status = null, $keyword = null)
    {
        $builder = $this->select(
            'assets.*, 
             kategori.jenis as nama_kategori, 
             kondisi.kondisi as nama_kondisi, 
             entitas.nama as nama_entitas,
             lokasi.lokasi as nama_lokasi' // ✅ join lokasi
        )
        ->join('kategori', 'kategori.id = assets.kategori_id', 'left')
        ->join('kondisi', 'kondisi.id = assets.kondisi_id', 'left')
        ->join('entitas', 'entitas.id = assets.entitas_id', 'left')
        ->join('lokasi', 'lokasi.id = assets.lokasi_id', 'left');

        // Filter status
        if ($status) {
            $builder->where('assets.status', $status);
        }

        // Filter search keyword
        if ($keyword) {
            $builder->groupStart()
                ->like('assets.nama_item', $keyword)
                ->orLike('assets.kode_asset', $keyword)
                ->orLike('assets.kode_ga', $keyword)
                ->orLike('kategori.jenis', $keyword)
                ->orLike('entitas.nama', $keyword)
                ->orLike('lokasi.lokasi', $keyword) // ✅ bisa cari berdasarkan lokasi juga
                ->groupEnd();
        }

        return $builder->findAll();
    }

    /**
     * Report asset + kategori + kondisi + PIC + entitas + lokasi
     */
    public function getReport()
    {
        return $this->db->table('assets a')
            ->select('a.id, a.nama_item, a.kode_asset, a.kode_ga, a.spesifikasi, a.status,
                    k.jenis as kategori, c.kondisi as kondisi, 
                    p.nama as pic, e.nama as entitas, l.lokasi as lokasi') // ✅ tambah lokasi
            ->join('kategori k', 'k.id = a.kategori_id', 'left')
            ->join('kondisi c', 'c.id = a.kondisi_id', 'left')
            ->join('entitas e', 'e.id = a.entitas_id', 'left')
            ->join('lokasi l', 'l.id = a.lokasi_id', 'left')
            // Ambil PIC terakhir saja (belum dilepas)
            ->join('(SELECT p1.asset_id, p1.pegawai_id 
                    FROM pic_assets p1
                    INNER JOIN (
                        SELECT asset_id, MAX(assigned_at) as last_assign
                        FROM pic_assets
                        WHERE released_at IS NULL
                        GROUP BY asset_id
                    ) p2 ON p1.asset_id = p2.asset_id AND p1.assigned_at = p2.last_assign
                    ) pa', 'pa.asset_id = a.id', 'left')
            ->join('pegawai p', 'p.id = pa.pegawai_id', 'left')
            ->get()->getResultArray();
    }
     public function setStatus($assetId, $status)
    {
        return $this->update($assetId, ['status' => $status]);
    }

    public function updateStatusByPIC($assetId)
{
    $db = \Config\Database::connect();

    $pic = $db->table('pic_assets')
              ->where('asset_id', $assetId)
              ->where('released_at IS NULL')
              ->get()
              ->getRow();

    if ($pic) {
        // Masih ada PIC aktif → status terpakai
        return $this->update($assetId, ['status' => 'terpakai']);
    } else {
        // Tidak ada PIC aktif → status tersedia
        return $this->update($assetId, ['status' => 'tersedia']);
    }
}

}
