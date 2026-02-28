<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Material #<?= $barang['id']; ?> | MateriaPro</title>
    
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
            @apply bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all duration-200 outline-none;
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-black tracking-tight leading-none">Edit Material</h2>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-slate-400 font-medium italic text-sm">Inventori</span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i>
                    <span class="text-primary font-bold text-sm uppercase tracking-wider">Update Item #<?= $barang['id']; ?></span>
                </div>
            </div>
            <a href="<?= base_url('/barang'); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 text-sm font-bold text-slate-500 hover:text-primary transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Batal & Kembali
            </a>
        </div>

        <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden">
            <form action="<?= base_url('/barang/update/' . $barang['id']); ?>" method="post" enctype="multipart/form-data" class="p-8 md:p-12">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1">Nama Barang</label>
                            <input type="text" name="nama_barang" value="<?= $barang['nama_barang']; ?>" required
                                class="w-full px-5 py-4 rounded-2xl glass-input text-sm font-bold">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1">Kategori Material</label>
                            <div class="relative">
                                <select name="id_kategori" required
                                    class="w-full px-5 py-4 rounded-2xl glass-input text-sm font-bold appearance-none bg-transparent">
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k['id_kategori']; ?>" 
                                            <?= $k['id_kategori'] == $barang['id_kategori'] ? 'selected' : ''; ?>
                                            class="dark:bg-darkCard">
                                            <?= $k['nama_kategori']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1">Harga (Rp)</label>
                                <input type="number" name="harga" value="<?= $barang['harga']; ?>" required
                                    class="w-full px-5 py-4 rounded-2xl glass-input text-sm font-bold">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1">Stok Gudang</label>
                                <input type="number" name="stok" value="<?= $barang['stok']; ?>" required
                                    class="w-full px-5 py-4 rounded-2xl glass-input text-sm font-bold">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1">Update Foto Produk</label>
                            <div class="flex flex-col gap-4">
                                <div id="preview-box" class="relative w-full h-44 rounded-[2.5rem] bg-slate-100 dark:bg-slate-800/50 border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden group">
                                    
                                    <img id="img-display" 
                                         src="<?= !empty($barang['foto']) ? base_url('/uploads/' . $barang['foto']) : ''; ?>" 
                                         class="<?= !empty($barang['foto']) ? 'block' : 'hidden'; ?> w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                    
                                    <div id="placeholder-icon" class="<?= !empty($barang['foto']) ? 'hidden' : 'flex'; ?> flex-col items-center gap-2 text-slate-400">
                                        <i data-lucide="image-plus" class="w-10 h-10"></i>
                                        <span class="text-[10px] font-bold uppercase tracking-widest">Belum Ada Foto</span>
                                    </div>

                                    <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                        <div class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-xl border border-white/30">
                                            <span class="text-xs font-bold text-white uppercase tracking-tighter">Pilih Foto Baru</span>
                                        </div>
                                    </div>

                                    <input type="file" name="foto" onchange="previewImg(this)" class="absolute inset-0 opacity-0 cursor-pointer">
                                </div>
                                <p class="text-[9px] text-slate-400 italic text-center leading-none">* Biarkan kosong jika tidak ingin mengubah foto</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1">Deskripsi Produk</label>
                            <textarea name="deskripsi" rows="4" placeholder="Update spesifikasi lengkap di sini..."
                                class="w-full px-5 py-4 rounded-2xl glass-input text-sm font-medium italic resize-none"><?= $barang['deskripsi']; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <button type="button" onclick="window.history.back()" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-red-500 transition-colors">
                        Batalkan Perubahan
                    </button>
                    <button type="submit" class="bg-primary text-white px-12 py-4 rounded-2xl font-black shadow-xl shadow-orange-500/30 hover:bg-orange-600 hover:scale-105 transition-all flex items-center gap-3">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        lucide.createIcons();

        function previewImg(input) {
            const display = document.getElementById('img-display');
            const placeholder = document.getElementById('placeholder-icon');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Update sumber gambar
                    display.src = e.target.result;
                    
                    // Tampilkan gambar & sembunyikan placeholder
                    display.classList.remove('hidden');
                    display.classList.add('block');
                    
                    if (placeholder) {
                        placeholder.classList.remove('flex');
                        placeholder.classList.add('hidden');
                    }
                    
                    // Reset opacity kalau sebelumnya 60
                    display.classList.remove('opacity-80');
                    display.classList.add('opacity-100');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>