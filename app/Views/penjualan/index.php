<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penjualan | MateriaPro</title>
    
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
        .glass-nav { backdrop-filter: blur(10px); }
        tr { transition: all 0.2s ease-in-out; }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-black tracking-tight leading-none uppercase">
                    Riwayat <span class="text-primary italic">Penjualan</span>
                </h2>
                <div class="flex items-center gap-2 mt-3">
                    <span class="bg-blue-500/10 text-blue-500 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-lg">Finance</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i>
                    <span class="text-slate-400 font-bold text-xs italic">Arus Kas & Transaksi Keluar</span>
                </div>
            </div>
            
            <!-- TOMBOL TAMBAH DIHAPUS - karena data otomatis dari user -->
        </div>

        <!-- FILTER STATUS -->
        <div class="mb-6 flex flex-wrap gap-3">
            <button onclick="filterStatus('all')" class="status-filter active px-6 py-3 rounded-xl bg-primary text-white text-xs font-black uppercase tracking-wider transition-all" data-status="all">Semua</button>
            <button onclick="filterStatus('pending')" class="status-filter px-6 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white text-xs font-black uppercase tracking-wider transition-all" data-status="pending">⏳ Pending</button>
            <button onclick="filterStatus('diproses')" class="status-filter px-6 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white text-xs font-black uppercase tracking-wider transition-all" data-status="diproses">🔄 Diproses</button>
            <button onclick="filterStatus('dikirim')" class="status-filter px-6 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white text-xs font-black uppercase tracking-wider transition-all" data-status="dikirim">🚚 Dikirim</button>
            <button onclick="filterStatus('selesai')" class="status-filter px-6 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-primary hover:text-white text-xs font-black uppercase tracking-wider transition-all" data-status="selesai">✅ Selesai</button>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Tanggal & ID</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Item & Pelanggan</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic text-center">Qty</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Total Nominal</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic">Status</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 italic text-right">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800" id="penjualanTable">
                        <?php if(!empty($penjualan)): ?>
                            <?php foreach($penjualan as $p): ?>
                            <tr class="penjualan-row hover:bg-slate-50/80 dark:hover:bg-slate-800/40 group" data-status="<?= $p['status'] ?? 'pending' ?>">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 flex items-center justify-center bg-slate-100 dark:bg-slate-800 rounded-xl text-slate-400 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                            <i data-lucide="calendar" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <span class="block font-black text-sm text-slate-700 dark:text-slate-200 uppercase"><?= date('d M Y', strtotime($p['tanggal'])); ?></span>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">ID: #TRX-<?= $p['id_penjualan']; ?></span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <span class="block font-extrabold text-slate-900 dark:text-white text-base group-hover:text-primary transition-colors italic"><?= $p['nama_barang'] ?? 'Produk Tidak Diketahui'; ?></span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="w-2 h-2 rounded-full bg-primary/40"></div>
                                        <span class="text-xs text-slate-400 font-bold uppercase tracking-tight"><?= $p['nama_pelanggan'] ?? 'Pelanggan Tidak Diketahui'; ?></span>
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <span class="inline-block px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-xl text-xs font-black dark:text-slate-300">
                                        <?= $p['jumlah']; ?> <span class="text-[9px] text-slate-400 uppercase ml-1">Unit</span>
                                    </span>
                                </td>

                                <td class="px-8 py-6">
                                    <span class="block text-[10px] text-slate-400 line-through italic mb-0.5">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></span>
                                    <span class="text-lg font-black text-primary tracking-tighter italic">Rp <?= number_format($p['total'], 0, ',', '.'); ?></span>
                                </td>

                                <td class="px-8 py-6">
                                    <?php 
                                    $status = $p['status'] ?? 'pending';
                                    $badgeClass = '';
                                    $statusIcon = '';
                                    
                                    switch($status) {
                                        case 'pending':
                                            $badgeClass = 'bg-yellow-500/10 text-yellow-500';
                                            $statusIcon = 'clock';
                                            break;
                                        case 'diproses':
                                            $badgeClass = 'bg-blue-500/10 text-blue-500';
                                            $statusIcon = 'refresh-cw';
                                            break;
                                        case 'dikirim':
                                            $badgeClass = 'bg-purple-500/10 text-purple-500';
                                            $statusIcon = 'truck';
                                            break;
                                        case 'selesai':
                                            $badgeClass = 'bg-green-500/10 text-green-500';
                                            $statusIcon = 'check-circle';
                                            break;
                                        default:
                                            $badgeClass = 'bg-slate-500/10 text-slate-500';
                                            $statusIcon = 'help-circle';
                                    }
                                    ?>
                                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full <?= $badgeClass ?> text-[10px] font-black uppercase tracking-wider">
                                        <i data-lucide="<?= $statusIcon ?>" class="w-3.5 h-3.5"></i>
                                        <span class="status-text"><?= ucfirst($status) ?></span>
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-right">
    <div class="flex items-center justify-end gap-3">
        <a href="<?= base_url('/penjualan/detail/'.$p['id_penjualan']); ?>" 
           class="p-3 text-slate-400 hover:text-primary hover:bg-orange-50 dark:hover:bg-orange-500/10 rounded-2xl transition-all group">
            <i data-lucide="eye" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
        </a>

        <select onchange="updateStatus(<?= $p['id_penjualan'] ?>, this.value)" 
                class="status-select px-4 py-3 bg-slate-100 dark:bg-slate-800 rounded-xl text-xs font-black border border-slate-200 dark:border-slate-700 outline-none cursor-pointer">
            <option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>⏳</option>
            <option value="diproses" <?= $status == 'diproses' ? 'selected' : '' ?>>🔄</option>
            <option value="dikirim" <?= $status == 'dikirim' ? 'selected' : '' ?>>🚚</option>
            <option value="selesai" <?= $status == 'selesai' ? 'selected' : '' ?>>✅</option>
        </select>
    </div>
