<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Barang - MateriaPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <a href="/barang" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 mb-6 transition-colors font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Barang
        </a>

        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200 overflow-hidden">
            <div class="bg-slate-900 p-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-3">
                    <div class="bg-orange-500 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    Tambah Barang Baru
                </h2>
                <p class="text-slate-400 text-xs mt-2 uppercase tracking-wider font-semibold">Detail Inventaris Material</p>
            </div>

            <form action="/barang/store" method="post" class="p-8 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Barang</label>
                    <input type="text" name="nama_barang" placeholder="Contoh: Semen Gresik 40kg" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <div class="relative">
                        <select name="id_kategori" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm appearance-none bg-white">
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <?php foreach($kategori as $k): ?>
                                <option value="<?= $k['id_kategori']; ?>">
                                    <?= $k['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                        <input type="number" name="harga" placeholder="0" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Stok Awal</label>
                        <input type="number" name="stok" placeholder="0" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-600/30 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan Data Barang
                    </button>
                </div>
            </form>
        </div>
        
        <p class="text-center text-slate-400 text-[10px] mt-8 uppercase tracking-[0.2em] font-bold">
            © 2024 MateriaPro Management System
        </p>
    </div>
</div>

</body>
</html>