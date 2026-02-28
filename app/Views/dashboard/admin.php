<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | MateriaPro</title>
    
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
    <style>
        body { transition: background-color 0.3s; }
        .card-gradient {
            background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(248,250,252,1) 100%);
        }
        .dark .card-gradient {
            background: linear-gradient(135deg, rgba(30,41,59,1) 0%, rgba(15,23,42,1) 100%);
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <header class="mb-12">
            <h1 class="text-5xl font-black tracking-tighter mb-3 uppercase">
                Admin <span class="text-primary italic">Dashboard</span>
            </h1>
            <div class="flex items-center gap-3">
                <span class="w-12 h-[2px] bg-primary"></span>
                <p class="text-slate-400 font-bold italic tracking-tight uppercase text-xs">Overview performa inventori & transaksi real-time</p>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="card-gradient p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all">
                <div class="bg-blue-500/10 p-4 rounded-2xl w-fit mb-6 text-blue-500">
                    <i data-lucide="package" class="w-7 h-7"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Barang</p>
                <h3 class="text-4xl font-black mt-2 tracking-tighter italic"><?= $total_barang; ?></h3>
                <i data-lucide="package" class="absolute -right-6 -bottom-6 w-32 h-32 text-slate-200/20 dark:text-slate-700/20 -rotate-12 group-hover:rotate-0 transition-transform"></i>
            </div>

            <div class="card-gradient p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all">
                <div class="bg-primary/10 p-4 rounded-2xl w-fit mb-6 text-primary">
                    <i data-lucide="tags" class="w-7 h-7"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Kategori</p>
                <h3 class="text-4xl font-black mt-2 tracking-tighter italic"><?= $total_kategori; ?></h3>
                <i data-lucide="tags" class="absolute -right-6 -bottom-6 w-32 h-32 text-slate-200/20 dark:text-slate-700/20 -rotate-12 group-hover:rotate-0 transition-transform"></i>
            </div>

            <div class="card-gradient p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all">
                <div class="bg-green-500/10 p-4 rounded-2xl w-fit mb-6 text-green-500">
                    <i data-lucide="shopping-cart" class="w-7 h-7"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Penjualan</p>
                <h3 class="text-4xl font-black mt-2 tracking-tighter italic"><?= $total_penjualan; ?></h3>
                <i data-lucide="shopping-cart" class="absolute -right-6 -bottom-6 w-32 h-32 text-slate-200/20 dark:text-slate-700/20 -rotate-12 group-hover:rotate-0 transition-transform"></i>
            </div>

            <div class="card-gradient p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden group hover:scale-[1.02] transition-all">
                <div class="bg-purple-500/10 p-4 rounded-2xl w-fit mb-6 text-purple-500">
                    <i data-lucide="users" class="w-7 h-7"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Pelanggan</p>
                <h3 class="text-4xl font-black mt-2 tracking-tighter italic"><?= $total_user; ?></h3>
                <i data-lucide="users" class="absolute -right-6 -bottom-6 w-32 h-32 text-slate-200/20 dark:text-slate-700/20 -rotate-12 group-hover:rotate-0 transition-transform"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white dark:bg-darkCard rounded-[3rem] border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                    <div>
                        <h3 class="text-xl font-black tracking-tight uppercase">Stok <span class="text-red-500 italic">Hampir Habis</span></h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1 italic">Prioritas pengadaan barang</p>
                    </div>
                    <div class="bg-red-500 p-3 rounded-2xl text-white shadow-lg shadow-red-500/20 animate-pulse">
                        <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] italic">
                                <th class="px-10 py-6">Nama Material</th>
                                <th class="px-10 py-6 text-center">Sisa</th>
                                <th class="px-10 py-6 text-right">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 font-bold">
                            <?php foreach ($stok_minim as $b): ?>
                            <tr class="hover:bg-red-50/30 dark:hover:bg-red-500/5 transition-colors group">
                                <td class="px-10 py-6 text-slate-700 dark:text-slate-200 font-black italic uppercase italic tracking-tighter"><?= $b['nama_barang']; ?></td>
                                <td class="px-10 py-6 text-center">
                                    <span class="px-4 py-2 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 rounded-xl text-xs font-black italic">
                                        <?= $b['stok']; ?> Units
                                    </span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <a href="<?= base_url('/barang'); ?>" class="text-[10px] font-black uppercase tracking-widest text-primary hover:underline italic">Restock &rarr;</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($stok_minim)): ?>
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center">
                                    <i data-lucide="check-circle" class="w-12 h-12 text-green-500 mx-auto mb-4 opacity-20"></i>
                                    <p class="text-slate-400 font-black italic uppercase tracking-[0.3em] text-xs text-center">Semua stok aman, Kapten! 😎</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 ml-6 italic">Quick Access Control</h3>
                
                <a href="<?= base_url('/barang'); ?>" class="group flex items-center justify-between p-7 bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-primary hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="bg-slate-100 dark:bg-slate-800 p-4 rounded-[1.5rem] group-hover:bg-primary group-hover:text-white transition-all">
                            <i data-lucide="package" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block font-black text-sm uppercase tracking-tight">Gudang Barang</span>
                            <span class="text-[10px] font-bold text-slate-400 italic">Inventory Management</span>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-5 h-5 text-slate-300 group-hover:text-primary transition-all"></i>
                </a>

                <a href="<?= base_url('/pelanggan'); ?>" class="group flex items-center justify-between p-7 bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-primary hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="bg-slate-100 dark:bg-slate-800 p-4 rounded-[1.5rem] group-hover:bg-primary group-hover:text-white transition-all">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block font-black text-sm uppercase tracking-tight">Data Pelanggan</span>
                            <span class="text-[10px] font-bold text-slate-400 italic">CRM & Buyers</span>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-5 h-5 text-slate-300 group-hover:text-primary transition-all"></i>
                </a>

                <a href="<?= base_url('/penjualan'); ?>" class="group flex items-center justify-between p-7 bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm hover:border-primary hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <div class="bg-slate-100 dark:bg-slate-800 p-4 rounded-[1.5rem] group-hover:bg-primary group-hover:text-white transition-all">
                            <i data-lucide="banknote" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block font-black text-sm uppercase tracking-tight">Arus Penjualan</span>
                            <span class="text-[10px] font-bold text-slate-400 italic">Revenue & Ledger</span>
                        </div>
                    </div>
                    <i data-lucide="arrow-right" class="w-5 h-5 text-slate-300 group-hover:text-primary transition-all"></i>
                </a>
            </div>
        </div>
        
        <footer class="mt-24 text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.6em] italic opacity-50">
                MateriaPro Ecosystem &bull; Terminal Admin v2.0
            </p>
        </footer>
    </main>

    <script>
        // Init Lucide
        lucide.createIcons();
    </script>
</body>
</html>