</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-24 text-center">
                                    <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                        <i data-lucide="receipt" class="w-10 h-10 text-slate-200"></i>
                                    </div>
                                    <p class="text-slate-400 font-black italic uppercase tracking-[0.3em] text-xs text-center">Belum ada transaksi penjualan</p>
                                    <p class="text-slate-400 text-sm mt-2">Transaksi akan muncul otomatis saat user melakukan checkout</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="mt-16 text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">
                MateriaPro System &bull; Transaction Ledger &bull; 2026
            </p>
        </footer>
    </main>

    <script>
        lucide.createIcons();

        // FILTER STATUS
        function filterStatus(status) {
            const rows = document.querySelectorAll('.penjualan-row');
            const buttons = document.querySelectorAll('.status-filter');
            
            // Update active button
            buttons.forEach(btn => {
                if (btn.dataset.status === status) {
                    btn.classList.remove('bg-slate-200', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-400');
                    btn.classList.add('bg-primary', 'text-white');
                } else {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('bg-slate-200', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-400');
                }
            });

            // Filter rows
            rows.forEach(row => {
                const rowStatus = row.dataset.status;
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // UPDATE STATUS VIA AJAX
        function updateStatus(id, status) {
            Swal.fire({
                title: 'Update Status?',
                text: "Status pesanan akan diubah menjadi " + status,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, UPDATE!',
                cancelButtonText: 'BATAL',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request ke server
                    fetch('<?= base_url('/penjualan/update-status') ?>/' + id, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'status=' + status
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Status pesanan telah diupdate',
                                showConfirmButton: false,
                                timer: 1500,
                                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                                borderRadius: '2rem'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                } else {
                    // Reset select ke nilai sebelumnya
                    location.reload();
                }
            });
        }

        // HAPUS TRANSAKSI
        function konfirmasiHapus(url) {
            Swal.fire({
                title: 'BATALKAN TRANSAKSI?',
                text: "Stok barang akan dikembalikan secara otomatis ke gudang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, BATALKAN!',
                cancelButtonText: 'TIDAK',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>
</html>