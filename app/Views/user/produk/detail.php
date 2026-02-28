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
                    colors: { primary: '#f48c25', darkBody: '#0f172a', darkCard: '#1e293b' }
                }
            }
        }
    </script>
    <style>
        .glass-card { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(10px); }
        .product-image-container { max-height: 500px; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #f48c25; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen selection:bg-primary selection:text-white">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-6xl mx-auto px-6 py-10">
        
        <nav class="flex items-center gap-3 text-[10px] font-bold uppercase tracking-widest mb-10 opacity-60">
            <a href="<?= base_url('/user/dashboard'); ?>" class="hover:text-primary transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="<?= base_url('/user/produk'); ?>" class="hover:text-primary transition-colors">Catalog</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-primary"><?= $produk['nama_barang']; ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-5 sticky top-24">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-orange-600 rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                    <div class="relative bg-white dark:bg-darkCard rounded-[2rem] border-2 border-slate-100 dark:border-slate-800 overflow-hidden shadow-2xl">
                        <?php 
                            $namaFoto = $produk['foto'] ?? '';
                            $urlFoto = (!empty($namaFoto) && file_exists(FCPATH . 'uploads/' . $namaFoto)) 
                                    ? base_url('uploads/' . $namaFoto) 
                                    : 'https://via.placeholder.com/600x600?text=No+Image';
                        ?>
                        <img src="<?= $urlFoto; ?>" class="w-full aspect-square object-cover transform transition-transform duration-700 group-hover:scale-110">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-primary text-white text-[9px] font-black uppercase tracking-tighter rounded-md">
                            <?= $produk['nama_kategori'] ?? 'Premium'; ?>
                        </span>
                        <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest italic">Authentic Material</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-black text-slate-800 dark:text-white leading-[1.1] tracking-tighter mb-4 uppercase italic">
                        <?= $produk['nama_barang']; ?>
                    </h1>
                    
                    <p class="text-slate-500 dark:text-slate-400 text-base leading-relaxed max-w-xl">
                        <?= $produk['deskripsi'] ?? 'Material konstruksi pilihan dengan standar kualitas internasional untuk durabilitas maksimal proyek Anda.'; ?>
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white dark:bg-darkCard p-5 rounded-3xl border-2 border-slate-50 dark:border-slate-800 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Available Stock</p>
                        <p class="text-2xl font-black <?= ($produk['stok'] > 0) ? 'text-green-500' : 'text-red-500'; ?>">
                            <?= $produk['stok']; ?> <span class="text-xs text-slate-400 font-medium">Units</span>
                        </p>
                    </div>
                    <div class="bg-white dark:bg-darkCard p-5 rounded-3xl border-2 border-slate-50 dark:border-slate-800 shadow-sm">
                        <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Price per Unit</p>
                        <p class="text-2xl font-black text-primary italic">
                            Rp<?= number_format($produk['harga'], 0, ',', '.'); ?>
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 mt-4">
                    <div class="flex gap-3">
                        <a href="<?= base_url('/user/add-to-cart/' . $produk['id']); ?>" 
                           class="flex-1 h-16 inline-flex items-center justify-center gap-3 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-2xl font-black text-xs uppercase tracking-widest transition-all hover:bg-primary dark:hover:bg-primary dark:hover:text-white hover:-translate-y-1 shadow-xl">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                            Add To Cart
                        </a>
                        
                        <button onclick="beliSekarang(<?= $produk['id'] ?>, <?= $produk['stok'] ?>)" 
                                class="flex-1 h-16 inline-flex items-center justify-center gap-3 bg-primary text-white rounded-2xl font-black text-xs uppercase tracking-widest transition-all hover:bg-orange-600 hover:-translate-y-1 shadow-xl shadow-orange-500/20">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                            Direct Buy
                        </button>
                    </div>

                    <a href="<?= base_url('/user/produk'); ?>" 
                       class="h-14 inline-flex items-center justify-center gap-2 border-2 border-slate-200 dark:border-slate-800 text-slate-400 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] transition-all hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-slate-600">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Back to Inventory
                    </a>
                </div>
            </div>
        </div>

        <?php if (!empty($produk_terkait)): ?>
        <section class="mt-32">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-black uppercase italic tracking-tighter">
                    Related <span class="text-primary">Materials</span>
                </h2>
                <div class="h-[2px] flex-1 bg-slate-100 dark:bg-slate-800 ml-6"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($produk_terkait as $p): ?>
                <a href="<?= base_url('/user/produk/detail/' . $p['id']); ?>" class="group bg-white dark:bg-darkCard rounded-[2rem] p-4 border border-slate-100 dark:border-slate-800 transition-all duration-500 hover:border-primary shadow-sm hover:shadow-2xl">
                    <div class="aspect-square rounded-2xl overflow-hidden mb-4 bg-slate-50 dark:bg-slate-900">
                        <?php 
                            $fotoTerkait = $p['foto'] ?? '';
                            $urlTerkait = (!empty($fotoTerkait) && file_exists(FCPATH . 'uploads/' . $fotoTerkait)) 
                                        ? base_url('uploads/' . $fotoTerkait) 
                                        : 'https://via.placeholder.com/400x400?text=No+Image';
                        ?>
                        <img src="<?= $urlTerkait; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="font-bold text-xs text-slate-800 dark:text-white mb-1 truncate"><?= $p['nama_barang']; ?></h3>
                    <p class="text-primary font-black text-sm italic">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></p>
                </a>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </main>

    <script>
        lucide.createIcons();

        // LOGIC BELI SEKARANG (STAY ORIGINAL)
        function beliSekarang(id, stok) {
            if (stok <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'STOK HABIS!',
                    text: 'Maaf Bro, barang ini laku keras. Tunggu restock ya!',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#fff' : '#0f172a',
                    confirmButtonColor: '#f48c25',
                    borderRadius: '1.5rem'
                });
                return;
            }

            Swal.fire({
                title: '<span class="text-xl font-black italic uppercase">Beli Sekarang</span>',
                html: `
                    <div class="mt-6 px-4">
                        <div class="flex items-center justify-between mb-4 bg-slate-100 dark:bg-slate-800 p-4 rounded-2xl border border-slate-200 dark:border-slate-700">
                            <span class="text-[10px] font-black text-slate-400 uppercase">JUMLAH</span>
                            <div class="flex items-center gap-4">
                                <button onclick="document.getElementById('qty').stepDown()" class="w-8 h-8 bg-white dark:bg-slate-700 rounded-lg shadow-sm font-black">-</button>
                                <input type="number" id="qty" class="w-12 text-center text-lg font-black bg-transparent border-none focus:ring-0" value="1" min="1" max="${stok}" readonly>
                                <button onclick="document.getElementById('qty').stepUp()" class="w-8 h-8 bg-white dark:bg-slate-700 rounded-lg shadow-sm font-black">+</button>
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Lanjut Checkout',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#fff' : '#0f172a',
                borderRadius: '2rem',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const qty = document.getElementById('qty').value;
                    let formData = new URLSearchParams();
                    formData.append('qty', qty);

                    return fetch('<?= base_url("/user/add-to-cart/") ?>' + id, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal nambah ke cart');
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Gagal: ${error}`);
                    });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value.success) {
                    window.location.href = result.value.redirect || '<?= base_url("/user/checkout") ?>';
                } else if (result.isConfirmed && !result.value.success) {
                    Swal.fire({ icon: 'error', title: 'Waduh!', text: result.value.message });
                }
            });
        }
    </script>
</body>
</html>