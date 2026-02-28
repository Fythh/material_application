<?php

namespace App\Controllers;

use App\Models\PenjualanModel;
use App\Models\BarangModel;
use App\Models\PelangganModel;

class Penjualan extends BaseController
{
public function index()
{
    $db = \Config\Database::connect();
    $builder = $db->table('tb_penjualan');
    
    // 1. Pilih kolom yang mau diambil
    $builder->select('tb_penjualan.*, tb_barang.nama_barang, tb_pelanggan.nama_pelanggan');
    
    // 2. BAGIAN KRUSIAL: Pastiin nama kolom di kanan-kiri bener
    // Tabel Barang: kolomnya 'id'
    // Tabel Penjualan: kolomnya 'id_barang'
    $builder->join('tb_barang', 'tb_barang.id = tb_penjualan.id_barang', 'left');
    
    // Tabel Pelanggan: kolomnya 'id_pelanggan' (cek lagi ya, apakah 'id' atau 'id_pelanggan')
    $builder->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan', 'left');
    
    $builder->orderBy('tb_penjualan.tanggal', 'DESC');
    
    $query = $builder->get();
    $data['penjualan'] = $query->getResultArray();
    
    return view('penjualan/index', $data);
}

    public function detail($id)
{
    $penjualanModel = new \App\Models\PenjualanModel();

    $pesanan = $penjualanModel->select('tb_penjualan.*, tb_barang.nama_barang, tb_barang.foto, tb_pelanggan.nama_pelanggan')
                // GANTI DI SINI: Sesuaikan tb_barang.id atau tb_barang.id_barang
                ->join('tb_barang', 'tb_barang.id = tb_penjualan.id_barang', 'left') 
                ->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_penjualan.id_pelanggan', 'left')
                ->where('tb_penjualan.id_penjualan', $id)
                ->first();

    if (!$pesanan) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Transaksi ID $id Gak Ketemu!");
    }

    $data = [
        'title'          => 'Detail Transaksi #' . $id,
        'pesanan'        => $pesanan,
        'detail_pesanan' => [$pesanan] 
    ];

    // JANGAN LUPA: Matikan/Hapus baris dd() tadi sebelum di-save
    return view('penjualan/detail', $data); 
}

    public function delete($id)
    {
        $model = new PenjualanModel();
        $model->delete($id);
        return redirect()->to('/penjualan');
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        $penjualanModel = new PenjualanModel();
        $penjualanModel->update($id, ['status' => $status]);
        return $this->response->setJSON(['success' => true]);
    }
}