<?php

namespace App\Models;

use CodeIgniter\Model;

class EntitasModel extends Model
{
    protected $table            = 'entitas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['kode', 'nama', 'deskripsi', 'created_at', 'updated_at']; // ✅ sesuai kolom tabel
}
