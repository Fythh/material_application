<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbPelanggan extends Migration
{
public function up()
{
    $this->forge->addField([
        'id_pelanggan' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'nama_pelanggan' => [
            'type' => 'VARCHAR',
            'constraint' => 100
        ],
        'telepon' => [
            'type' => 'VARCHAR',
            'constraint' => 20
        ],
        'alamat' => [
            'type' => 'TEXT'
        ]
    ]);

    $this->forge->addKey('id_pelanggan', true);
    $this->forge->createTable('tb_pelanggan');
}
public function down()
{
    $this->forge->dropTable('tb_pelanggan');
}
}
