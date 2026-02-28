<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan | MateriaPro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
        .produk-item { transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-6 flex items-center gap-2 text-sm">
            <a href="/user/pesanan" class="text-slate-400 hover:text-primary flex items-center gap-1 font-medium transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Pesanan
            </a>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-8 mb-8 shadow-xl">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black uppercase italic">
                        Detail <span class="text-primary">Pesanan</span>
                    </h2>
                    <p class="text-slate-400 mt-1 font-medium italic tracking-wider">#TRX-<?= $pesanan['id_penjualan'] ?? '0' ?></p>
                </div>
                
                <?php 
                $status = $pesanan['status'] ?? 'pending';
                $statusClass = '';
                $statusIcon = '';
                $statusText = '';
                
                switch($status) {
                    case 'pending':
                        $statusClass = 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20';
                        $statusIcon = 'clock';
                        $statusText = 'Menunggu Pembayaran';
                        break;
                    case 'diproses':
                        $statusClass = 'bg-blue-500/10 text-blue-500 border-blue-500/20';
                        $statusIcon = 'refresh-cw';
                        $statusText = 'Sedang Diproses';
                        break;
                    case 'dikirim':
                        $statusClass = 'bg-purple-500/10 text-purple-500 border-purple-500/20';
                        $statusIcon = 'truck';
                        $statusText = 'Dalam Pengiriman';
                        break;
                    case 'selesai':
                        $statusClass = 'bg-green-500/10 text-green-500 border-green-500/20';
                        $statusIcon = 'check-circle';
                        $statusText = 'Selesai';
                        break;
                    case 'batal':
                        $statusClass = 'bg-red-500/10 text-red-500 border-red-500/20';
                        $statusIcon = 'x-circle';
                        $statusText = 'Dibatalkan';
                        break;
                    default:
                        $statusClass = 'bg-slate-500/10 text-slate-500 border-slate-500/20';
                        $statusIcon = 'help-circle';
                        $statusText = ucfirst($status);
                }
                ?>
                <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full <?= $statusClass ?> border">
                    <i data-lucide="<?= $statusIcon ?>" class="w-5 h-5"></i>
                    <span class="font-black uppercase tracking-wider text-sm"><?= $statusText ?></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl">
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4"></i> Informasi Pengiriman
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between border-b border-slate-200 dark:border-slate-700 pb-2 text-sm">
                            <span class="text-slate-400">Penerima</span>
                            <span class="font-bold"><?= $pesanan['nama_penerima'] ?? '-' ?></span>
                        </div>
                        <div class="flex justify-between border-b border-slate-200 dark:border-slate-700 pb-2 text-sm">
                            <span class="text-slate-400">Telepon</span>
                            <span class="font-bold"><?= $pesanan['telepon'] ?? '-' ?></span>
                        </div>
                        <div class="flex flex-col gap-1 text-sm">
                            <span class="text-slate-400">Alamat Lengkap</span>
                            <span class="font-bold leading-relaxed"><?= $pesanan['alamat_pengiriman'] ?? '-' ?></span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2">
                        <i data-lucide="credit-card" class="w-4 h-4"></i> Detail Transaksi
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between border-b border-slate-200 dark:border-slate-700 pb-2 text-sm">
                            <span class="text-slate-400">Metode Bayar</span>
                            <span class="font-bold uppercase text-primary"><?= $pesanan['pembayaran'] ?? '-' ?></span>
                        </div>
                        <div class="flex justify-between border-b border-slate-200 dark:border-slate-700 pb-2 text-sm">
                            <span class="text-slate-400">Tanggal</span>
                            <span class="font-bold"><?= date('d M Y, H:i', strtotime($pesanan['tanggal'] ?? date('Y-m-d'))) ?> WIB</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Pengiriman</span>
                            <span class="font-bold uppercase"><?= $pesanan['pengiriman'] ?? '-' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-8 shadow-xl mb-8">
            <h3 class="text-xl font-black uppercase italic mb-6 flex items-center gap-2">
                <i data-lucide="package" class="w-6 h-6 text-primary"></i>
                Item <span class="text-primary">Pesanan</span>
            </h3>

            <div class="space-y-4">
                <?php if(!empty($detail_pesanan)): ?>
                    <?php foreach($detail_pesanan as $item): ?>
                    <div class="produk-item flex flex-col sm:flex-row gap-6 p-5 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-primary transition-all">
                        
                        <div class="w-24 h-24 rounded-xl bg-white dark:bg-slate-800 overflow-hidden flex-shrink-0 border border-slate-200 dark:border-slate-700 shadow-sm">
                            <?php 
                                $foto = $item['foto'] ?? '';
                                $urlFoto = (!empty($foto) && file_exists(FCPATH . 'uploads/' . $foto)) 
                                           ? base_url('uploads/' . $foto) 
                                           : 'https://via.placeholder.com/200x200?text=Produk';
                            ?>
                            <img src="<?= $urlFoto ?>" alt="Produk" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1"><?= $item['kategori'] ?? 'MATERIAL' ?></p>
                                    <h4 class="font-black text-lg"><?= $item['nama_barang'] ?? 'Produk' ?></h4>
                                    <p class="text-slate-400 text-sm mt-1">Harga Satuan: <span class="text-slate-900 dark:text-slate-100 font-bold">Rp <?= number_format($item['harga'] ?? 0, 0, ',', '.') ?></span></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-slate-400 uppercase font-bold tracking-tighter">Subtotal</p>
                                    <p class="text-primary font-black text-2xl">Rp <?= number_format(($item['harga'] ?? 0) * ($item['jumlah'] ?? 1), 0, ',', '.') ?></p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-lg text-xs font-black uppercase tracking-widest">
                                        Qty: <?= $item['jumlah'] ?? 1 ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="mt-8 pt-6 border-t-2 border-dashed border-slate-200 dark:border-slate-700">
                <div class="flex justify-end">
                    <div class="w-full sm:w-80 space-y-3">
                        <div class="flex justify-between text-slate-400">
                            <span class="font-medium">Total Belanja</span>
                            <span class="font-bold text-slate-900 dark:text-slate-100 text-lg">Rp <?= number_format($pesanan['total'] ?? 0, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between py-4 border-t border-slate-200 dark:border-slate-700 mt-2">
                            <span class="text-xl font-black uppercase italic italic">Total Bayar</span>
                            <span class="text-2xl font-black text-primary italic">Rp <?= number_format($pesanan['total'] ?? 0, 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-4">
            <a href="/user/pesanan" class="order-2 sm:order-1 px-10 py-4 bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 rounded-2xl font-black transition-all text-center">
                KEMBALI
            </a>
            <?php if($status == 'pending'): ?>
            <button onclick="batalkanPesanan(<?= $pesanan['id_penjualan'] ?>)" class="order-1 sm:order-2 px-10 py-4 bg-red-500 hover:bg-red-600 text-white rounded-2xl font-black shadow-lg shadow-red-500/20 transition-all flex items-center justify-center gap-2">
                <i data-lucide="trash-2" class="w-5 h-5"></i>
                BATALKAN PESANAN
            </button>
            <?php endif; ?>
        </div>

    </main>

    <script>
        lucide.createIcons();

        function batalkanPesanan(id) {
            if (!id) {
                console.error("ID Pesanan tidak ditemukan");
                return;
            }

            Swal.fire({
                title: 'BATALKAN PESANAN?',
                text: "Pesanan akan dibatalkan permanen dan stok akan dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, BATALKAN!',
                cancelButtonText: 'TIDAK',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#0f172a',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    // MENGARAH KE ROUTE YANG SUDAH KITA SET DI CONFIG/ROUTES.PHP
                    window.location.href = "<?= base_url('user/pesanan/batalkanPesanan') ?>/" + id;
                }
            });
        }
    </script>
</body>
</html>