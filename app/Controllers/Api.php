<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;

class Api extends ResourceController
{
    protected $format = 'json';

    // ======================
    // API AUTH
    // ======================
    
    /**
     * POST /api/login
     * Body: username, password
     */
    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        
        if (!$username || !$password) {
            return $this->fail('Username dan password wajib diisi', 400);
        }
        
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();
        
        if (!$user || $user['password'] != $password) {
            return $this->failUnauthorized('Username atau password salah');
        }
        
        // Set session
        session()->set([
            'id_users' => $user['id_users'],
            'nama' => $user['nama_pengguna'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true
        ]);
        
        // Response tanpa password
        $data = [
            'id_users' => $user['id_users'],
            'nama_pengguna' => $user['nama_pengguna'],
            'username' => $user['username'],
            'role' => $user['role'],
            'status_user' => $user['status_user']
        ];
        
        return $this->respond([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => $data
        ], 200);
    }

    /**
     * POST /api/logout
     */
    public function logout()
    {
        session()->destroy();
        
        return $this->respond([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ], 200);
    }

    // ======================
    // API PRODUK
    // ======================
    
    /**
     * GET /api/produk
     * Query params: ?search=&kategori=&limit=&page=
     */
    public function getProduk()
    {
        $barangModel = new BarangModel();
        $db = \Config\Database::connect();
        
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $limit = $this->request->getGet('limit') ?? 10;
        $page = $this->request->getGet('page') ?? 1;
        $offset = ($page - 1) * $limit;
        
        $builder = $db->table('tb_barang');
        $builder->select('tb_barang.id, tb_barang.nama_barang, tb_barang.harga, tb_barang.stok, tb_barang.foto, tb_barang.deskripsi, tb_kategori.nama_kategori');
        $builder->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        
        if ($search) {
            $builder->like('tb_barang.nama_barang', $search);
        }
        
        if ($kategori) {
            $builder->where('tb_kategori.nama_kategori', $kategori);
        }
        
        $total = $builder->countAllResults(false);
        $builder->limit($limit, $offset);
        $produk = $builder->get()->getResultArray();
        
        // Format foto
        foreach ($produk as &$p) {
            if (!empty($p['foto']) && file_exists(FCPATH . 'uploads/' . $p['foto'])) {
                $p['foto_url'] = base_url('uploads/' . $p['foto']);
            } else {
                $p['foto_url'] = null;
            }
            unset($p['foto']); // hapus field foto asli
        }
        
        return $this->respond([
            'status' => 'success',
            'data' => $produk,
            'pagination' => [
                'total' => $total,
                'per_page' => $limit,
                'current_page' => $page,
                'last_page' => ceil($total / $limit)
            ]
        ], 200);
    }

    /**
     * GET /api/produk/(:num)
     */
    public function getProdukDetail($id)
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('tb_barang');
        $builder->select('tb_barang.id, tb_barang.nama_barang, tb_barang.harga, tb_barang.stok, tb_barang.foto, tb_barang.deskripsi, tb_kategori.nama_kategori');
        $builder->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $builder->where('tb_barang.id', $id);
        
        $produk = $builder->get()->getRowArray();
        
        if (!$produk) {
            return $this->failNotFound('Produk tidak ditemukan');
        }
        
        // Format foto
        if (!empty($produk['foto']) && file_exists(FCPATH . 'uploads/' . $produk['foto'])) {
            $produk['foto_url'] = base_url('uploads/' . $produk['foto']);
        } else {
            $produk['foto_url'] = null;
        }
        unset($produk['foto']);
        
        // Produk terkait
        $builderTerkait = $db->table('tb_barang');
        $builderTerkait->select('tb_barang.id, tb_barang.nama_barang, tb_barang.harga, tb_barang.foto, tb_kategori.nama_kategori');
        $builderTerkait->join('tb_kategori', 'tb_barang.id_kategori = tb_kategori.id_kategori', 'left');
        $builderTerkait->where('tb_barang.id_kategori', $produk['id_kategori'] ?? 0);
        $builderTerkait->where('tb_barang.id !=', $id);
        $builderTerkait->limit(4);
        $terkait = $builderTerkait->get()->getResultArray();
        
