<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Insert dummy pegawai
        $this->db->table('pegawai')->insert([
            'nama' => 'Super Admin',
            'jabatan' => 'IT Manager',
            'department' => 'IT',
            'divisi' => 'Support'
        ]);

        $pegawai_id = $this->db->insertID();

        // Insert akun admin
        $this->db->table('users')->insert([
            'pegawai_id' => $pegawai_id,
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'superadmin'
        ]);
    }
}
