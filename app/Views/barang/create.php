<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Material Baru | MateriaPro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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
        .glass-input { 
            @apply bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200;
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <main class="max-w-4xl mx-auto px-4 py-12">
        
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-black tracking-tight">Tambah Barang</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm font-medium">Input material baru ke dalam ekosistem gudang.</p>
            </div>
            <a href="<?= base_url('/barang'); ?>" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 text-sm font-bold text-slate-500 hover:text-primary transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
            <form action="<?= base_url('/barang/store'); ?>" method="post" enctype="multipart/form-data" class="p-8 md:p-12">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Nama Material</label>
                            <input type="text" name="nama_barang" placeholder="Contoh: Semen Gresik 50kg" required
                                class="w-full px-5 py-4 rounded-2xl glass-input outline-none text-sm font-bold">
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Kategori</label>
                            <div class="relative">
                                <select name="id_kategori" required
                                    class="w-full px-5 py-4 rounded-2xl glass-input outline-none text-sm font-bold appearance-none">
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Harga (Rp)</label>
                                <input type="number" name="harga" placeholder="0" required
                                    class="w-full px-5 py-4 rounded-2xl glass-input outline-none text-sm font-bold">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Stok Awal</label>
                                <input type="number" name="stok" placeholder="0" required
                                    class="w-full px-5 py-4 rounded-2xl glass-input outline-none text-sm font-bold">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Foto Produk</label>
                            <div class="relative group">
                                <label class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-[2rem] cursor-pointer bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 transition-all">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-400 mb-2"></i>
                                        <p class="text-xs text-slate-400 font-bold">Klik untuk upload foto</p>
                                    </div>
                                    <input type="file" name="foto" class="hidden" onchange="previewImage(this)">
                                </label>
                                <div id="image-preview" class="absolute inset-0 hidden rounded-[2rem] overflow-hidden">
                                    <img src="#" class="w-full h-full object-cover">
                                    <button type="button" onclick="removeImage()" class="absolute top-3 right-3 p-2 bg-red-500 text-white rounded-full shadow-lg">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" placeholder="Jelaskan spesifikasi material..."
                                class="w-full px-5 py-4 rounded-2xl glass-input outline-none text-sm font-medium resize-none"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-800 pt-8">
                    <button type="reset" class="px-8 py-4 text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">
                        Reset Form
                    </button>
                    <button type="submit" class="bg-primary text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-orange-500/30 hover:bg-orange-600 hover:scale-105 transition-all flex items-center gap-3">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Simpan Material
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-10 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">
            MateriaPro System &bull; Secure Inventory Entry
        </p>
    </main>

    <script>
        lucide.createIcons();

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const img = preview.querySelector('img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const preview = document.getElementById('image-preview');
            const input = document.querySelector('input[type="file"]');
            input.value = "";
            preview.classList.add('hidden');
        }
    </script>
</body>
</html>