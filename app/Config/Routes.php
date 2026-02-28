<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =======================
// PUBLIC (TANPA LOGIN)
// =======================
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout');

// API ROUTES - TANPA FILTER AUTH!
$routes->group('api', function($routes) {
    
    // API Produk (public)
    $routes->get('produk', 'Api::getProduk');
    $routes->get('produk/(:num)', 'Api::getProdukDetail/$1');
    
    // API Auth (public)
    $routes->post('login', 'Api::login');
    $routes->post('logout', 'Api::logout');
    
    // API Test (public)
    $routes->get('test', 'Api::test');
    
    // API Keranjang - butuh login (nanti dicek di controller)
    $routes->get('cart', 'Api::getCart');
    $routes->post('cart/add/(:num)', 'Api::addToCart/$1');
    $routes->post('cart/update/(:num)', 'Api::updateCart/$1');
    $routes->delete('cart/remove/(:num)', 'Api::removeFromCart/$1');
    
    // API Pesanan - butuh login
    $routes->get('pesanan', 'Api::getPesanan');
    $routes->get('pesanan/(:num)', 'Api::getPesananDetail/$1');
});

// PROTECTED ROUTES (WAJIB LOGIN) - PAKAI FILTER AUTH
$routes->group('', ['filter' => 'auth'], function($routes) {

    // ===== REDIRECT KHUSUS =====
    $routes->get('/produk', function() {
        return redirect()->to('/user/produk');
    });

    // ================= ADMIN AREA =================
    $routes->get('/dashboard', 'Dashboard::admin');
    
    // ================= BARANG =================
    $routes->get('/barang', 'Barang::index');
    $routes->get('/barang/create', 'Barang::create');
    $routes->post('/barang/store', 'Barang::store');
    $routes->get('/barang/delete/(:num)', 'Barang::delete/$1');
    $routes->get('/barang/edit/(:num)', 'Barang::edit/$1');
    $routes->post('/barang/update/(:num)', 'Barang::update/$1');
    $routes->get('/barang/detail/(:num)', 'Barang::detail/$1');

    // ================= KATEGORI =================
    $routes->get('/kategori', 'Kategori::index');
    $routes->get('/kategori/create', 'Kategori::create');
    $routes->post('/kategori/store', 'Kategori::store');
    $routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1');
    $routes->post('/kategori/update/(:num)', 'Kategori::update/$1');
    $routes->get('/kategori/delete/(:num)', 'Kategori::delete/$1');

    // ================= PELANGGAN =================
    $routes->get('/pelanggan', 'Pelanggan::index');
    $routes->get('/pelanggan/create', 'Pelanggan::create');
    $routes->post('/pelanggan/store', 'Pelanggan::store');
    $routes->get('/pelanggan/edit/(:num)', 'Pelanggan::edit/$1');
    $routes->post('/pelanggan/update/(:num)', 'Pelanggan::update/$1');
    $routes->get('/pelanggan/delete/(:num)', 'Pelanggan::delete/$1');

    // ================= PENJUALAN =================
    $routes->get('/penjualan', 'Penjualan::index');
    $routes->get('/penjualan/delete/(:num)', 'Penjualan::delete/$1');
    $routes->post('/penjualan/update-status/(:num)', 'Penjualan::updateStatus/$1');

    // ================= USER AREA =================
    $routes->group('user', function($routes) {
        
        // ===== HALAMAN UTAMA =====
        $routes->get('/', 'Dashboard::user');
        $routes->get('dashboard', 'Dashboard::user');
        $routes->get('produk', 'Dashboard::userProduk');
        $routes->get('pesanan', 'Dashboard::userPesanan');
        $routes->get('profil', 'Dashboard::userProfil');
        
        // ===== DETAIL =====
        $routes->get('produk/detail/(:num)', 'Dashboard::userProdukDetail/$1');
        $routes->get('pesanan/detail/(:num)', 'Dashboard::userPesananDetail/$1');

        $routes->get('pesanan/batalkanPesanan/(:num)', 'Dashboard::batalkanPesanan/$1');
        
        // ===== CART =====
        $routes->get('add-to-cart/(:num)', 'User::addToCart/$1');
        $routes->post('add-to-cart/(:num)', 'User::addToCart/$1');
        $routes->get('cart', 'User::cart');
        $routes->post('update-cart/(:num)', 'User::updateCart/$1');
        $routes->get('remove/(:num)', 'User::removeFromCart/$1');
        $routes->get('checkout', 'User::checkoutForm');
        $routes->post('process-checkout', 'User::processCheckout');
    });
    
});