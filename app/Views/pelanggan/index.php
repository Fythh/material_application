<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan | MateriaPro</title>
    
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
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-black tracking-tight leading-tight uppercase">
                    Data <span class="text-primary italic">Pelanggan</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Daftar pelanggan setia toko material Anda.</p>
            </div>
            
            <a href="<?= base_url('/pelanggan/create'); ?>" class="w-full lg:w-auto justify-center flex items-center gap-2 bg-slate-900 dark:bg-primary text-white px-8 py-4 rounded-2xl font-black shadow-xl transition-all hover:scale-105 active:scale-95">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                <span>TAMBAH PELANGGAN</span>
            </a>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 italic">
                            <th class="px-8 py-6">Profil Pelanggan</th>
                            <th class="px-8 py-6">Kontak & Telepon</th>
                            <th class="px-8 py-6">Alamat Tinggal</th>
                            <th class="px-8 py-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php foreach($pelanggan as $p): ?>
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-500/10 text-primary flex items-center justify-center font-black text-lg border border-orange-200 dark:border-orange-500/20">
                                        <?= strtoupper(substr($p['nama_pelanggan'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors italic leading-none mb-1"><?= $p['nama_pelanggan']; ?></div>
                                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">ID: #<?= $p['id_pelanggan']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2 text-sm font-bold text-slate-600 dark:text-slate-400">
                                    <i data-lucide="phone" class="w-4 h-4 text-primary"></i>
                                    <?= $p['telepon']; ?>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-sm font-medium text-slate-500 dark:text-slate-400 italic truncate block max-w-xs">
                                    <?= $p['alamat']; ?>
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="<?= base_url('/pelanggan/edit/' . $p['id_pelanggan']); ?>" class="p-2.5 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-500/10 hover:text-blue-500 text-slate-400 transition-all"><i data-lucide="edit-3" class="w-4 h-4"></i></a>
                                    <button onclick="confirmHapus('<?= base_url('/pelanggan/delete/' . $p['id_pelanggan']); ?>')" class="p-2.5 rounded-xl hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-500 text-slate-400 transition-all"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();

        function confirmHapus(url) {
            Swal.fire({
                title: 'Hapus Pelanggan?',
                text: "Riwayat belanja pelanggan ini akan tetap tersimpan di database.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = url;
            })
        }
    </script>
</body>
</html>