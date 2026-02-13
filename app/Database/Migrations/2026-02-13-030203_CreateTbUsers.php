<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbUsers extends Migration
{
public function up()
{
    $this->forge->addField([
        'id_users' => [
            'type' => 'INT',
            'auto_increment' => true
        ],
        'nama_pengguna' => [
            'type' => 'VARCHAR',
            'constraint' => 50
        ],
        'username' => [
            'type' => 'VARCHAR',
            'constraint' => 50
        ],
        'password' => [
            'type' => 'VARCHAR',
            'constraint' => 255
        ],
        'role' => [
            'type' => 'ENUM',
            'constraint' => ['admin','pengguna']
        ],
        'status_user' => [
            'type' => 'ENUM',
            'constraint' => ['pending','rejected','active','']
        ]
    ]);

    $this->forge->addKey('id_users', true);
    $this->forge->createTable('tb_users');
}

public function down()
{
    $this->forge->dropTable('tb_users');
}
}
