<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaAcaraModel extends Model
{
    protected $table         = 'berita_acara';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['pic_asset_id', 'filename', 'created_at'];
    protected $useTimestamps = false; // karena kamu tidak punya kolom updated_at
}
