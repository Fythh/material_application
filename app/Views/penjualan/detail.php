<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi Admin | MateriaPro</title>
    
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
        .glass-card { backdrop-filter: blur(10px); }
        .dashed-line { border-style: dashed; }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <a href="<?= base_url('/penjualan') ?>" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-primary transition-colors mb-4 group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i> Kembali ke List
                </a>
                <h2 class="text-4xl font-black tracking-tighter uppercase italic">
                    Invoice <span class="text-primary">#TRX-<?= $pesanan['id_penjualan'] ?></span>
                </h2>
                <p class="text-slate-400 font-bold text-sm mt-1 italic flex items-center gap-2">
                    <i data-lucide="clock" class="w-4 h-4 text-primary"></i> 
                    Dibuat pada <?= date('d F Y, H:i', strtotime($pesanan['tanggal'])) ?> WIB
                </p>
            </div>

            <div class="flex items-center gap-3 p-4 bg-white dark:bg-darkCard rounded-[2rem] border border-slate-200 dark:border-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none">
                <span class="text-[10px] font-black uppercase text-slate-400 ml-2">Update Status:</span>
                <select onchange="updateStatus(<?= $pesanan['id_penjualan'] ?>, this.value)" 
                        class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 rounded-xl text-xs font-black border-none outline-none ring-2 ring-transparent focus:ring-primary cursor-pointer transition-all">
                    <option value="pending" <?= $pesanan['status'] == 'pending' ? 'selected' : '' ?>>⏳ Pending</option>
                    <option value="diproses" <?= $pesanan['status'] == 'diproses' ? 'selected' : '' ?>>🔄 Diproses</option>
                    <option value="dikirim" <?= $pesanan['status'] == 'dikirim' ? 'selected' : '' ?>>🚚 Dikirim</option>
                    <option value="selesai" <?= $pesanan['status'] == 'selesai' ? 'selected' : '' ?>>✅ Selesai</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
                        <h3 class="font-black uppercase italic tracking-wider flex items-center gap-3">
                            <i data-lucide="shopping-bag" class="w-5 h-5 text-primary"></i> Daftar Belanja
                        </h3>
                        <span class="px-4 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-full text-[10px] font-black uppercase text-slate-500 tracking-tighter">
                            <?= count($detail_pesanan) ?> Macam Item
                        </span>
                    </div>

                    <div class="p-4 space-y-4">
                        <?php foreach($detail_pesanan as $item): ?>
                        <div class="flex items-center gap-6 p-4 rounded-3xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors border border-transparent hover:border-slate-100 dark:hover:border-slate-700">
                            <div class="w-20 h-20 bg-slate-100 dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 flex-shrink-0">
                                <img src="<?= base_url('uploads/'.($item['foto'] ?? 'default.jpg')) ?>" class="w-full h-full object-cover" alt="Produk">
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-black text-primary uppercase mb-1 tracking-widest"><?= $item['kategori'] ?? 'MATERIAL' ?></p>
                                <h4 class="font-black text-lg leading-tight"><?= $item['nama_barang'] ?></h4>
                                <p class="text-xs text-slate-400 font-bold mt-1 italic"><?= $item['jumlah'] ?> Unit x Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1 tracking-tighter">Subtotal</p>
                                <p class="text-xl font-black text-slate-900 dark:text-white tracking-tighter italic">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="p-8 bg-slate-50/80 dark:bg-slate-800/40 border-t border-slate-100 dark:border-slate-800">
                        <div class="space-y-3 max-w-xs ml-auto">
                            <div class="flex justify-between text-sm font-bold text-slate-400 italic">
                                <span>Total Item</span>
                                <span class="text-slate-900 dark:text-white">Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between text-sm font-bold text-slate-400 italic">
                                <span>PPN (11%)</span>
                                <span class="text-slate-900 dark:text-white italic italic">Termasuk</span>
                            </div>
                            <div class="pt-4 mt-4 border-t-2 dashed-line border-slate-200 dark:border-slate-700 flex justify-between items-center">
                                <span class="font-black uppercase text-xs italic tracking-widest">GRAND TOTAL</span>
                                <span class="text-3xl font-black text-primary tracking-tighter italic">Rp <?= number_format($pesanan['total'], 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-8 shadow-sm">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-6 flex items-center gap-2 italic">
                        <i data-lucide="user" class="w-4 h-4"></i> Data Pelanggan
                    </h3>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-primary text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-lg shadow-orange-500/20">
                            <?= substr($pesanan['nama_pelanggan'], 0, 1) ?>
                        </div>
                        <div>
                            <p class="font-black text-lg leading-tight uppercase"><?= $pesanan['nama_pelanggan'] ?></p>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-tighter">ID: USER-<?= $pesanan['id_pelanggan'] ?></p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700">
                            <p class="text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest italic">Alamat Pengiriman</p>
                            <div class="flex gap-3">
                                <i data-lucide="map-pin" class="w-4 h-4 text-primary flex-shrink-0 mt-1"></i>
                                <p class="text-sm font-bold leading-relaxed text-slate-600 dark:text-slate-300"><?= $pesanan['alamat_pengiriman'] ?></p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700 flex items-center gap-3">
                                <i data-lucide="phone" class="w-4 h-4 text-primary"></i>
                                <p class="text-sm font-black"><?= $pesanan['telepon'] ?></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-blue-500/5 rounded-2xl border border-blue-500/10">
                                <p class="text-[10px] font-black text-blue-400 uppercase mb-1 tracking-tighter">Pembayaran</p>
                                <p class="text-sm font-black text-blue-600 uppercase italic"><?= $pesanan['pembayaran'] ?></p>
                            </div>
                            <div class="p-4 bg-purple-500/5 rounded-2xl border border-purple-500/10">
                                <p class="text-[10px] font-black text-purple-400 uppercase mb-1 tracking-tighter">Kurir</p>
                                <p class="text-sm font-black text-purple-600 uppercase italic"><?= $pesanan['pengiriman'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <button onclick="window.print()" class="w-full py-5 bg-dark dark:bg-slate-800 text-white dark:text-white rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] flex items-center justify-center gap-3 hover:bg-primary transition-all shadow-xl shadow-slate-200 dark:shadow-none">
                    <i data-lucide="printer" class="w-5 h-5"></i> Cetak Invoice
                </button>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        // Sama persis logic-nya dengan yang di Index (untuk kemudahan navigasi)
        function updateStatus(id, status) {
            Swal.fire({
                title: 'Update Status?',
                text: "Ubah status transaksi ini ke " + status.toUpperCase(),
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                confirmButtonText: 'YA, UPDATE!',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('<?= base_url('/penjualan/update-status') ?>/' + id, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'status=' + status
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({ icon: 'success', title: 'Updated!', showConfirmButton: false, timer: 1000 }).then(() => location.reload());
                        }
                    });
                } else {
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>