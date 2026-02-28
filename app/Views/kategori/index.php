<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori | MateriaPro</title>
    
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
        #dropdownContent:not(.hidden) { animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_admin'); ?>

    <main class="max-w-5xl mx-auto px-4 py-12">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] px-3 py-1 rounded-lg">Master Data</span>
                </div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Data <span class="text-primary italic">Kategori</span></h1>
                <p class="text-slate-500 dark:text-slate-400 font-medium text-sm mt-1 italic">Pengelompokan jenis material bangunan Anda.</p>
            </div>

            <div class="flex gap-3 w-full md:w-auto">
                <a href="<?= base_url('/kategori/create'); ?>" class="flex-1 md:flex-none flex items-center justify-center gap-3 bg-primary text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-orange-500/30 transition-all hover:scale-105 active:scale-95 text-sm uppercase">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    Tambah Kategori
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Nama Kategori</th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right italic">Manajemen Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800 font-bold text-sm">
                        <?php foreach($kategori as $k): ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-all group">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 flex items-center justify-center bg-orange-50 dark:bg-orange-500/10 rounded-xl text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                        <i data-lucide="layers" class="w-5 h-5"></i>
                                    </div>
                                    <span class="text-slate-800 dark:text-slate-200 tracking-tight text-base font-extrabold uppercase italic group-hover:text-primary transition-colors">
                                        <?= $k['nama_kategori']; ?>
                                    </span>
                                </div>
                            </td>
                            <td class="px-10 py-6">
                                <div class="flex justify-end gap-2">
                                    <a href="<?= base_url('/kategori/edit/'.$k['id_kategori']); ?>" 
                                       class="p-3 text-slate-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-2xl transition-all" 
                                       title="Edit Kategori">
                                        <i data-lucide="edit-3" class="w-5 h-5"></i>
                                    </a>
                                    <button onclick="hapusKategori('<?= base_url('/kategori/delete/'.$k['id_kategori']); ?>')" 
                                            class="p-3 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-2xl transition-all" 
                                            title="Hapus Kategori">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($kategori)): ?>
                        <tr>
                            <td colspan="2" class="px-10 py-20 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-400">
                                    <i data-lucide="folder-open" class="w-12 h-12 opacity-20"></i>
                                    <p class="italic font-medium">Belum ada kategori yang dibuat.</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="mt-16 text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] italic">
                MateriaPro System &bull; Catalog Management
            </p>
        </footer>
    </main>

    <script>
        lucide.createIcons();

        // SweetAlert Konfirmasi Hapus (Disederhanakan)
        function hapusKategori(url) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Barang dengan kategori ini mungkin akan terpengaruh!",
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
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
</body>
</html>