        // Format foto terkait
        foreach ($terkait as &$t) {
            if (!empty($t['foto']) && file_exists(FCPATH . 'uploads/' . $t['foto'])) {
                $t['foto_url'] = base_url('uploads/' . $t['foto']);
            } else {
                $t['foto_url'] = null;
            }
            unset($t['foto']);
        }
        
        return $this->respond([
            'status' => 'success',
            'data' => $produk,
            'terkait' => $terkait
        ], 200);
    }

    // ======================
    // API KERANJANG
    // ======================
    
    /**
     * GET /api/cart
     */
public function getCart()
{
    // CEK LOGIN DULU!
    $id_users = session()->get('id_users');
    if (!$id_users) {
        return $this->failUnauthorized('Harus login untuk melihat keranjang');
    }
    
    $cart = session()->get('cart') ?? [];
    $barangModel = new BarangModel();
    
    $items = [];
    $total = 0;
    
    foreach ($cart as $id => $qty) {
        $barang = $barangModel->find($id);
        if ($barang) {
            $foto_url = null;
            if (!empty($barang['foto']) && file_exists(FCPATH . 'uploads/' . $barang['foto'])) {
                $foto_url = base_url('uploads/' . $barang['foto']);
            }
            
            $items[] = [
                'id' => $barang['id'],
                'nama_barang' => $barang['nama_barang'],
                'harga' => $barang['harga'],
                'qty' => $qty,
                'subtotal' => $barang['harga'] * $qty,
                'foto_url' => $foto_url,
                'stok' => $barang['stok']
            ];
            $total += $barang['harga'] * $qty;
        }
    }
    
    return $this->respond([
        'status' => 'success',
        'data' => [
            'items' => $items,
            'total' => $total,
            'total_item' => count($items)
        ]
    ], 200);
}

    /**
     * POST /api/cart/add/(:num)
     */
    public function addToCart($id)
{
    // CEK LOGIN
    $id_users = session()->get('id_users');
    if (!$id_users) {
        return $this->failUnauthorized('Harus login');
    }
    
    $barangModel = new BarangModel();
    $barang = $barangModel->find($id);
    
    if (!$barang) {
        return $this->failNotFound('Produk tidak ditemukan');
    }
    
    $cart = session()->get('cart') ?? [];
    $cart[$id] = ($cart[$id] ?? 0) + 1;
    session()->set('cart', $cart);
    
    return $this->respond([
        'status' => 'success',
        'message' => 'Produk ditambahkan ke keranjang',
        'data' => ['cart_count' => count($cart)]
    ], 200);
}

    /**
     * POST /api/cart/update/(:num)
     * Body: qty
     */
    public function updateCart($id)
{
    // CEK LOGIN
    $id_users = session()->get('id_users');
    if (!$id_users) {
        return $this->failUnauthorized('Harus login');
    }
    
    $qty = $this->request->getPost('qty');
    
    if (!$qty || $qty < 1) {
        return $this->fail('Jumlah harus lebih dari 0', 400);
    }
    
    $barangModel = new BarangModel();
    $barang = $barangModel->find($id);
    
    if (!$barang) {
        return $this->failNotFound('Produk tidak ditemukan');
    }
    
    if ($qty > $barang['stok']) {
        return $this->fail('Stok tidak mencukupi. Stok tersedia: ' . $barang['stok'], 400);
    }
    
    $cart = session()->get('cart') ?? [];
    
    if (!isset($cart[$id])) {
        return $this->failNotFound('Produk tidak ada di keranjang');
    }
    
    $cart[$id] = $qty;
    session()->set('cart', $cart);
    
    return $this->respond([
        'status' => 'success',
        'message' => 'Keranjang diperbarui'
    ], 200);
}

    /**
     * DELETE /api/cart/remove/(:num)
     */
    public function removeFromCart($id)
{
    // CEK LOGIN
    $id_users = session()->get('id_users');
    if (!$id_users) {
        return $this->failUnauthorized('Harus login');
    }
    
    $cart = session()->get('cart') ?? [];
    
    if (!isset($cart[$id])) {
        return $this->failNotFound('Produk tidak ada di keranjang');
    }
    
    unset($cart[$id]);
    session()->set('cart', $cart);
    
    return $this->respond([
        'status' => 'success',
        'message' => 'Produk dihapus dari keranjang'
    ], 200);
}

    // ======================
    // API PESANAN
    // ======================
    
    /**
     * GET /api/pesanan
     */
    public function getPesanan()
{
    $id_users = session()->get('id_users');
    if (!$id_users) {
        return $this->failUnauthorized('Harus login');
    }
    
    $db = \Config\Database::connect();
    
    $builder = $db->table('tb_penjualan');
    $builder->select('tb_penjualan.id_penjualan, tb_penjualan.tanggal, tb_penjualan.total, tb_penjualan.status, tb_barang.nama_barang, tb_penjualan.jumlah');
    $builder->join('tb_barang', 'tb_barang.id = tb_penjualan.id_barang', 'left');
    $builder->where('tb_penjualan.id_users', $id_users);
    $builder->orderBy('tb_penjualan.tanggal', 'DESC');
    
    $pesanan = $builder->get()->getResultArray();
    
    // Kelompokkan berdasarkan id_penjualan
    $grouped = [];
    foreach ($pesanan as $p) {
        $id = $p['id_penjualan'];
        if (!isset($grouped[$id])) {
            $grouped[$id] = [
                'id_penjualan' => $id,
                'tanggal' => $p['tanggal'],
                'total' => $p['total'],
                'status' => $p['status'],
                'items' => []
            ];
        }
        $grouped[$id]['items'][] = [
            'nama_barang' => $p['nama_barang'],
            'jumlah' => $p['jumlah']
        ];
    }
    
    return $this->respond([
        'status' => 'success',
        'data' => array_values($grouped)
    ], 200);
}

    /**
     * GET /api/pesanan/(:num)
     */
    public function getPesananDetail($id)
    {
        $id_users = session()->get('id_users');
        if (!$id_users) {
            return $this->failUnauthorized('Harus login');
        }
        
        $db = \Config\Database::connect();
        
        $builder = $db->table('tb_penjualan');
        $builder->select('tb_penjualan.*, tb_barang.nama_barang, tb_barang.foto, tb_kategori.nama_kategori');
        $builder->join('tb_barang', 'tb_barang.id = tb_penjualan.id_barang', 'left');
        $builder->join('tb_kategori', 'tb_kategori.id_kategori = tb_penjualan.id_kategori', 'left');
        $builder->where('tb_penjualan.id_penjualan', $id);
        $builder->where('tb_penjualan.id_users', $id_users);
        
        $items = $builder->get()->getResultArray();
        
        if (empty($items)) {
            return $this->failNotFound('Pesanan tidak ditemukan');
        }
        
        $header = $items[0];
        
        // Format foto
        foreach ($items as &$item) {
            if (!empty($item['foto']) && file_exists(FCPATH . 'uploads/' . $item['foto'])) {
                $item['foto_url'] = base_url('uploads/' . $item['foto']);
            } else {
                $item['foto_url'] = null;
            }
            unset($item['foto']);
        }
        
        $data = [
            'id_penjualan' => $header['id_penjualan'],
            'tanggal' => $header['tanggal'],
            'status' => $header['status'],
            'total' => $header['total'],
            'alamat_pengiriman' => $header['alamat_pengiriman'],
            'telepon' => $header['telepon'],
            'pengiriman' => $header['pengiriman'],
            'pembayaran' => $header['pembayaran'],
            'nama_penerima' => $header['nama_penerima'],
            'items' => $items
        ];
        
        return $this->respond([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function test()
{
    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'API test berhasil',
        'time' => date('Y-m-d H:i:s')
    ]);
}
    
}