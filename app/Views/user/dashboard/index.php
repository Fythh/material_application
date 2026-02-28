<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Material Kita.</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

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
        /* RUNNING TEXT STYLE */
        .marquee-container {
            overflow: hidden; white-space: nowrap; background: #f48c25; color: white;
            padding: 8px 0; font-size: 10px; font-weight: 900; text-transform: uppercase;
            letter-spacing: 2px; position: relative; z-index: 50;
        }
        .marquee-content { display: inline-block; animation: marquee 25s linear infinite; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }

        /* BACKGROUND ANIMATION - KUNCI */
        body { background-color: #f8fafc; position: relative; overflow-x: hidden; }
        body::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(244, 140, 37, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(15, 23, 42, 0.05) 0%, transparent 40%);
            z-index: -1; animation: bgMove 20s ease-in-out infinite alternate;
        }
        @keyframes bgMove { 0% { transform: scale(1) translate(0, 0); } 100% { transform: scale(1.1) translate(20px, 20px); } }

        /* BORDER GLOW STATS - KUNCI */
        .stats-glow { position: relative; padding: 2px; border-radius: 2rem; overflow: hidden; background: rgba(255,255,255,0.5); backdrop-filter: blur(10px); }
        .stats-glow::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: conic-gradient(transparent, transparent, transparent, #f48c25);
            animation: rotate-border 4s linear infinite;
        }
        @keyframes rotate-border { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .stats-inner { position: relative; z-index: 1; background: white; border-radius: 1.9rem; width: 100%; height: 100%; }

        /* PRODUCT TRACK - KUNCI */
        .product-track { display: flex; gap: 2.5rem; width: max-content; animation: scroll-x 40s linear infinite; }
        .product-track:hover { animation-play-state: paused; }
        @keyframes scroll-x { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-50% - 1.25rem)); } }

        /* FLOATING ICON - KUNCI */
        .float-icon { animation: floating 5s ease-in-out infinite; }
        @keyframes floating { 0% { transform: translate(0, 0px) rotate(12deg); } 50% { transform: translate(0, 20px) rotate(15deg); } 100% { transform: translate(0, -0px) rotate(12deg); } }

        /* Hapus cursor default biar ga ganggu baris baru */
        .typed-cursor { opacity: 0 !important; width: 0 !important; display: none !important; }
    </style>
