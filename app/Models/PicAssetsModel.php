<?php

namespace App\Models;

use CodeIgniter\Model;

class PicAssetsModel extends Model
{
    protected $table = 'pic_assets';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pegawai_id', 'asset_id', 'assigned_at', 'released_at'];
    protected $useTimestamps = false; // kita isi manual assigned_at / released_at
}
