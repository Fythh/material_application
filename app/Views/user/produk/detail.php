<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produk['nama_barang'] ?? 'Detail Produk'; ?> | MateriaPro</title>
    
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
                    colors: {
                        primary: '#f48c25',
                        darkBody: '#0f172a',
                        darkCard: '#1e293b'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        
        <!-- BREADCRUMB -->
        <div class="flex items-center gap-2 text-sm mb-8">
            <a href="<?= base_url('/user/dashboard'); ?>" class="text-slate-400 hover:text-primary">Dashboard</a>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
            <a href="<?= base_url('/user/produk'); ?>" class="text-slate-400 hover:text-primary">Produk</a>
            <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
            <span class="text-primary font-medium"><?= $produk['nama_barang'] ?? 'Detail'; ?></span>
        </div>

        <!-- DETAIL PRODUK -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
            
            <!-- GAMBAR PRODUK -->
            <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 overflow-hidden">
                <?php 
                    $namaFoto = $produk['foto'] ?? '';
                    $urlFoto = (!empty($namaFoto) && file_exists(FCPATH . 'uploads/' . $namaFoto)) 
                               ? base_url('uploads/' . $namaFoto) 
                               : 'https://via.placeholder.com/600x600?text=No+Image';
                ?>
                <img src="<?= $urlFoto; ?>" alt="<?= $produk['nama_barang'] ?? 'Produk'; ?>" class="w-full h-full object-cover">
            </div>

            <!-- INFO PRODUK -->
            <div>
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                    <?= $produk['kategori'] ?? 'Material'; ?>
                </span>
                
                <h1 class="text-4xl md:text-5xl font-black text-slate-800 dark:text-white leading-tight tracking-tighter mb-6">
                    <?= $produk['nama_barang'] ?? 'Produk Tidak Diketahui'; ?>
                </h1>
                
                <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                    <?= $produk['deskripsi'] ?? 'Tidak ada deskripsi untuk produk ini.'; ?>
                </p>

                <div class="bg-slate-100 dark:bg-slate-800/50 rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-slate-400 font-medium">Stok Tersedia</span>
                        <span class="font-black text-2xl <?= ($produk['stok'] ?? 0) > 0 ? 'text-green-500' : 'text-red-500'; ?>">
                            <?= $produk['stok'] ?? 0; ?> unit
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 font-medium">Harga</span>
                        <span class="text-primary font-black text-3xl italic">
                            Rp<?= number_format($produk['harga'] ?? 0, 0, ',', '.'); ?>
                        </span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- TOMBOL TAMBAH KE CART (LANGSUNG KE CART) -->
                    <a href="<?= base_url('/user/add-to-cart/' . ($produk['id'] ?? 0)); ?>" 
                       class="flex-1 inline-flex items-center justify-center gap-3 px-8 py-4 bg-primary hover:bg-orange-600 text-white rounded-2xl font-black text-sm transition-all hover:scale-105 shadow-xl shadow-orange-500/20">
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        TAMBAH KE CART
                    </a>
                    
                    <!-- TOMBOL BELI SEKARANG (POPUP JUMLAH) -->
                    <button onclick="beliSekarang(<?= $produk['id'] ?? 0 ?>, <?= $produk['stok'] ?? 0 ?>)" 
                            class="flex-1 inline-flex items-center justify-center gap-3 px-8 py-4 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-black text-sm transition-all hover:scale-105 shadow-xl shadow-green-600/20">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                        BELI SEKARANG
                    </button>
                </div>
                
                <!-- TOMBOL KEMBALI (DIPISAH) -->
                <div class="mt-4">
                    <a href="<?= base_url('/user/produk'); ?>" 
                       class="flex items-center justify-center gap-2 px-8 py-4 bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-white rounded-2xl font-black text-sm transition-all w-full">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        KEMBALI KE PRODUK
                    </a>
                </div>
            </div>
        </div>

        <!-- PRODUK TERKAIT -->
        <?php if (!empty($produk_terkait)): ?>
        <section>
            <h2 class="text-2xl font-black uppercase italic mb-8">Produk <span class="text-primary">Terkait</span></h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($produk_terkait as $p): ?>
                <a href="<?= base_url('/user/produk/detail/' . ($p['id'] ?? 0)); ?>" class="group bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 overflow-hidden hover:border-primary transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-orange-500/10">
                    
                    <div class="relative h-48 overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <?php 
                            $fotoTerkait = $p['foto'] ?? '';
                            $urlTerkait = (!empty($fotoTerkait) && file_exists(FCPATH . 'uploads/' . $fotoTerkait)) 
                                       ? base_url('uploads/' . $fotoTerkait) 
                                       : 'https://via.placeholder.com/400x400?text=No+Image';
                        ?>
                        <img src="<?= $urlTerkait; ?>" alt="<?= $p['nama_barang'] ?? 'Produk'; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>

                    <div class="p-4">
                        <h3 class="font-black text-base text-slate-800 dark:text-white mb-2 group-hover:text-primary transition-colors">
                            <?= $p['nama_barang'] ?? 'Produk'; ?>
                        </h3>
                        <p class="text-primary font-black text-lg italic">
                            Rp<?= number_format($p['harga'] ?? 0, 0, ',', '.'); ?>
                        </p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- KALO GA ADA PRODUK TERKAIT -->
        <?php if (empty($produk_terkait) && isset($produk['kategori'])): ?>
        <div class="text-center py-10">
            <p class="text-slate-400">Belum ada produk terkait dalam kategori ini</p>
        </div>
        <?php endif; ?>

    </main>

    <footer class="mt-20 py-10 border-t border-slate-200 dark:border-slate-800 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">MateriaPro &bull; 2026</p>
    </footer>

    <script>
        lucide.createIcons();
        
        // FUNGSI BELI SEKARANG
        function beliSekarang(id, stok) {
            if (stok <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Stok Habis',
                    text: 'Maaf, produk ini sedang habis',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    borderRadius: '2rem'
                });
                return;
            }
            
            Swal.fire({
                title: 'Masukkan Jumlah',
                html: `
                    <div class="mt-4">
                        <input type="number" id="qty" class="w-full px-4 py-3 text-center text-2xl font-black bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl" 
                               value="1" min="1" max="${stok}" step="1">
                        <p class="text-sm text-slate-400 mt-2">Stok tersedia: ${stok} unit</p>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'BELI SEKARANG',
                cancelButtonText: 'BATAL',
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#64748b',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem',
                preConfirm: () => {
                    const qty = document.getElementById('qty').value;
                    if (qty < 1 || qty > stok) {
                        Swal.showValidationMessage(`Jumlah harus antara 1 - ${stok}`);
                        return false;
                    }
                    return qty;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const qty = result.value;
                    
                    // Tambah ke cart dengan jumlah tertentu
                    fetch('<?= base_url("/user/add-to-cart/") ?>' + id, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'qty=' + qty
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirect langsung ke checkout
                            window.location.href = '<?= base_url("/user/checkout") ?>';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Terjadi kesalahan',
                                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                                borderRadius: '2rem'
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>