</head>
<body class="dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <div class="marquee-container">
        <div class="marquee-content">
            🔥 SELAMAT DATANG DI DASHBOARD MITRA • PANTAU PESANAN ANDA SECARA REAL-TIME • DAPATKAN POIN REWARD SETIAP TRANSAKSI • MATERIAL KITA: SOLUSI BANGUNAN MASA KINI 🔥
        </div>
    </div>

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        
        <section class="relative overflow-hidden rounded-[3.5rem] bg-slate-900 px-10 py-24 mb-16 shadow-2xl">
            <div class="absolute top-0 right-0 opacity-10 float-icon">
                <i data-lucide="construction" class="w-[450px] h-[450px] text-white"></i>
            </div>
            <div class="relative z-10 max-w-3xl">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 border border-primary/30 backdrop-blur-md text-primary rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                    Verified Material Partner
                </span>
                
                <div class="min-h-[180px] flex flex-col justify-center">
                    <h1 class="text-6xl md:text-7xl font-black text-white leading-[0.9] tracking-tighter uppercase italic mb-4">
                        Halo, <span class="text-primary" id="typing-name"></span>!
                    </h1>
                    <p class="text-3xl text-slate-400 tracking-tight font-medium italic">
                        <span id="magic-subtitle"></span>
                    </p>
                </div>

                <div class="mt-8">
                    <a href="<?= base_url('/user/produk'); ?>" class="group inline-flex items-center gap-4 px-10 py-5 bg-primary hover:bg-orange-600 text-white rounded-2xl font-black text-sm transition-all shadow-xl shadow-primary/20">
                        LIHAT KATALOG <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="stats-glow">
                <div class="stats-inner p-8 flex items-center gap-6">
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center shadow-inner"><i data-lucide="shopping-cart" class="w-7 h-7"></i></div>
                    <div><p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tracking</p><h4 class="text-xl font-black text-slate-800 italic uppercase">Lacak Order</h4></div>
                </div>
            </div>
            <div class="stats-glow">
                <div class="stats-inner p-8 flex items-center gap-6">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center shadow-inner"><i data-lucide="tags" class="w-7 h-7"></i></div>
                    <div><p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Special Offer</p><h4 class="text-xl font-black text-slate-800 italic uppercase">Cek Diskon</h4></div>
                </div>
            </div>
            <div class="stats-glow">
                <div class="stats-inner p-8 flex items-center gap-6">
                    <div class="w-14 h-14 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center shadow-inner"><i data-lucide="award" class="w-7 h-7"></i></div>
                    <div><p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rewards</p><h4 class="text-xl font-black text-slate-800 italic uppercase">Poin Mitra</h4></div>
                </div>
            </div>
        </div>

        <section class="overflow-hidden py-10">
            <div class="flex items-center justify-between mb-12 px-4">
                <h2 class="text-3xl font-black uppercase italic tracking-tighter">Koleksi <span class="text-primary underline underline-offset-8">Terbaru</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest italic">Hover to Pause</p>
            </div>

            <div class="relative w-full overflow-hidden mask-fade-edges">
                <div class="product-track">
                    <?php 
                    if (isset($produk) && is_array($produk) && !empty($produk)):
                        $loopProduk = array_merge($produk, $produk); 
                        foreach ($loopProduk as $p): 
                            $idBarang = $p['id_barang'] ?? $p['id'] ?? 0;
                            $urlFoto = (!empty($p['foto']) && file_exists(FCPATH . 'uploads/' . $p['foto'])) 
                                       ? base_url('uploads/' . $p['foto']) : 'https://via.placeholder.com/400x400';
                    ?>
                    <a href="<?= base_url('/user/produk/detail/' . $idBarang); ?>" class="w-[300px] flex-shrink-0 group">
                        <div class="relative h-[350px] rounded-[2.5rem] overflow-hidden shadow-lg border border-white">
                            <img src="<?= $urlFoto; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                            <div class="absolute bottom-6 left-6 right-6">
                                <span class="text-[9px] font-black text-primary uppercase tracking-widest"><?= $p['kategori'] ?? 'Material'; ?></span>
                                <h3 class="text-lg font-black text-white truncate"><?= $p['nama_barang']; ?></h3>
                                <p class="text-primary font-black text-md">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; else: ?>
                        <p class="text-slate-400 italic">No products found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="mt-20 py-12 text-center border-t border-slate-200">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[1em]">Material Kita &bull; Excellence 2026</p>
    </footer>

    <script>
        lucide.createIcons();

        // TYPING GREETING (Boss, Mitra, dll)
        new Typed('#typing-name', {
            strings: ['Boss', 'Mitra', 'Sobat', '<?= session()->get('nama') ?? 'Juragan'; ?>'],
            typeSpeed: 80, backSpeed: 50, backDelay: 2000, loop: true,
            showCursor: false // Matiin kursor biar ga turun kebawah
        });

        // MAGIC SUBTITLE (SULAP FADE OUT)
        new Typed('#magic-subtitle', {
            strings: [
                'Wujudkan struktur kokoh hari ini.',
                'Bangun impian dengan material pilihan.',
                'Kualitas beton nomor satu di kelasnya.',
                'Solusi cerdas untuk proyek masa depan.'
            ],
            typeSpeed: 50,
            backSpeed: 0,
            fadeOut: true,
            fadeOutDelay: 500,
            loop: true,
            showCursor: false // Matiin kursor biar ga ganggu teks subtitle
        });
    </script>
</body>
</html>