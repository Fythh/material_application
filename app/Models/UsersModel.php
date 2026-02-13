<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tb_users';
    protected $primaryKey = 'id_users';

    protected $allowedFields = [
        'nama_pengguna',
        'username',
        'password',
        'role',
        'status_user'
    ];
}
