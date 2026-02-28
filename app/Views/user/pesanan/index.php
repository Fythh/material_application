<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya | MateriaPro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        // SCRIPT SAKTI: Cek tema SEBELUM halaman render
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
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-10">
            <h2 class="text-4xl font-black tracking-tight leading-tight uppercase">
                Riwayat <span class="text-primary italic">Pesanan</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Pantau status pengiriman material Anda di sini.</p>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 italic">
                            <th class="px-8 py-6">ID Pesanan</th>
                            <th class="px-8 py-6">Tanggal</th>
                            <th class="px-8 py-6">Total Pembayaran</th>
                            <th class="px-8 py-6">Status</th>
                            <th class="px-8 py-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php if(!empty($pesanan)): ?>
                            <?php foreach($pesanan as $p): ?>
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors group">
                                <td class="px-8 py-5">
                                    <span class="font-black text-slate-900 dark:text-white uppercase italic">#<?= $p['id_penjualan'] ?? $p['id'] ?? '-'; ?></span>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-slate-500 dark:text-slate-400">
                                    <?php 
                                        if(isset($p['tanggal']) && !empty($p['tanggal'])) {
                                            echo date('d M Y', strtotime($p['tanggal']));
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td class="px-8 py-5">
                                    <p class="text-primary font-black text-lg italic">
                                        Rp <?= number_format($p['total'] ?? 0, 0, ',', '.'); ?>
                                    </p>
                                </td>
                                <td class="px-8 py-5">
                                    <?php 
                                        $status = $p['status'] ?? 'pending';
                                        $statusClass = '';
                                        $statusIcon = '';
                                        
                                        switch($status) {
                                            case 'pending': 
                                                $statusClass = 'bg-yellow-500/10 text-yellow-500'; 
                                                $statusIcon = 'clock';
                                                $statusText = 'Pending';
                                                break;
                                            case 'diproses': 
                                                $statusClass = 'bg-blue-500/10 text-blue-500'; 
                                                $statusIcon = 'refresh-cw';
                                                $statusText = 'Diproses';
                                                break;
                                            case 'dikirim': 
                                                $statusClass = 'bg-purple-500/10 text-purple-500'; 
                                                $statusIcon = 'truck';
                                                $statusText = 'Dikirim';
                                                break;
                                            case 'selesai': 
                                                $statusClass = 'bg-green-500/10 text-green-500'; 
                                                $statusIcon = 'check-circle';
                                                $statusText = 'Selesai';
                                                break;
                                            default: 
                                                $statusClass = 'bg-slate-500/10 text-slate-500';
                                                $statusIcon = 'help-circle';
                                                $statusText = ucfirst($status);
                                        }
                                    ?>
                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full <?= $statusClass; ?> text-[10px] font-black uppercase italic tracking-wider shadow-sm">
                                        <i data-lucide="<?= $statusIcon; ?>" class="w-3.5 h-3.5"></i>
                                        <?= $statusText; ?>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <a href="<?= base_url('/user/pesanan/detail/' . ($p['id_penjualan'] ?? $p['id'] ?? 0)); ?>" class="inline-flex items-center justify-center p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-primary hover:text-white transition-all shadow-sm">
                                        <i data-lucide="eye" class="w-5 h-5"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-slate-100 dark:bg-slate-800 p-6 rounded-full mb-4">
                                            <i data-lucide="shopping-cart" class="w-12 h-12 text-slate-300"></i>
                                        </div>
                                        <p class="text-slate-400 font-bold text-lg">Belum ada pesanan</p>
                                        <a href="<?= base_url('/user/produk'); ?>" class="mt-4 text-primary font-black uppercase text-xs hover:underline italic">Mulai Belanja Sekarang &rarr;</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="mt-16 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">
            MateriaPro &bull; Your Trusty Material Partner
        </p>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>