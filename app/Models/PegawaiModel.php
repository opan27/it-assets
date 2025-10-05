<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'jabatan', 'department', 'divisi', 'entitas_id'
    ];

    public function getPegawaiWithEntitas()
    {
        return $this->select('pegawai.*, entitas.nama as nama_entitas')
                    ->join('entitas', 'entitas.id = pegawai.entitas_id', 'left')
                    ->findAll();
    }
}
