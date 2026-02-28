<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_barang',
        'kategori',
        'harga',
        'stok',
        'id_kategori',
        'deskripsi',
        'foto'
    ];
}

