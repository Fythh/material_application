<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | Material Masa Kini.</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
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
        body { transition: background-color 0.3s; scroll-behavior: smooth; }
        .typing-wrapper { height: 50px; display: flex; align-items: center; }
        
        .search-container { transition: all 0.3s ease; border: 2px solid #f1f5f9; }
        .dark .search-container { border-color: #1e293b; }
        .search-container:hover, .search-container:focus-within {
            border-color: #f48c25;
            box-shadow: 0 0 15px rgba(244, 140, 37, 0.2);
            transform: translateY(-2px);
        }

        .produk-card { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .produk-card:hover { transform: translateY(-12px); }

        /* --- THE INDEPENDENT SLIDER BUTTON --- */
        .btn-cart-slider {
            display: flex; align-items: center; justify-content: center;
            width: 46px; height: 46px;
            overflow: hidden; border-radius: 14px;
            background-color: #f1f5f9;
            color: #475569;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            cursor: pointer;
            border: none;
            flex-shrink: 0;
        }

        .dark .btn-cart-slider { background-color: #0f172a; color: #94a3b8; }

        /* SLIDER AKTIF HANYA SAAT TOMBOL DI-HOVER */
        .btn-cart-slider:hover {
            width: 145px; 
            background-color: #f48c25;
            color: white;
            box-shadow: 0 10px 20px -5px rgba(244, 140, 37, 0.4);
        }

        .cart-text {
            opacity: 0; 
            max-width: 0;
            transform: translateX(10px);
            transition: all 0.4s ease;
            font-size: 10px; font-weight: 900; letter-spacing: 1px;
            white-space: nowrap;
        }

        .btn-cart-slider:hover .cart-text {
            opacity: 1;
            max-width: 100px;
            transform: translateX(0);
            margin-left: 10px;
        }

        #bg-glow {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(600px circle at var(--x) var(--y), rgba(244, 140, 37, 0.08), transparent 80%);
            pointer-events: none; z-index: -1;
        }

        .marquee-container {
            overflow: hidden; white-space: nowrap; background: #f48c25; color: white;
            padding: 8px 0; font-size: 10px; font-weight: 900; text-transform: uppercase;
            letter-spacing: 2px;
        }
        .marquee-content { display: inline-block; animation: marquee 20s linear infinite; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <div id="bg-glow"></div>

    <div class="marquee-container">
        <div class="marquee-content">
            🔥 PROMO MATERIAL BANGUNAN TERLENGKAP • DISKON UP TO 20% UNTUK PEMBELIAN GROSIR • MATERIAL BERKUALITAS STANDAR INTERNASIONAL • PENGIRIMAN CEPAT SELURUH INDONESIA 🔥
        </div>
    </div>

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mb-16">
            <div>
                <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] mb-2 block">Premium Inventory</span>
                <div class="typing-wrapper">
                    <h2 class="text-2xl lg:text-3xl font-black tracking-tight uppercase italic text-slate-800 dark:text-white">
                        <span id="typing-welcome"></span>
                    </h2>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 items-center justify-end">
                <div class="relative w-full sm:w-48 group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-primary">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                    </div>
                    <select id="categoryFilter" class="w-full pl-10 pr-8 py-4 bg-white dark:bg-darkCard rounded-2xl appearance-none outline-none font-bold text-[10px] uppercase tracking-wider shadow-sm cursor-pointer border-2 border-slate-100 dark:border-slate-800 focus:border-primary transition-all text-slate-600 dark:text-slate-300">
                        <option value="all">Semua Kategori</option>
                        <?php 
                        $categories = array_unique(array_column($produk, 'nama_kategori'));
                        foreach($categories as $kat): ?>
                            <option value="<?= $kat; ?>"><?= $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="search-container relative w-full sm:w-64 bg-white dark:bg-darkCard rounded-2xl overflow-hidden">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-primary">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="CARI MATERIAL..." 
                           class="w-full pl-10 pr-4 py-4 bg-transparent outline-none font-bold text-[10px] tracking-widest placeholder:text-slate-300">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="produkGrid">
            <?php foreach($produk as $p): ?>
            <div class="produk-card group bg-white dark:bg-darkCard rounded-[2.5rem] border-2 border-slate-50 dark:border-slate-800 overflow-hidden hover:border-primary transition-all shadow-sm relative"
                 data-category="<?= $p['nama_kategori']; ?>"
                 data-nama="<?= strtolower($p['nama_barang']); ?>">
                
                <div class="absolute top-5 left-5 z-10">
                    <span class="px-3 py-1 bg-white/90 dark:bg-darkCard/90 backdrop-blur text-primary text-[8px] font-black uppercase tracking-tighter rounded-lg shadow-sm border border-slate-100 dark:border-slate-700">
                        <?= $p['nama_kategori']; ?>
                    </span>
                </div>

                <a href="<?= base_url('/user/produk/detail/' . $p['id']); ?>">
                    <div class="relative h-56 overflow-hidden bg-slate-50 dark:bg-slate-900">
                        <img src="<?= (!empty($p['foto']) && file_exists(FCPATH . 'uploads/' . $p['foto'])) ? base_url('uploads/' . $p['foto']) : 'https://via.placeholder.com/400x400?text=No+Image'; ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                </a>

                <div class="border-t border-slate-100 dark:border-slate-800"></div>

                <div class="p-6">
                    <h3 class="font-bold text-sm text-slate-800 dark:text-white leading-snug mb-4 line-clamp-2 min-h-[2.5rem] uppercase italic"><?= $p['nama_barang']; ?></h3>
                    
                    <div class="flex items-center justify-between border-t border-slate-50 dark:border-slate-800 pt-5">
                        <div class="flex-1">
                            <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-1">Price Unit</p>
                            <p class="text-primary font-black text-base italic">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></p>
                        </div>
                        
                        <button onclick="tambahKeKeranjang(event, <?= $p['id']; ?>, '<?= addslashes($p['nama_barang']); ?>')" 
                                class="btn-cart-slider">
                            <i data-lucide="shopping-cart" class="w-4 h-4 flex-shrink-0"></i>
                            <span class="cart-text uppercase">MASUKKAN</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

<script>
    if (typeof lucide !== 'undefined') { lucide.createIcons(); }

    new Typed('#typing-welcome', {
        strings: ['Cari Material Berkualitas.', 'Bangun Proyek Impian.', 'Solusi Bangunan Terkini.'],
        typeSpeed: 50, backSpeed: 30, backDelay: 2000, loop: true
    });

    document.addEventListener('mousemove', (e) => {
        const bgGlow = document.getElementById('bg-glow');
        if (bgGlow) {
            bgGlow.style.setProperty('--x', e.clientX + 'px');
            bgGlow.style.setProperty('--y', e.clientY + 'px');
        }
    });

    function tambahKeKeranjang(e, id, nama) {
        const btn = e.currentTarget;
        const icon = btn.querySelector('i');
        const text = btn.querySelector('.cart-text');
        
        if (btn.disabled) return;
        btn.disabled = true;
        if (icon) icon.classList.add('animate-spin'); 
        if (text) text.innerText = 'PROSES...';

        fetch('<?= base_url("/user/add-to-cart/") ?>' + id, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json()) 
        .then(data => {
            btn.disabled = false;
            if (icon) icon.classList.remove('animate-spin');
            if (text) text.innerText = 'MASUKKAN';

            if (data.success) {
                if (typeof window.animateCart === 'function') {
                    window.animateCart(data.total_items);
                }
                Swal.fire({
                    icon: 'success',
                    title: '<span class="text-xs font-black uppercase tracking-widest">Berhasil!</span>',
                    text: nama + ' telah ditambahkan ke keranjang.',
                    showConfirmButton: false, timer: 1500, toast: true, position: 'top-end',
                    background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                    color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                });
            }
        });
    }

    // Filter Logic
    const categoryFilter = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchInput');
    const produkCards = document.querySelectorAll('.produk-card');

    function filterProduk() {
        const selectedCategory = categoryFilter.value;
        const searchTerm = searchInput.value.toLowerCase().trim();
        produkCards.forEach(card => {
            const category = card.getAttribute('data-category');
            const nama = card.getAttribute('data-nama');
            const matchCategory = (selectedCategory === 'all' || category === selectedCategory);
            const matchSearch = (searchTerm === '' || nama.includes(searchTerm));
            card.classList.toggle('hidden', !(matchCategory && matchSearch));
        });
    }
    categoryFilter.addEventListener('change', filterProduk);
    searchInput.addEventListener('input', filterProduk);
</script>
</body>
</html>