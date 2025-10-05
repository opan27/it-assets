<?php
namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'maintenance_progress';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'maintenance_id',
        'user_id',      // tambahkan ini
        'sender_id',    // kalau kamu pakai sender
        'deskripsi',
        'foto',
        'status',       // tambahkan ini
        'created_at'
    ];
}
