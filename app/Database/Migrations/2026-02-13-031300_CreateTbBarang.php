<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbBarang extends Migration
{
public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'nama_barang' => [
            'type' => 'VARCHAR',
            'constraint' => 255
        ],
        'kategori' => [
            'type' => 'VARCHAR',
            'constraint' => 255
        ],
        'harga' => [
            'type' => 'INT'
        ],
        'stok' => [
            'type' => 'INT'
        ],
        'id_kategori' => [
            'type' => 'INT'
        ]
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('id_kategori','tb_kategori','id_kategori','CASCADE','CASCADE');
    $this->forge->createTable('tb_barang');
}

public function down()
{
    $this->forge->dropTable('tb_barang');
}
}
