<?php
namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'maintenance_id',
        'sender_id',
        'sender_nama',
        'message',
        'created_at'
    ];
    public $timestamps = false;
}
