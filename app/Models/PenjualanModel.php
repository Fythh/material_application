<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'tb_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $allowedFields = [
        'tanggal',
        'id_barang',
        'jumlah',
        'harga',
        'total',
        'id_kategori',
        'id_pelanggan',
        'id_users',
        'alamat_pengiriman', 
        'telepon',             
        'pengiriman',        
        'pembayaran',         
        'nama_penerima',
        'status'       
    ];
}

