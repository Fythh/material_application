<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | MateriaPro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
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
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        .cart-item { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen selection:bg-primary/30">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-8 h-[2px] bg-primary"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary">Your Shopping Cart</span>
                </div>
                <h2 class="text-5xl font-black tracking-tighter leading-tight uppercase italic">
                    Keranjang <span class="text-primary">Belanja</span>
                </h2>
            </div>

            <?php if(!empty($items)): ?>
            <div class="flex items-center gap-3">
                <label class="group flex items-center gap-3 bg-white dark:bg-darkCard px-5 py-3 rounded-2xl border border-slate-200 dark:border-slate-800 cursor-pointer hover:border-primary transition-all shadow-sm">
                    <input type="checkbox" id="selectAll" class="w-5 h-5 rounded-md border-slate-300 text-primary focus:ring-primary dark:bg-slate-800 dark:border-slate-700">
                    <span class="text-xs font-black uppercase tracking-widest text-slate-500 group-hover:text-primary transition-colors">Pilih Semua</span>
                </label>
                
                <button id="btnDeleteSelected" onclick="deleteSelected()" class="hidden items-center gap-2 px-5 py-3 bg-red-500 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-red-600 transition-all shadow-lg shadow-red-500/20 active:scale-95">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Hapus (<span id="selectedCount">0</span>)
                </button>
            </div>
            <?php endif; ?>
        </div>

        <?php if(empty($items)): ?>
            <div class="bg-white dark:bg-darkCard rounded-[3rem] border border-dashed border-slate-300 dark:border-slate-800 p-20 text-center shadow-sm">
                <div class="w-24 h-24 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-cart" class="w-12 h-12 text-slate-300"></i>
                </div>
                <h3 class="text-2xl font-black uppercase italic mb-2">Wah, Keranjangmu Kosong!</h3>
                <p class="text-slate-400 mb-8 max-w-xs mx-auto">Mungkin ini saat yang tepat untuk mulai membangun proyek impian Anda.</p>
                <a href="<?= base_url('/user/produk'); ?>" class="inline-flex items-center gap-3 px-10 py-4 bg-primary text-white rounded-2xl font-black hover:bg-orange-600 transition-all shadow-xl shadow-orange-500/20 uppercase tracking-widest text-xs">
                    Mulai Belanja Sekarang
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-2 space-y-4">
                    <?php foreach($items as $item): ?>
                    <div class="cart-item group bg-white dark:bg-darkCard rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6 flex items-center gap-6 hover:shadow-xl hover:shadow-slate-200/50 dark:hover:shadow-none transition-all relative">
                        
                        <div class="flex-shrink-0">
                            <input type="checkbox" name="item_ids[]" value="<?= $item['id'] ?>" class="item-checkbox w-6 h-6 rounded-lg border-slate-300 text-primary focus:ring-primary dark:bg-slate-800 dark:border-slate-700 cursor-pointer">
                        </div>

                        <div class="w-28 h-28 rounded-2xl bg-slate-100 dark:bg-slate-800 overflow-hidden flex-shrink-0 border border-slate-100 dark:border-slate-700">
                            <?php 
                                $foto = $item['foto'] ?? '';
                                $urlFoto = (!empty($foto) && file_exists(FCPATH . 'uploads/' . $foto)) ? base_url('uploads/' . $foto) : 'https://via.placeholder.com/150';
                            ?>
                            <img src="<?= $urlFoto ?>" alt="<?= $item['nama_barang'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-2 mb-4">
                                <div>
                                    <span class="text-[9px] font-black text-primary uppercase tracking-[0.2em] mb-1 block"><?= $item['kategori'] ?? 'Material' ?></span>
                                    <h3 class="font-bold text-lg truncate pr-4 text-slate-800 dark:text-white"><?= $item['nama_barang'] ?></h3>
                                    <p class="text-sm font-bold text-slate-400">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                </div>
                                <button onclick="removeItem(<?= $item['id'] ?>)" class="md:opacity-0 group-hover:opacity-100 p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition-all">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center bg-slate-50 dark:bg-slate-800/50 p-1 rounded-xl border border-slate-100 dark:border-slate-700">
                                    <button onclick="updateQty(<?= $item['id'] ?>, 'decrease')" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white dark:hover:bg-slate-700 shadow-sm transition-all">
                                        <i data-lucide="minus" class="w-3 h-3"></i>
                                    </button>
                                    <input type="number" id="qty-<?= $item['id'] ?>" value="<?= $item['qty'] ?>" min="1" max="<?= $item['stok'] ?>" 
                                           class="w-12 text-center bg-transparent font-black text-sm outline-none" readonly>
                                    <button onclick="updateQty(<?= $item['id'] ?>, 'increase')" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white dark:hover:bg-slate-700 shadow-sm transition-all">
                                        <i data-lucide="plus" class="w-3 h-3"></i>
                                    </button>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Subtotal</p>
                                    <p class="font-black text-primary text-lg italic subtotal-val" id="subtotal-<?= $item['id'] ?>" data-raw="<?= $item['harga'] * $item['qty'] ?>">
                                        Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-darkCard rounded-[2.5rem] border border-slate-200 dark:border-slate-800 p-8 sticky top-28 shadow-xl shadow-slate-200/50 dark:shadow-none">
                        <h3 class="font-black text-xl mb-8 flex items-center gap-3 italic uppercase">
                            <i data-lucide="shopping-bag" class="w-6 h-6 text-primary"></i>
                            Ringkasan
                        </h3>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400 font-medium">Jumlah Item</span>
                                <span class="font-black" id="totalItemCount"><?= array_sum(array_column($items, 'qty')) ?> Unit</span>
                            </div>
                            <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>
                            <div class="flex justify-between items-end">
                                <span class="text-slate-400 text-sm font-medium">Total Estimasi</span>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter italic" id="finalTotalDisplay">
                                        Rp <?= number_format($total, 0, ',', '.') ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button onclick="confirmCheckout()" class="w-full py-5 bg-primary text-white rounded-[1.5rem] font-black hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/30 flex items-center justify-center gap-3 uppercase tracking-widest text-xs active:scale-95">
                                Checkout Sekarang
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </button>
                            <a href="<?= base_url('/user/produk') ?>" class="block w-full text-center py-4 text-slate-400 font-bold hover:text-primary transition-colors text-xs uppercase tracking-widest">
                                &larr; Tambah Material Lagi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

 <script>
    lucide.createIcons();

    // 1. SELECT LOGIC
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const btnDeleteBatch = document.getElementById('btnDeleteSelected');
    const selectedLabel = document.getElementById('selectedCount');

    if(selectAll) {
        selectAll.addEventListener('change', (e) => {
            checkboxes.forEach(cb => cb.checked = e.target.checked);
            toggleDeleteBtn();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            const allChecked = Array.from(checkboxes).every(c => c.checked);
            selectAll.checked = allChecked;
            toggleDeleteBtn();
        });
    });

    // --- FIX DI SINI: Tutup kurung kurawal yang benar ---
    window.addEventListener("pageshow", function (event) {
        var perfEntries = performance.getEntriesByType("navigation");
        if (perfEntries.length > 0 && perfEntries[0].type === "back_forward") {
            window.location.reload(); 
        }
    }); // <--- Tadi lo lupa ini

    function toggleDeleteBtn() {
        const checked = document.querySelectorAll('.item-checkbox:checked').length;
        if(selectedLabel) selectedLabel.innerText = checked;
        if(btnDeleteBatch) {
            btnDeleteBatch.classList.toggle('hidden', checked === 0);
            btnDeleteBatch.classList.toggle('flex', checked > 0);
        }
    }

    // 2. UPDATE QTY (AJAX Optimized)
    function updateQty(id, action) {
        const input = document.getElementById('qty-' + id);
        let current = parseInt(input.value);
        let next = action === 'increase' ? current + 1 : current - 1;

        if(next < 1) return;
        if(next > parseInt(input.max)) {
            Swal.fire({ icon: 'error', title: 'Stok Terbatas', text: 'Maksimal pembelian ' + input.max + ' unit', borderRadius: '1.5rem' });
            return;
        }

        fetch(`<?= base_url('/user/update-cart') ?>/${id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `qty=${next}`
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                location.reload(); 
            }
        });
    }

    // 3. REMOVE SINGLE
    function removeItem(id) {
        Swal.fire({
            title: 'Hapus Item?',
            text: "Material ini akan dikeluarkan dari keranjang",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f48c25',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            borderRadius: '2rem'
        }).then(r => { 
            if(r.isConfirmed) window.location.href = `<?= base_url('/user/remove/') ?>${id}`; 
        });
    }

    // 4. DELETE BATCH
    function deleteSelected() {
        const ids = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
        if (ids.length === 0) return;

        Swal.fire({
            title: 'Hapus Masal?',
            text: `Hapus ${ids.length} item pilihan Anda?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus Semua',
            cancelButtonText: 'Batal',
            borderRadius: '2rem'
        }).then(r => { 
            if(r.isConfirmed) window.location.href = `<?= base_url('/user/remove-batch') ?>?ids=${ids.join(',')}`; 
        });
    }

    // 5. CHECKOUT
    function confirmCheckout() {
        Swal.fire({
            title: 'Lanjut Checkout?',
            text: "Pastikan semua material dan jumlah sudah benar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f48c25',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal',
            borderRadius: '2rem'
        }).then(r => { 
            if(r.isConfirmed) window.location.href = `<?= base_url('/user/checkout') ?>`; 
        });
        return false; // Mencegah default link action sebelum confirm
    }
</script>
</body>
</html>