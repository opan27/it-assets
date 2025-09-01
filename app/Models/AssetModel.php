<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetModel extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_item', 'kode_asset', 'kode_ga', 'spesifikasi',
        'kategori_id', 'kondisi_id', 'status'
    ];

    /**
     * Ambil data assets dengan join kategori & kondisi
     * Bisa difilter status & keyword
     */
    public function getAssets($status = null, $keyword = null)
    {
        $builder = $this->select('assets.*, kategori.jenis as nama_kategori, kondisi.kondisi as nama_kondisi')
                        ->join('kategori', 'kategori.id = assets.kategori_id', 'left')
                        ->join('kondisi', 'kondisi.id = assets.kondisi_id', 'left');

        // Filter status
        if ($status) {
            $builder->where('assets.status', $status);
        }

        // Filter search keyword
        if ($keyword) {
            $builder->groupStart()
                    ->like('assets.nama_item', $keyword)
                    ->orLike('assets.kode_asset', $keyword)
                    ->orLike('assets.kode_ga', $keyword) // ✅ Tambahkan No.GA
                    ->orLike('kategori.jenis', $keyword)
                    ->groupEnd();
        }

        return $builder->findAll();
    }

    public function getReport()
    {
        return $this->db->table('assets a')
            ->select('a.id, a.nama_item, a.kode_asset, a.kode_ga, a.spesifikasi, a.status,
                    k.jenis as kategori, c.kondisi as kondisi, p.nama as pic')
            ->join('kategori k', 'k.id = a.kategori_id', 'left')
            ->join('kondisi c', 'c.id = a.kondisi_id', 'left')
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


}
