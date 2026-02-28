<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Produk | MateriaPro</title>
    
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
        body { transition: background-color 0.3s; }
        .produk-card { transition: all 0.3s ease; }
        #dropdownContent:not(.hidden) { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- HEADER PAGE -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tight leading-tight uppercase">
                    Semua <span class="text-primary italic">Produk</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Temukan material bangunan berkualitas untuk proyek Anda</p>
            </div>
            
            <!-- FILTER SECTION (kaya di barang/index.php) -->
            <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                <!-- FILTER KATEGORI - Hanya menampilkan kategori yang ADA PRODUKNYA -->
                <div class="relative flex-1 lg:flex-none min-w-[200px]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                    </div>
                    <select id="categoryFilter" class="w-full pl-10 pr-10 py-4 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-2xl appearance-none focus:ring-2 focus:ring-primary outline-none font-bold text-sm shadow-sm transition-all cursor-pointer">
                        <option value="all">Semua Kategori</option>
                        <?php 
                        // Mengambil daftar kategori UNIK dari data produk (kaya di barang/index.php)
                        $list_kategori = array_unique(array_column($produk, 'nama_kategori'));
                        foreach($list_kategori as $kat): 
                        ?>
                            <option value="<?= $kat; ?>"><?= $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>

                <!-- SEARCH BAR -->
                <div class="relative flex-1 lg:flex-none min-w-[200px]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Cari produk..." 
                           class="w-full pl-10 pr-10 py-4 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-2xl focus:ring-2 focus:ring-primary outline-none font-bold text-sm shadow-sm transition-all">
                </div>
            </div>
        </div>

        <!-- PRODUK GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="produkGrid">
            <?php foreach($produk as $p): ?>
            <div class="produk-card group bg-white dark:bg-darkCard rounded-[2rem] border border-slate-200 dark:border-slate-800 overflow-hidden hover:border-primary transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-orange-500/10"
                 data-category="<?= $p['nama_kategori']; ?>"
                 data-nama="<?= strtolower($p['nama_barang']); ?>">
                
                <a href="<?= base_url('/user/produk/detail/' . $p['id']); ?>" class="block">
                    <!-- GAMBAR -->
                    <div class="relative h-48 overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <?php 
                            $namaFoto = $p['foto'] ?? '';
                            $urlFoto = (!empty($namaFoto) && file_exists(FCPATH . 'uploads/' . $namaFoto)) 
                                       ? base_url('uploads/' . $namaFoto) 
                                       : 'https://via.placeholder.com/400x400?text=No+Image';
                        ?>
                        <img src="<?= $urlFoto; ?>" alt="<?= $p['nama_barang']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- STOK BADGE -->
                        <?php if ($p['stok'] <= 0): ?>
                            <span class="absolute top-3 right-3 px-3 py-1 bg-red-500 text-white text-xs font-black rounded-full">Habis</span>
                        <?php elseif ($p['stok'] <= 5): ?>
                            <span class="absolute top-3 right-3 px-3 py-1 bg-yellow-500 text-white text-xs font-black rounded-full">Sisa <?= $p['stok']; ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- INFO PRODUK -->
                    <div class="p-5">
                        <!-- KATEGORI (langsung dari hasil JOIN) -->
                        <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">
                            <?= $p['nama_kategori'] ?? 'Material'; ?>
                        </p>
                        
                        <!-- NAMA BARANG -->
                        <h3 class="font-black text-base text-slate-800 dark:text-white leading-tight mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            <?= $p['nama_barang']; ?>
                        </h3>
                        
                        <!-- HARGA -->
                        <div class="flex items-center justify-between">
                            <p class="font-black text-slate-400 text-sm italic">Harga</p>
                            <p class="text-primary font-black text-lg italic">
                                Rp<?= number_format($p['harga'], 0, ',', '.'); ?>
                            </p>
                        </div>
                        
                        <!-- HOVER EFFECT -->
                        <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="inline-block w-full text-center text-[10px] font-black text-primary border-t border-slate-200 dark:border-slate-700 pt-3 uppercase tracking-wider">
                                <i data-lucide="shopping-cart" class="w-4 h-4 inline mr-1"></i>
                                Klik untuk detail
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- PESAN KALO PRODUK KOSONG -->
        <div id="emptyMessage" class="hidden text-center py-20 bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 mt-8">
            <i data-lucide="package-x" class="w-20 h-20 mx-auto text-slate-400 mb-4"></i>
            <p class="text-slate-400 font-medium text-lg mb-2">Tidak ada produk ditemukan</p>
            <p class="text-slate-400 text-sm">Coba ubah filter atau kata kunci pencarian</p>
        </div>

        <!-- FOOTER -->
        <p class="mt-16 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">
            MateriaPro &bull; Produk Katalog
        </p>
    </main>

    <footer class="mt-10 py-8 border-t border-slate-200 dark:border-slate-800 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">MateriaPro &bull; 2026</p>
    </footer>

    <script>
        lucide.createIcons();

        // FILTER JAVASCRIPT (kaya di barang/index.php)
        const categoryFilter = document.getElementById('categoryFilter');
        const searchInput = document.getElementById('searchInput');
        const produkCards = document.querySelectorAll('.produk-card');
        const emptyMessage = document.getElementById('emptyMessage');

        function filterProduk() {
            const selectedCategory = categoryFilter.value;
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            let visibleCount = 0;

            produkCards.forEach(card => {
                const category = card.getAttribute('data-category');
                const nama = card.getAttribute('data-nama');
                
                // Filter berdasarkan KATEGORI (pake nama, kaya di admin)
                const matchCategory = (selectedCategory === 'all' || category === selectedCategory);
                
                // Filter berdasarkan SEARCH
                const matchSearch = searchTerm === '' || nama.includes(searchTerm);
                
                // Tampilkan jika kedua kondisi terpenuhi
                if (matchCategory && matchSearch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan kosong jika tidak ada produk
            if (visibleCount === 0) {
                emptyMessage.classList.remove('hidden');
            } else {
                emptyMessage.classList.add('hidden');
            }
        }

        // Event listeners
        categoryFilter.addEventListener('change', filterProduk);
        searchInput.addEventListener('input', filterProduk);
        
        // Jalankan sekali di awal
        filterProduk();
    </script>
</body>
</html>