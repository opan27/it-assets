<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpesifikasiStatusToAssets extends Migration
{
    public function up()
    {
        $this->forge->addColumn('assets', [
            'spesifikasi' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'kode_ga'
            ],
            'status' => [
                'type'       => 'ENUM("tersedia","terpakai","maintenance","rusak")',
                'default'    => 'tersedia',
                'after'      => 'spesifikasi'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('assets', ['spesifikasi','status']);
    }
}
