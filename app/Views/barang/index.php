<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Barang | MateriaPro</title>
    
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
                    colors: { primary: '#f48c25', darkBody: '#0f172a', darkCard: '#1e293b' }
                }
            }
        }
    </script>
    <style>
        body { transition: background-color 0.3s; }
        .glass-nav { backdrop-filter: blur(10px); }
        /* Animasi Dropdown agar smooth */
        #dropdownContent:not(.hidden) {
            animation: fadeIn 0.2s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tight leading-tight uppercase">
                    Data <span class="text-primary italic">Barang</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Manajemen stok material bangunan.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                <div class="relative flex-1 lg:flex-none min-w-[200px]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="filter" class="w-4 h-4"></i>
                    </div>
                    <select id="categoryFilter" class="w-full pl-10 pr-10 py-4 bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-2xl appearance-none focus:ring-2 focus:ring-primary outline-none font-bold text-sm shadow-sm transition-all cursor-pointer">
                        <option value="all">Semua Kategori</option>
                        <?php 
                        $list_kategori = array_unique(array_column($barang, 'nama_kategori'));
                        foreach($list_kategori as $kat): 
                        ?>
                            <option value="<?= $kat; ?>"><?= $kat; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </div>
                </div>

                <a href="<?= base_url('/barang/create'); ?>" class="flex-1 lg:flex-none justify-center flex items-center gap-2 bg-primary hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-orange-500/30 transition-all hover:scale-105 active:scale-95">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    <span>TAMBAH</span>
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="barangTable">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 italic">
                            <th class="px-8 py-6">Produk</th>
                            <th class="px-8 py-6">Kategori</th>
                            <th class="px-8 py-6 text-center">Stok</th>
                            <th class="px-8 py-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php foreach($barang as $b): ?>
                        <tr class="barang-row hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors group" data-category="<?= $b['nama_kategori']; ?>">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 dark:bg-slate-800 overflow-hidden border border-slate-200 dark:border-slate-700 shadow-inner">
                                        <?php if (!empty($b['foto'])): ?>
                                            <img src="<?= base_url('/uploads/' . $b['foto']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                <i data-lucide="image" class="w-6 h-6"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors italic leading-none mb-1"><?= $b['nama_barang']; ?></div>
                                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rp <?= number_format($b['harga'], 0, ',', '.'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-slate-700">
                                    <?= $b['nama_kategori']; ?>
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full <?= $b['stok'] > 5 ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' ?> text-xs font-black italic">
                                    <?= $b['stok']; ?>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-end gap-2 text-slate-400">
                                    <a href="<?= base_url('/barang/edit/' . $b['id']); ?>" class="p-2.5 rounded-xl hover:bg-orange-50 dark:hover:bg-orange-500/10 hover:text-primary transition-all"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                                    <button onclick="confirmHapus('<?= base_url('/barang/delete/' . $b['id']); ?>')" class="p-2.5 rounded-xl hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-500 transition-all"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="mt-12 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">
            MateriaPro &bull; Inventory Management
        </p>
    </main>

    <script>
        lucide.createIcons();

        // 1. Script Filter Kategori
        const filter = document.getElementById('categoryFilter');
        const rows = document.querySelectorAll('.barang-row');
        filter.addEventListener('change', function() {
            const selected = this.value;
            rows.forEach(row => {
                const category = row.getAttribute('data-category');
                row.style.display = (selected === 'all' || category === selected) ? '' : 'none';
            });
        });

        // 2. Script Hapus Barang (Pake SweetAlert)
        function confirmHapus(url) {
            Swal.fire({
                title: 'Hapus Barang ini?',
                text: "Data yang dihapus tidak bisa balik lagi bro!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Jangan Jadi',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
</body>
</html>