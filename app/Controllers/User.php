<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;

class User extends BaseController
{
    // ======================
    // CART
    // ======================

    public function addToCart($id)
{
    // Ambil qty dari POST (kalo ada) atau default 1
    $qty = $this->request->getPost('qty') ?? 1;
    
    // Validasi stok (opsional)
    $barangModel = new BarangModel();
    $barang = $barangModel->find($id);
    
    if (!$barang) {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak ditemukan']);
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }
    
    // Cek stok
    $cart = session()->get('cart') ?? [];
    $currentQty = $cart[$id] ?? 0;
    $totalQty = $currentQty + $qty;
    
    if ($totalQty > $barang['stok']) {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Stok tidak mencukupi']);
        }
        return redirect()->back()->with('error', 'Stok tidak mencukupi');
    }
    
    // Update cart
    $cart[$id] = $totalQty;
    session()->set('cart', $cart);
    
    // Kalo request AJAX (dari Beli Sekarang)
    if ($this->request->isAJAX()) {
        return $this->response->setJSON(['success' => true, 'redirect' => '/user/checkout']);
    }
    
    // Kalo request biasa (dari tombol Tambah ke Cart)
    return redirect()->to('/user/cart');
}

    public function cart()
    {
        $cart = session()->get('cart') ?? [];

        $model = new BarangModel();

        $data['items'] = [];
        $data['total'] = 0;

        foreach ($cart as $id => $qty) {
            $barang = $model->find($id);

            if ($barang) {
                $barang['qty']      = $qty;
                $barang['subtotal'] = $barang['harga'] * $qty;

                $data['total'] += $barang['subtotal'];
                $data['items'][] = $barang;
            }
        }

        return view('user/cart/index', $data);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart') ?? [];

        unset($cart[$id]);

        session()->set('cart', $cart);

        return redirect()->to('/user/cart');
    }

    public function updateCart($id)
    {
        $qty = $this->request->getPost('qty');
        
        $cart = session()->get('cart') ?? [];
        
        if (isset($cart[$id])) {
            $cart[$id] = $qty;
            session()->set('cart', $cart);
        }
        
        return $this->response->setJSON(['success' => true]);
    }

    public function checkoutForm()
    {
        $cart = session()->get('cart') ?? [];
        
        if (empty($cart)) {
            return redirect()->to('/user/produk');
        }
        
        $barangModel = new BarangModel();
        
        $items = [];
        $total = 0;
        
        foreach ($cart as $id => $qty) {
            $barang = $barangModel->find($id);
            if ($barang) {
                $barang['qty'] = $qty;
                $items[] = $barang;
                $total += $barang['harga'] * $qty;
            }
        }
        
        $data['items'] = $items;
        $data['total'] = $total;
        
        return view('user/checkout/index', $data);
    }

    public function processCheckout()
    {
        // Ambil data dari form
        $nama_penerima = $this->request->getPost('nama_penerima');
        $telepon = $this->request->getPost('telepon');
        $alamat = $this->request->getPost('alamat');
        $kota = $this->request->getPost('kota');
        $kode_pos = $this->request->getPost('kode_pos');
        $pengiriman = $this->request->getPost('pengiriman');
        $pembayaran = $this->request->getPost('pembayaran');
        
        // Hitung ongkir
        $ongkir = ($pengiriman == 'reguler') ? 15000 : 30000;
        
        // Ambil cart dari session
        $cart = session()->get('cart') ?? [];
        
        if (empty($cart)) {
            return redirect()->to('/user/produk');
        }
        
        $barangModel = new BarangModel();
        $penjualanModel = new \App\Models\PenjualanModel();
        
        // ===== CARI ID PELANGGAN =====
        $db = \Config\Database::connect();
        $query = $db->table('tb_pelanggan')
                    ->where('id_users', session()->get('id_users'))
                    ->get();
        $pelanggan = $query->getRowArray();
        
        // Kalo belum ada pelanggan, insert dulu
        if (!$pelanggan) {
            $db->table('tb_pelanggan')->insert([
                'nama_pelanggan' => session()->get('nama') ?? 'Customer',
                'telepon' => $telepon,
                'alamat' => $alamat . ', ' . $kota . ' ' . $kode_pos,
                'id_users' => session()->get('id_users')
            ]);
            $id_pelanggan = $db->insertID();
        } else {
            $id_pelanggan = $pelanggan['id_pelanggan'];
        }
        
        // ===== HITUNG TOTAL SEMUA ITEM =====
        $subtotal = 0;
        foreach ($cart as $id => $qty) {
            $barang = $barangModel->find($id);
            if ($barang) {
                $subtotal += $barang['harga'] * $qty;
            }
        }
        $total_keseluruhan = $subtotal + $ongkir;
        
        // Gabung alamat lengkap
        $alamat_lengkap = $alamat . ', ' . $kota . ' ' . $kode_pos;
        
        // ===== INSERT PER ITEM BARANG =====
        foreach ($cart as $id => $qty) {
            $barang = $barangModel->find($id);
            if ($barang) {
                // Insert satu per satu barang
                $penjualanModel->save([
                    'tanggal' => date('Y-m-d'),
                    'id_barang' => $id,
                    'id_kategori' => $barang['id_kategori'],
                    'id_pelanggan' => $id_pelanggan,  // <- PAKE ID PELANGGAN YANG ASLI
                    'id_users' => session()->get('id_users'),
                    'jumlah' => $qty,
                    'harga' => $barang['harga'],
                    'total' => $barang['harga'] * $qty, // total per item (TANPA ongkir)
                    'status' => 'pending',
                    'alamat_pengiriman' => $alamat_lengkap,
                    'telepon' => $telepon,
                    'pengiriman' => $pengiriman,
                    'pembayaran' => $pembayaran,
                    'nama_penerima' => $nama_penerima
                ]);
            }
        }
        
        // Kosongkan cart
        session()->remove('cart');
        
        session()->setFlashdata('success', 'Pesanan berhasil dibuat!');
        return redirect()->to('/user/pesanan');
    }

    // ===== METHOD LAMA (HAPUS ATAU COMMENT) =====
    /*
    public function checkout()
    {
        $cart = session()->get('cart') ?? [];

        if (!$cart) {
            return redirect()->to('/user/produk');
        }

        $penjualanModel = new \App\Models\PenjualanModel();
        $barangModel    = new \App\Models\BarangModel();

        $total = 0;

        foreach ($cart as $id => $qty) {
            $barang = $barangModel->find($id);
            if ($barang) {
                $total += $barang['harga'] * $qty;
            }
        }

        $penjualanModel->save([
            'id_users' => session()->get('id_users'),
            'total'    => $total,
            'status'   => 'pending'  
        ]);

        session()->remove('cart');

        return redirect()->to('/user/dashboard');
    }
    */

    
}