<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    // ======================
    // ADMIN DASHBOARD
    // ======================
    public function admin()
    {
        $barangModel = new BarangModel();
        $kategoriModel = new KategoriModel();
        $penjualanModel = new PenjualanModel();
        $userModel = new UserModel();

        $data['total_barang']     = $barangModel->countAllResults();
        $data['total_kategori']   = $kategoriModel->countAllResults();
        $data['total_penjualan']  = $penjualanModel->countAllResults();
        $data['total_user']       = $userModel->where('role', 'pembeli')->countAllResults();

        $data['stok_minim'] = $barangModel
            ->where('stok <=', 5)
            ->findAll();

        return view('dashboard/admin', $data);
    }

    // ======================
    // USER DASHBOARD
    // ======================
    public function user()
    {
        $barangModel   = new BarangModel();
        $kategoriModel = new KategoriModel();

        $data = [
            'produk'   => $barangModel->findAll(),
            'kategori' => $kategoriModel->findAll(),
        ];

        return view('user/dashboard/index', $data);
    }

    public function userProduk()
    {
        $db = \Config\Database::connect();
        
        // Query dengan JOIN ke tabel kategori
        $builder = $db->table('tb_barang');
        $builder->select('tb_barang.*, tb_kategori.nama_kategori');
        $builder->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $query = $builder->get();
        $produk = $query->getResultArray();
        
        // Ambil daftar kategori UNIK dari produk yang ADA
        $list_kategori = array_unique(array_column($produk, 'nama_kategori'));
        
        $data['produk'] = $produk;
        $data['list_kategori'] = $list_kategori; // ini cuma kategori yang ada produknya
        
        return view('user/produk/index', $data);
    }

    public function userPesanan()
    {
        $penjualanModel = new \App\Models\PenjualanModel();
        
        // Ambil pesanan berdasarkan user yang login
        $id_users = session()->get('id_users');
        
        if ($id_users) {
            $data['pesanan'] = $penjualanModel->where('id_users', $id_users)->findAll();
        } else {
            $data['pesanan'] = [];
        }
        
        return view('user/pesanan/index', $data);
    }

    public function userProfil()
    {
        return view('user/profil/index');
    }

    public function userProdukDetail($id)
    {
        $barangModel = new \App\Models\BarangModel();
        
        // Ambil data produk berdasarkan ID
        $produk = $barangModel->find($id);
        
        // Cek kalo produk gak ditemukan
        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan');
            return redirect()->to('/user/produk');
        }
        
        // Ambil produk terkait (kategori sama, kecuali produk ini sendiri)
        $produk_terkait = $barangModel->where('kategori', $produk['kategori'])
                                    ->where('id !=', $id)
                                    ->findAll(4);
        
        $data = [
            'produk' => $produk,
            'produk_terkait' => $produk_terkait ?? []
        ];
        
        return view('user/produk/detail', $data);
    }

public function userPesananDetail($id)
{
    $penjualanModel = new \App\Models\PenjualanModel();
    $db = \Config\Database::connect();
    
    $pesanan = $penjualanModel->find($id);
    
    if (!$pesanan) {
        return redirect()->to('/user/pesanan')->with('error', 'Pesanan tidak ditemukan');
    }
    
    if ($pesanan['id_users'] != session()->get('id_users')) {
        return redirect()->to('/user/pesanan')->with('error', 'Akses ditolak');
    }
    
    // Ambil detail produk dengan JOIN yang benar
    $builder = $db->table('tb_penjualan');
    $builder->select('tb_penjualan.*, tb_barang.nama_barang, tb_barang.foto, tb_kategori.nama_kategori as kategori');
    $builder->join('tb_barang', 'tb_barang.id = tb_penjualan.id_barang', 'left');
    $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left'); // Join kategori lewat tb_barang
    $builder->where('tb_penjualan.id_penjualan', $id);
    
    $data['pesanan'] = $pesanan;
    $data['detail_pesanan'] = $builder->get()->getResultArray();
    
    return view('user/pesanan/detail', $data);
}

public function batalkanPesanan($id)
{
    $penjualanModel = new \App\Models\PenjualanModel();
    $barangModel = new \App\Models\BarangModel(); // Panggil model barang buat balikin stok
    
    // Ambil data pesanan
    $pesanan = $penjualanModel->find($id);
    
    // Cek kepemilikan & pastikan statusnya masih 'pending'
    if ($pesanan && $pesanan['id_users'] == session()->get('id_users')) {
        
        if ($pesanan['status'] === 'pending') {
            // 1. Update status jadi 'batal'
            $penjualanModel->update($id, ['status' => 'batal']);
            
            // 2. LOGIKA BALIKIN STOK (Opsional tapi penting)
            // Ambil data barang berdasarkan id_barang di pesanan
            $barang = $barangModel->find($pesanan['id_barang']);
            if ($barang) {
                $stokBaru = $barang['stok'] + $pesanan['jumlah'];
                $barangModel->update($pesanan['id_barang'], ['stok' => $stokBaru]);
            }
            
            session()->setFlashdata('success', 'Pesanan berhasil dibatalkan dan stok dikembalikan.');
        } else {
            session()->setFlashdata('error', 'Pesanan yang sudah diproses tidak bisa dibatalkan.');
        }
        
    } else {
        session()->setFlashdata('error', 'Data pesanan tidak ditemukan atau akses ditolak.');
    }
    
    return redirect()->to('/user/pesanan');
}
}