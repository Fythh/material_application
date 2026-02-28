<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya | MateriaPro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

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
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen selection:bg-primary selection:text-white">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-5xl mx-auto px-6 py-12">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-8 h-[2px] bg-primary"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary">Transaction History</span>
                </div>
                <h2 class="text-5xl font-black tracking-tighter leading-none uppercase italic">
                    Pesanan <span class="text-primary">Saya</span>
                </h2>
                <p class="text-slate-400 mt-3 font-medium text-sm">Kelola dan pantau progres material proyek Anda secara real-time.</p>
            </div>
            
            <div class="flex items-center gap-4 bg-white dark:bg-darkCard p-2 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="px-4 py-2 text-center">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total Pesanan</p>
                    <p class="text-xl font-black text-primary"><?= count($pesanan ?? []); ?></p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <?php if(!empty($pesanan)): ?>
                <?php foreach($pesanan as $p): ?>
                <?php 
                    // Logic Status Styling
                    $status = $p['status'] ?? 'pending';
                    $statusConfig = [
                        'pending'  => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-500', 'icon' => 'clock', 'label' => 'Menunggu'],
                        'diproses' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-500', 'icon' => 'refresh-cw', 'label' => 'Diproses'],
                        'dikirim'  => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-500', 'icon' => 'truck', 'label' => 'Dalam Pengiriman'],
                        'selesai'  => ['bg' => 'bg-green-500/10', 'text' => 'text-green-500', 'icon' => 'check-circle', 'label' => 'Berhasil'],
                    ];
                    $conf = $statusConfig[$status] ?? ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-500', 'icon' => 'help-circle', 'label' => ucfirst($status)];
                ?>
                
                <div class="group relative bg-white dark:bg-darkCard rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6 transition-all duration-500 hover:shadow-2xl hover:shadow-orange-500/10 hover:-translate-y-1">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        <div class="flex flex-wrap items-center gap-6">
                            <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                                <i data-lucide="package" class="w-8 h-8 text-slate-400 group-hover:text-primary transition-colors"></i>
                            </div>
                            
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="font-black text-lg tracking-tighter italic uppercase text-slate-800 dark:text-white">
                                        #<?= $p['id_penjualan'] ?? $p['id'] ?? '-'; ?>
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                        &bull; <?= isset($p['tanggal']) ? date('d M Y', strtotime($p['tanggal'])) : '-'; ?>
                                    </span>
                                </div>
                                <p class="text-2xl font-black text-primary italic leading-none">
                                    Rp <?= number_format($p['total'] ?? 0, 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between md:justify-end gap-4 border-t md:border-t-0 pt-4 md:pt-0 border-slate-100 dark:border-slate-800">
                            <div class="flex flex-col items-end gap-2">
                                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full <?= $conf['bg']; ?> <?= $conf['text']; ?> text-[10px] font-black uppercase italic tracking-wider">
                                    <i data-lucide="<?= $conf['icon']; ?>" class="w-3.5 h-3.5"></i>
                                    <?= $conf['label']; ?>
                                </div>
                            </div>

                            <a href="<?= base_url('/user/pesanan/detail/' . ($p['id_penjualan'] ?? $p['id'] ?? 0)); ?>" 
                               class="flex items-center justify-center w-14 h-14 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 hover:bg-primary dark:hover:bg-primary dark:hover:text-white transition-all shadow-lg active:scale-95">
                                <i data-lucide="arrow-right" class="w-6 h-6"></i>
                            </a>
                        </div>

                    </div>
                    
                    <div class="absolute top-0 right-10 w-20 h-1 bg-gradient-to-r from-transparent via-primary/20 to-transparent"></div>
                </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="bg-white dark:bg-darkCard rounded-[3rem] py-20 border border-dashed border-slate-300 dark:border-slate-700 flex flex-col items-center text-center px-6">
                    <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-6">
                        <i data-lucide="shopping-bag" class="w-10 h-10 text-slate-300"></i>
                    </div>
                    <h3 class="text-2xl font-black uppercase italic text-slate-400">Keranjang Masih Kosong</h3>
                    <p class="text-slate-500 max-w-xs mt-2">Sepertinya Anda belum memesan material apapun untuk proyek Anda.</p>
                    <a href="<?= base_url('/user/produk'); ?>" class="mt-8 px-8 py-4 bg-primary text-white rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-orange-600 transition-all shadow-xl shadow-orange-500/20">
                        Mulai Belanja &rarr;
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-20 flex flex-col items-center">
            <div class="flex items-center gap-4 mb-4 opacity-20">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
                <i data-lucide="truck" class="w-5 h-5"></i>
                <i data-lucide="credit-card" class="w-5 h-5"></i>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">
                MateriaPro &bull; Premium Material Supply
            </p>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>