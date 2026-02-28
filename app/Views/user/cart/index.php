<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | MateriaPro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: { primary: '#f48c25', darkBody: '#0f172a', darkCard: '#1e293b' }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-8">
            <h2 class="text-4xl font-black tracking-tight leading-tight uppercase">
                Keranjang <span class="text-primary italic">Belanja</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Review pesanan Anda sebelum checkout.</p>
        </div>

        <?php if(empty($items)): ?>
            <!-- KERANJANG KOSONG -->
            <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-20 text-center">
                <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-cart" class="w-12 h-12 text-slate-300"></i>
                </div>
                <h3 class="text-2xl font-black mb-2">Keranjang Kosong</h3>
                <p class="text-slate-400 mb-6">Belum ada produk yang ditambahkan ke keranjang</p>
                <a href="<?= base_url('/user/produk'); ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white rounded-2xl font-black hover:bg-orange-600 transition-all">
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                    MULAI BELANJA
                </a>
            </div>
        <?php else: ?>
            <!-- KERANJANG ADA ISI -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- DAFTAR PRODUK DI KERANJANG -->
                <div class="lg:col-span-2 space-y-4">
                    <?php foreach($items as $item): ?>
                    <div class="cart-item bg-white dark:bg-darkCard rounded-2xl border border-slate-200 dark:border-slate-800 p-6 flex flex-col sm:flex-row gap-6 hover:border-primary transition-all" data-id="<?= $item['id'] ?>">
                        
                        <!-- GAMBAR PRODUK -->
                        <div class="w-24 h-24 rounded-xl bg-slate-100 dark:bg-slate-800 overflow-hidden flex-shrink-0">
                            <?php 
                                $foto = $item['foto'] ?? '';
                                $urlFoto = (!empty($foto) && file_exists(FCPATH . 'uploads/' . $foto)) 
                                           ? base_url('uploads/' . $foto) 
                                           : 'https://via.placeholder.com/100x100?text=No+Image';
                            ?>
                            <img src="<?= $urlFoto ?>" alt="<?= $item['nama_barang'] ?>" class="w-full h-full object-cover">
                        </div>

                        <!-- INFO PRODUK -->
                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-3">
                                <div>
                                    <p class="text-[10px] font-black text-primary uppercase tracking-widest"><?= $item['kategori'] ?? 'Material' ?></p>
                                    <h3 class="font-black text-lg"><?= $item['nama_barang'] ?></h3>
                                </div>
                                <p class="text-primary font-black text-xl">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            </div>

                            <div class="flex items-center justify-between">
                                <!-- INPUT JUMLAH -->
                                <div class="flex items-center gap-3">
                                    <button onclick="updateQty(<?= $item['id'] ?>, 'decrease')" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                                        <i data-lucide="minus" class="w-4 h-4"></i>
                                    </button>
                                    
                                    <input type="number" id="qty-<?= $item['id'] ?>" value="<?= $item['qty'] ?>" min="1" max="<?= $item['stok'] ?>" 
                                           class="w-16 text-center bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl py-2 font-black"
                                           onchange="updateQty(<?= $item['id'] ?>, 'set', this.value)">
                                    
                                    <button onclick="updateQty(<?= $item['id'] ?>, 'increase')" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-all">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                    </button>
                                </div>

                                <!-- SUBTOTAL & HAPUS -->
                                <div class="flex items-center gap-4">
                                    <p class="font-black text-slate-600 dark:text-slate-300">
                                        Sub: <span class="text-primary" id="subtotal-<?= $item['id'] ?>">Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.') ?></span>
                                    </p>
                                    <button onclick="removeItem(<?= $item['id'] ?>)" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition-all">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- RINGKASAN BELANJA -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-darkCard rounded-2xl border border-slate-200 dark:border-slate-800 p-6 sticky top-24">
                        <h3 class="font-black text-lg mb-6 flex items-center gap-2">
                            <i data-lucide="receipt" class="w-5 h-5 text-primary"></i>
                            Ringkasan Belanja
                        </h3>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400">Total Harga</span>
                                <span class="font-black" id="totalHarga">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400">Total Item</span>
                                <span class="font-black" id="totalItem"><?= array_sum(array_column($items, 'qty')) ?></span>
                            </div>
                        </div>

                        <a href="<?= base_url('/user/checkout') ?>" 
                           class="block w-full text-center py-4 bg-primary text-white rounded-xl font-black hover:bg-orange-600 transition-all mb-3"
                           onclick="return confirmCheckout()">
                            <i data-lucide="shopping-bag" class="w-5 h-5 inline mr-2"></i>
                            CHECKOUT SEKARANG
                        </a>

                        <a href="<?= base_url('/user/produk') ?>" class="block w-full text-center py-4 bg-slate-100 dark:bg-slate-800 rounded-xl font-black hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                            LANJUT BELANJA
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <script>
        lucide.createIcons();

        // UPDATE JUMLAH
        function updateQty(id, action, value = null) {
            let qtyInput = document.getElementById('qty-' + id);
            let currentQty = parseInt(qtyInput.value);
            
            if (action === 'increase') {
                newQty = currentQty + 1;
            } else if (action === 'decrease') {
                newQty = currentQty - 1;
                if (newQty < 1) newQty = 1;
            } else if (action === 'set') {
                newQty = parseInt(value);
                if (newQty < 1) newQty = 1;
            }

            // Cek stok (dari max attribute)
            let maxStok = parseInt(qtyInput.getAttribute('max'));
            if (newQty > maxStok) {
                Swal.fire({
                    icon: 'error',
                    title: 'Stok Tidak Cukup',
                    text: 'Stok tersedia hanya ' + maxStok + ' unit',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    borderRadius: '2rem'
                });
                return;
            }

            // Kirim ke server via AJAX
            fetch('<?= base_url("/user/update-cart") ?>/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'qty=' + newQty
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update tampilan
                    qtyInput.value = newQty;
                    
                    // Update subtotal
                    let harga = <?= json_encode(array_column($items, 'harga', 'id')) ?>;
                    let subtotal = harga[id] * newQty;
                    document.getElementById('subtotal-' + id).innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                    
                    // Update total
                    location.reload(); // Simple: reload aja
                }
            });
        }

        // HAPUS ITEM
        function removeItem(id) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Produk akan dihapus dari keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, HAPUS!',
                cancelButtonText: 'BATAL',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url("/user/remove/") ?>' + id;
                }
            });
        }

        // KONFIRMASI CHECKOUT
        function confirmCheckout() {
            Swal.fire({
                title: 'Proses Checkout?',
                text: "Pastikan pesanan Anda sudah benar",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, CHECKOUT!',
                cancelButtonText: 'BATAL',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url("/user/checkout") ?>';
                }
            });
            return false;
        }
    </script>
</body>
</html>