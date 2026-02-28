<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk | MateriaPro System</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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

    <style>
        body { transition: background-color 0.3s, color 0.3s; }
        .glass-effect { backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-darkCard/90 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                        <i data-lucide="hard-hat" class="w-6 h-6"></i>
                    </div>
                    <h1 class="text-xl font-extrabold tracking-tighter uppercase">Materia<span class="text-primary">Pro</span></h1>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="document.documentElement.classList.toggle('dark')" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:text-primary transition-all">
                        <i data-lucide="moon" class="w-5 h-5"></i>
                    </button>
                    <a href="<?= base_url('/barang'); ?>" class="hidden sm:flex items-center gap-2 text-sm font-bold bg-slate-900 dark:bg-primary text-white px-6 py-3 rounded-xl hover:scale-105 transition-all">
                        <i data-lucide="layout-grid" class="w-4 h-4"></i>
                        Dashboard Stok
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-12">
        
        <div class="mb-10 flex items-center justify-between">
            <a href="<?= base_url('/barang'); ?>" class="group flex items-center gap-3 text-sm font-bold text-slate-400 hover:text-primary transition-all">
                <div class="p-2 rounded-lg border border-slate-200 dark:border-slate-800 group-hover:border-primary transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </div>
                Kembali
            </a>
            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                Item ID: #<?= $barang['id']; ?>
            </div>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[3rem] border border-slate-200 dark:border-slate-800 shadow-2xl shadow-slate-200/50 dark:shadow-none overflow-hidden">
            <div class="flex flex-col md:flex-row">
                
                <div class="w-full md:w-1/2 p-10 bg-slate-50 dark:bg-slate-800/30 border-r border-slate-100 dark:border-slate-800 flex items-center justify-center">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-primary/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-700"></div>
                        
                        <?php if (!empty($barang['foto'])) : ?>
                            <img src="<?= base_url('/uploads/' . $barang['foto']); ?>" 
                                 class="relative w-full max-w-[400px] aspect-square object-cover rounded-[2.5rem] shadow-2xl transform group-hover:scale-105 transition duration-500" 
                                 alt="Produk">
                        <?php else: ?>
                            <div class="relative w-[300px] aspect-square bg-slate-200 dark:bg-slate-700 rounded-[2.5rem] flex flex-col items-center justify-center text-slate-400">
                                <i data-lucide="image-off" class="w-20 h-20 mb-4 opacity-20"></i>
                                <span class="text-[10px] font-black uppercase tracking-widest text-center px-4">Gambar Tidak Ditemukan</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="w-full md:w-1/2 p-10 md:p-16 flex flex-col justify-center">
                    <div class="space-y-8">
                        
                        <div>
                            <span class="inline-block px-3 py-1 rounded-lg bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest border border-primary/20 mb-4">Official Material</span>
                            <h2 class="text-5xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tight">
                                <?= $barang['nama_barang']; ?>
                            </h2>
                        </div>

                        <div class="grid grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Harga Satuan</p>
                                <p class="text-3xl font-black text-primary">
                                    Rp <?= number_format($barang['harga'], 0, ',', '.'); ?>
                                </p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Stok Saat Ini</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-3xl font-black <?= $barang['stok'] > 5 ? 'text-slate-900 dark:text-white' : 'text-red-500' ?>">
                                        <?= $barang['stok']; ?>
                                    </p>
                                    <span class="text-xs font-bold text-slate-400 uppercase italic">Units</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-slate-100 dark:border-slate-800">
                            <h4 class="text-xs font-black uppercase text-slate-400 tracking-widest mb-4">Deskripsi Produk</h4>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed font-medium italic">
                                <?= !empty($barang['deskripsi']) ? nl2br($barang['deskripsi']) : 'Belum ada deskripsi mendalam.'; ?>
                            </p>
                        </div>

                        <div class="pt-10 flex gap-4">
                            <a href="<?= base_url('/barang/edit/' . $barang['id']); ?>" class="flex-1 bg-[#1e293b] dark:bg-slate-700 text-white text-center py-5 rounded-[1.5rem] font-bold hover:bg-black dark:hover:bg-primary transition-all flex items-center justify-center gap-3 shadow-xl shadow-slate-200 dark:shadow-none">
                                <i data-lucide="edit-3" class="w-5 h-5"></i>
                                Edit Barang
                            </a>
                            
                            <button onclick="confirmDelete(<?= $barang['id']; ?>)" class="p-5 rounded-[1.5rem] bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all border border-red-100 dark:border-red-500/20 shadow-sm">
                                <i data-lucide="trash-2" class="w-6 h-6"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>           
    <script>
        lucide.createIcons();

        function confirmDelete(id) {
            if (confirm('Konfirmasi: Hapus data barang ini dari sistem?')) {
                // Sesuai route: /barang/delete/(:num)
                window.location.href = '<?= base_url("/barang/delete/"); ?>/' + id;
            }
        }
    </script>
</body>
</html>