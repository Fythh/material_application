<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Material Masa Kini.</title>
    
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
                        darkBody: '#020617',
                        darkCard: '#0f172a'
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            background-color: #f8fafc;
            background-image: radial-gradient(at 0% 0%, rgba(244, 140, 37, 0.03) 0px, transparent 50%), radial-gradient(at 100% 0%, rgba(15, 23, 42, 0.02) 0px, transparent 50%);
        }
        
        /* Glass Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .dark .glass-card {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Floating Animation */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #f48c25; border-radius: 10px; }
    </style>
</head>
<body class="dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <div class="fixed top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] -z-10 animate-pulse"></div>
    <div class="fixed bottom-0 left-0 w-[300px] h-[300px] bg-blue-500/5 rounded-full blur-[100px] -z-10"></div>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <header class="mb-16 relative">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-4">
                        Control Center v2.0
                    </span>
                    <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none">
                        Admin <span class="text-primary">Dashboard</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-4">
                        <div class="flex gap-1">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            <span class="w-8 h-2 rounded-full bg-primary/20"></span>
                        </div>
                        <p class="text-slate-400 font-bold italic tracking-tight uppercase text-[10px]">Monitor Inventori & Transaksi Real-Time</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 bg-white dark:bg-darkCard p-3 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800">
                    <div class="text-right px-4">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Waktu Server</p>
                        <p class="text-sm font-black italic uppercase"><?= date('H:i') ?> WIB</p>
                    </div>
                    <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="glass-card p-8 rounded-[3rem] shadow-sm relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all">
                <div class="relative z-10">
                    <div class="bg-blue-500/10 p-4 rounded-2xl w-fit mb-6 text-blue-500 group-hover:scale-110 transition-transform">
                        <i data-lucide="package" class="w-7 h-7"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Material</p>
                    <h3 class="text-5xl font-black mt-2 tracking-tighter italic"><?= $total_barang; ?></h3>
                </div>
                <i data-lucide="box" class="absolute -right-4 -bottom-4 w-32 h-32 text-slate-200/20 dark:text-slate-700/10 -rotate-12 group-hover:rotate-0 transition-all duration-700"></i>
            </div>

            <div class="glass-card p-8 rounded-[3rem] shadow-sm relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all">
                <div class="relative z-10">
                    <div class="bg-primary/10 p-4 rounded-2xl w-fit mb-6 text-primary group-hover:scale-110 transition-transform">
                        <i data-lucide="layers" class="w-7 h-7"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Kategori</p>
                    <h3 class="text-5xl font-black mt-2 tracking-tighter italic"><?= $total_kategori; ?></h3>
                </div>
                <i data-lucide="layers" class="absolute -right-4 -bottom-4 w-32 h-32 text-slate-200/20 dark:text-slate-700/10 -rotate-12 group-hover:rotate-0 transition-all duration-700"></i>
            </div>

            <div class="glass-card p-8 rounded-[3rem] shadow-sm relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all">
                <div class="relative z-10">
                    <div class="bg-emerald-500/10 p-4 rounded-2xl w-fit mb-6 text-emerald-500 group-hover:scale-110 transition-transform">
                        <i data-lucide="trending-up" class="w-7 h-7"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Transaksi</p>
                    <h3 class="text-5xl font-black mt-2 tracking-tighter italic"><?= $total_penjualan; ?></h3>
                </div>
                <i data-lucide="shopping-bag" class="absolute -right-4 -bottom-4 w-32 h-32 text-slate-200/20 dark:text-slate-700/10 -rotate-12 group-hover:rotate-0 transition-all duration-700"></i>
            </div>

            <div class="glass-card p-8 rounded-[3rem] shadow-sm relative overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all">
                <div class="relative z-10">
                    <div class="bg-violet-500/10 p-4 rounded-2xl w-fit mb-6 text-violet-500 group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-7 h-7"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Pelanggan</p>
                    <h3 class="text-5xl font-black mt-2 tracking-tighter italic"><?= $total_user; ?></h3>
                </div>
                <i data-lucide="users" class="absolute -right-4 -bottom-4 w-32 h-32 text-slate-200/20 dark:text-slate-700/10 -rotate-12 group-hover:rotate-0 transition-all duration-700"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 bg-white dark:bg-darkCard rounded-[3.5rem] border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
                <div class="p-10 border-b border-slate-50 dark:border-slate-800/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-black tracking-tight uppercase italic">Stok <span class="text-red-500">Kritis</span></h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2 italic">Segera lakukan restock barang</p>
                    </div>
                    <div class="bg-red-500/10 text-red-500 px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest animate-pulse border border-red-500/20">
                        Attention Required
                    </div>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-separate border-spacing-y-3">
                        <thead>
                            <tr class="text-slate-400 text-[9px] font-black uppercase tracking-[0.3em] italic">
                                <th class="px-8 pb-4">Nama Material</th>
                                <th class="px-8 pb-4 text-center">Status Sisa</th>
                                <th class="px-8 pb-4 text-right">Manajemen</th>
                            </tr>
                        </thead>
                        <tbody class="font-bold">
                            <?php foreach ($stok_minim as $b): ?>
                            <tr class="glass-card hover:bg-slate-50 dark:hover:bg-slate-800 transition-all group">
                                <td class="px-8 py-6 rounded-l-[2rem]">
                                    <div class="flex items-center gap-4">
                                        <div class="w-2 h-2 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.8)]"></div>
                                        <span class="text-slate-800 dark:text-slate-200 font-black italic uppercase tracking-tighter"><?= $b['nama_barang']; ?></span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-5 py-2.5 bg-red-500 text-white rounded-xl text-[10px] font-black italic shadow-lg shadow-red-500/20">
                                        <?= $b['stok']; ?> Unit
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right rounded-r-[2rem]">
                                    <a href="<?= base_url('/barang'); ?>" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-primary hover:gap-4 transition-all italic">
                                        Isi Stok <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if(empty($stok_minim)): ?>
                            <tr>
                                <td colspan="3" class="py-24 text-center">
                                    <div class="animate-float inline-block mb-6">
                                        <i data-lucide="shield-check" class="w-20 h-20 text-emerald-500 opacity-30"></i>
                                    </div>
                                    <p class="text-slate-400 font-black italic uppercase tracking-[0.4em] text-xs">Gudang dalam kondisi prima!</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <h3 class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-400 ml-8 italic">Quick Access Menu</h3>
                
                <a href="<?= base_url('/barang'); ?>" class="group flex items-center justify-between p-8 bg-white dark:bg-darkCard rounded-[2.8rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-primary hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500">
                    <div class="flex items-center gap-6">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-[1.8rem] group-hover:bg-primary group-hover:text-white group-hover:rotate-12 transition-all duration-500">
                            <i data-lucide="package-search" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block font-black text-sm uppercase tracking-tight italic">Gudang Pusat</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Inventory Log</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </div>
                </a>

                <a href="<?= base_url('/pelanggan'); ?>" class="group flex items-center justify-between p-8 bg-white dark:bg-darkCard rounded-[2.8rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-primary hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500">
                    <div class="flex items-center gap-6">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-[1.8rem] group-hover:bg-primary group-hover:text-white group-hover:rotate-12 transition-all duration-500">
                            <i data-lucide="contact-2" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block font-black text-sm uppercase tracking-tight italic">Data Pembeli</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">CRM Management</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </div>
                </a>

                <a href="<?= base_url('/penjualan'); ?>" class="group flex items-center justify-between p-8 bg-white dark:bg-darkCard rounded-[2.8rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-primary hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-2 transition-all duration-500">
                    <div class="flex items-center gap-6">
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-5 rounded-[1.8rem] group-hover:bg-primary group-hover:text-white group-hover:rotate-12 transition-all duration-500">
                            <i data-lucide="dollar-sign" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="block font-black text-sm uppercase tracking-tight italic">Arus Kas</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Sales Report</span>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-full border border-slate-100 dark:border-slate-800 flex items-center justify-center group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </div>
                </a>
            </div>
        </div>
        
        <footer class="mt-28 py-10 border-t border-slate-100 dark:border-slate-800/50 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="bg-primary p-2 rounded-lg text-white">
                    <i data-lucide="construction" class="w-4 h-4"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest italic">Material Masa Kini.</p>
            </div>
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.5em] italic opacity-50">
                Building the future &bull; Admin Ecosystem v2.0
            </p>
        </footer>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>