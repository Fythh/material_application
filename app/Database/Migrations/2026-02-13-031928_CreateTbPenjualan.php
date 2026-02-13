<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbPenjualan extends Migration
{
public function up()
{
    $this->forge->addField([
        'id_penjualan' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'tanggal' => [
            'type' => 'DATE'
        ],
        'id_barang' => [
            'type' => 'INT'
        ],
        'jumlah' => [
            'type' => 'INT'
        ],
        'harga' => [
            'type' => 'INT'
        ],
        'total' => [
            'type' => 'INT'
        ],
        'id_kategori' => [
            'type' => 'INT'
        ],
        'id_pelanggan' => [
            'type' => 'INT'
        ],
        'id_users' => [
            'type' => 'INT'
        ]
    ]);

    $this->forge->addKey('id_penjualan', true);

    $this->forge->addForeignKey('id_barang','tb_barang','id','CASCADE','CASCADE');
    $this->forge->addForeignKey('id_kategori','tb_kategori','id_kategori','CASCADE','CASCADE');
    $this->forge->addForeignKey('id_pelanggan','tb_pelanggan','id_pelanggan','CASCADE','CASCADE');
    $this->forge->addForeignKey('id_users','tb_users','id_users','CASCADE','CASCADE');

    $this->forge->createTable('tb_penjualan');
}
public function down()
{
    $this->forge->dropTable('tb_penjualan');
}
}
