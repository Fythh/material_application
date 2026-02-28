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
    $barangModel = new \App\Models\BarangModel();
    $barang = $barangModel->find($id);
    
    if (!$barang) {
        return $this->response->setJSON(['success' => false, 'message' => 'Produk ga ada, Bro!']);
    }

    $qty = (int)($this->request->getPost('qty') ?: 1);
    $cart = session()->get('cart') ?? [];
    
    $currentQtyInCart = isset($cart[$id]) ? $cart[$id] : 0;
    $totalQtyRequested = $currentQtyInCart + $qty;
    
    if ($totalQtyRequested > $barang['stok']) {
        return $this->response->setJSON([
            'success' => false, 
            'message' => "Stok sisa {$barang['stok']}. Di cart lo udah ada {$currentQtyInCart}."
        ]);
    }
    
    $cart[$id] = $totalQtyRequested;
    session()->set('cart', $cart);
    
    // Sinyal Flashdata untuk cadangan (jika user refresh manual)
    session()->setFlashdata('cart_added', true);

    if ($this->request->isAJAX()) {
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Mantap! Produk masuk keranjang.',
            'total_items' => count($cart) // Ini yang dibaca Navbar nanti
        ]);
    }

    return redirect()->to('/user/cart')->with('success', 'Berhasil ditambah ke keranjang');
}

    public function cart()
    {

        $this->response->setHeader('Cache-Control', 'no-store, max-age=0, no-cache');
        $this->response->setHeader('Pragma', 'no-cache');

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

   public function remove_batch()
{
    // 1. Ambil list ID dari URL (contoh: 1,4,7)
    $ids_string = $this->request->getGet('ids');

    if ($ids_string) {
        $ids_to_remove = explode(',', $ids_string);
        
        // 2. Ambil data keranjang yang ada di session sekarang
        // Sesuaikan 'cart' dengan nama key session yang lo pake (misal: 'keranjang')
        $cart = session()->get('cart') ?? [];

        // 3. Looping ID yang mau dihapus
        foreach ($ids_to_remove as $id) {
            if (isset($cart[$id])) {
                unset($cart[$id]); // Hapus item dari array
            }
        }

        // 4. Simpan lagi array yang udah "bersih" ke session
        session()->set('cart', $cart);

        return redirect()->to('/user/cart')->with('success', count($ids_to_remove) . ' material berhasil dibuang.');
    }

    return redirect()->to('/user/cart')->with('error', 'Gagal menghapus, pilih barang dulu.');
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