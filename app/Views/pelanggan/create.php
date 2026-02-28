<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Pelanggan - MateriaPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <a href="/pelanggan" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 mb-6 transition-colors font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Batal dan Kembali
        </a>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200 overflow-hidden">
            <div class="bg-slate-900 p-8 border-b-4 border-orange-500">
                <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                    <div class="bg-orange-500 p-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    Pelanggan Baru
                </h2>
                <p class="text-slate-400 text-xs mt-2 uppercase tracking-widest font-bold">Pendaftaran Membership Toko</p>
            </div>

            <form action="/pelanggan/store" method="post" class="p-8 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" placeholder="Masukkan nama pelanggan..." required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Telepon / WA</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400 font-bold text-sm">+62</span>
                        <input type="text" name="telepon" placeholder="8123456xxx" required
                            class="w-full pl-14 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm font-semibold text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Pengiriman</label>
                    <textarea name="alamat" rows="4" placeholder="Alamat lengkap rumah atau lokasi proyek..." required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm font-semibold text-slate-800 resize-none"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-orange-600/30 transition-all active:scale-[0.98] flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan Data Pelanggan
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-slate-400 text-[10px] mt-8 uppercase tracking-[0.3em] font-bold">
            © 2024 MATERIAPRO CORE SYSTEM
        </p>
    </div>
</div>

</body>
</html>