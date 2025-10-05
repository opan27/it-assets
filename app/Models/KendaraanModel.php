<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table      = 'kendaraan';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'no_plat','merk','status_kendaraan','kunci_cadangan','bpkb',
        'nomor_rangka','nomor_mesin','tahun_pembelian',
        'stnk_jatuh_tempo','stnk_lima_tahunan','stnk_perpanjangan_berikutnya','nominal_bayar',
        'no_polis_asuransi','asuransi_jatuh_tempo','asuransi_perpanjangan_berikutnya','nominal_perbayaran_asuransi',
        'entitas_id','lokasi_id'
    ];

    /**
     * Ambil data kendaraan + nama entitas & lokasi
     */
    public function getKendaraanWithRelasi()
    {
    return $this->select('
                        kendaraan.*,
                        entitas.nama AS nama_entitas,
                        lokasi.lokasi AS nama_lokasi
                    ')

                ->join('entitas', 'entitas.id = kendaraan.entitas_id', 'left')
                ->join('lokasi', 'lokasi.id = kendaraan.lokasi_id', 'left')
                ->findAll();
    }
}
