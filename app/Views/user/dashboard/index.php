<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User | MateriaPro</title>
    
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
        
        <!-- HERO SECTION -->
        <section class="relative overflow-hidden rounded-[3rem] bg-slate-900 px-8 py-20 mb-16 shadow-2xl">
            <div class="absolute top-0 right-0 opacity-10 -mr-20 -mt-20">
                <i data-lucide="hard-hat" class="w-96 h-96 text-white rotate-12"></i>
            </div>

            <div class="relative z-10 max-w-2xl">
                <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-6">
                    MateriaPro Ecosystem
                </span>
                <h1 class="text-5xl md:text-6xl font-black text-white leading-tight tracking-tighter mb-6 uppercase italic">
                    Halo, <span class="text-primary"><?= session()->get('nama') ?? 'Juragan'; ?>!</span><br>
                    Siap Bangun Proyek Anda?
                </h1>
                <p class="text-slate-400 text-lg font-medium mb-10 leading-relaxed">
                    Selamat datang kembali. Temukan berbagai material bangunan berkualitas tinggi dengan harga yang bersaing langsung dari genggaman Anda.
                </p>
                
                <a href="<?= base_url('/user/produk'); ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-primary hover:bg-orange-600 text-white rounded-2xl font-black text-sm transition-all hover:scale-105 shadow-xl shadow-orange-500/20">
                    LIHAT SEMUA PRODUK <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </section>

        <!-- PRODUK TERBARU SECTION -->
        <section>
            <div class="flex items-end justify-between mb-10 px-4">
                <div>
                    <h2 class="text-2xl font-black uppercase italic">Koleksi <span class="text-primary">Terbaru</span></h2>
                    <p class="text-slate-400 text-sm font-medium">Beberapa material pilihan untuk inspirasi Anda.</p>
                </div>
                <a href="<?= base_url('/user/produk'); ?>" class="text-sm font-black text-primary hover:underline uppercase italic flex items-center gap-1">
                    Selengkapnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php 
                // CEK PENGAMAN: pastikan $produk ada dan berupa array
                if (isset($produk) && is_array($produk) && !empty($produk)):
                    
                    // Ambil cuma 4 produk buat pajangan
                    $previewProduk = array_slice($produk, 0, 4);
                    
                    foreach ($previewProduk as $p): 
                        // CEK: pastikan $p adalah array
                        if (!is_array($p)) continue;
                        
                        // PASTIKAN id_barang ada
                        $idBarang = $p['id_barang'] ?? $p['id'] ?? 0;
                ?>
                <!-- ========== YANG DIUBAH: LINK KE DETAIL PRODUK ========== -->
                <a href="<?= base_url('/user/produk/detail/' . $idBarang); ?>" class="group bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 overflow-hidden hover:border-primary transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-orange-500/10">
                    
                    <div class="relative h-56 overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <?php 
                            // CEK FOTO
                            $namaFoto = $p['foto'] ?? '';
                            $urlFoto = (!empty($namaFoto) && file_exists(FCPATH . 'uploads/' . $namaFoto)) 
                                       ? base_url('uploads/' . $namaFoto) 
                                       : 'https://via.placeholder.com/400x400?text=No+Image';
                        ?>
                        <img src="<?= $urlFoto; ?>" alt="<?= $p['nama_barang'] ?? 'Produk'; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>

                    <div class="p-6">
                        <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1"><?= $p['kategori'] ?? 'Material'; ?></p>
                        <h3 class="font-black text-lg text-slate-800 dark:text-white leading-tight mb-4 group-hover:text-primary transition-colors">
                            <?= $p['nama_barang'] ?? 'Produk Tidak Diketahui'; ?>
                        </h3>
                        
                        <div class="flex items-center justify-between">
                            <p class="font-black text-slate-400 text-sm italic">Mulai dari</p>
                            <p class="text-primary font-black text-lg italic">
                                Rp<?= number_format($p['harga'] ?? 0, 0, ',', '.'); ?>
                            </p>
                        </div>
                    </div>
                </a>
                <?php 
                    endforeach; 
                else: 
                ?>
                    <!-- KALO GA ADA PRODUK -->
                    <div class="col-span-full text-center py-20 bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800">
                        <i data-lucide="package-x" class="w-16 h-16 mx-auto text-slate-400 mb-4"></i>
                        <p class="text-slate-400 font-medium">Belum ada produk tersedia</p>
                        <a href="<?= base_url('/user/produk'); ?>" class="inline-block mt-4 text-primary font-black text-sm hover:underline">
                            Lihat Semua Produk
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="mt-20 py-10 border-t border-slate-200 dark:border-slate-800 text-center">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">MateriaPro &bull; 2026</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>