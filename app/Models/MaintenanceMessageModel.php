<?php

namespace App\Models;

use CodeIgniter\Model;

class MaintenanceMessageModel extends Model
{
    protected $table            = 'maintenance_message';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['maintenance_id', 'sender_id', 'message', 'created_at'];
    protected $useTimestamps    = false; // created_at sudah dihandle DB

    /**
     * Ambil semua pesan + nama pengirim (pegawai)
     * Tetap tampil walau pegawai tidak ada (LEFT JOIN)
     */
    public function getMessagesWithSender(int $maintenanceId): array
    {
        return $this->select('maintenance_message.*, pegawai.nama AS sender_nama')
                    ->join('pegawai', 'pegawai.id = maintenance_message.sender_id', 'left')
                    ->where('maintenance_id', $maintenanceId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
}
