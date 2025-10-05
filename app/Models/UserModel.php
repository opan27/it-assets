<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['pegawai_id', 'username', 'password', 'role'];
    protected $returnType    = 'array';
    protected $useTimestamps = true;

    // Hash password otomatis
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Ambil teknisi (join ke pegawai)
    public function getTeknisiWithPegawai()
    {
        return $this->select('users.id as user_id, pegawai.nama')
                    ->join('pegawai', 'pegawai.id = users.pegawai_id')
                    ->where('users.role', 'teknisi')
                    ->findAll();
    }
}
