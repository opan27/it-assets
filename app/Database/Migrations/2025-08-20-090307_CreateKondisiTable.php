<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKondisiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kondisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kondisi');
    }

    public function down()
    {
        $this->forge->dropTable('kondisi');
    }
}
