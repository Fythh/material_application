<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'tb_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $allowedFields = [
        'nama_pelanggan',
        'telepon',
        'alamat'
    ];
}

