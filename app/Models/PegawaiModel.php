<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'pegawai';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jabatan', 'department', 'divisi'];
    protected $useTimestamps = true; // otomatis isi created_at & updated_at
}
