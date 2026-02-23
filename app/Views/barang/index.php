<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin - Toko Material</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="min-h-screen flex">
    <aside class="w-20 lg:w-64 bg-slate-900 text-white transition-all duration-300">
        <div class="p-6 text-center lg:text-left border-b border-slate-800">
            <span class="text-xl font-bold tracking-wider text-orange-500">MATERIAL <span class="text-white">PETIR</span></span>
        </div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="#" class="flex items-center gap-4 px-4 py-3 bg-orange-600 rounded-lg text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="hidden lg:block font-medium">Stok Barang</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-6 lg:p-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900">Data Barang</h1>
                <p class="text-slate-500 font-medium">Kelola inventaris toko material Anda dengan mudah.</p>
            </div>
            <a href="/barang/create" class="flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl font-bold shadow-lg transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Barang
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Stok</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($barang as $b): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-5">
                                <span class="font-bold text-slate-800 block text-sm"><?= $b['nama_barang']; ?></span>
                                <span class="text-xs text-slate-400">ID: #<?= $b['id']; ?></span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 text-[10px] font-extrabold rounded-md uppercase border border-orange-100">
                                    <?= $b['nama_kategori']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-sm font-bold text-slate-900">Rp <?= number_format($b['harga'], 0, ',', '.'); ?></span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 text-sm font-bold rounded-lg">
                                    <?= $b['stok']; ?> <span class="text-[10px] text-slate-400">Unit</span>
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-3">
                                    <a href="/barang/edit/<?= $b['id']; ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a href="/barang/delete/<?= $b['id']; ?>" onclick="return confirm('Yakin hapus?')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

</body>
</html>