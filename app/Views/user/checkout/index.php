<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan | MateriaPro</title>
    
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
</head>
<body class="bg-[#f8fafc] dark:bg-darkBody text-slate-900 dark:text-slate-100 min-h-screen">

    <?= view('layout/navbar_user'); ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-8">
            <h2 class="text-4xl font-black tracking-tight leading-tight uppercase">
                Konfirmasi <span class="text-primary italic">Pesanan</span>
            </h2>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Lengkapi data pengiriman sebelum checkout.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- FORM DATA PENGIRIMAN (KIRI) -->
            <div class="lg:col-span-2">
                <form id="checkoutForm" action="<?= base_url('/user/process-checkout') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <!-- Alamat Pengiriman -->
                    <div class="bg-white dark:bg-darkCard rounded-2xl border border-slate-200 dark:border-slate-800 p-6 mb-6">
                        <h3 class="font-black text-lg mb-4 flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i>
                            Alamat Pengiriman
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Nama Penerima</label>
                                <input type="text" name="nama_penerima" value="<?= session()->get('nama') ?? '' ?>" required
                                       class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary outline-none">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Nomor Telepon</label>
                                <input type="text" name="telepon" value="08123456789" required
                                       class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary outline-none">
                            </div>
                            
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Alamat Lengkap</label>
                                <textarea name="alamat" rows="3" required
                                          class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary outline-none">Jl. Contoh No. 123, Jakarta</textarea>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Kota</label>
                                    <input type="text" name="kota" value="Jakarta" required
                                           class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">Kode Pos</label>
                                    <input type="text" name="kode_pos" value="12345" required
                                           class="w-full px-5 py-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-primary outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opsi Pengiriman -->
                    <div class="bg-white dark:bg-darkCard rounded-2xl border border-slate-200 dark:border-slate-800 p-6 mb-6">
                        <h3 class="font-black text-lg mb-4 flex items-center gap-2">
                            <i data-lucide="truck" class="w-5 h-5 text-primary"></i>
                            Metode Pengiriman
                        </h3>
                        
                        <div class="space-y-3">
                            <label class="flex items-center justify-between p-4 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-primary transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pengiriman" value="reguler" checked class="w-4 h-4 text-primary">
                                    <div>
                                        <p class="font-black">Reguler (2-3 hari)</p>
                                        <p class="text-xs text-slate-400">Estimasi tiba 2-3 hari kerja</p>
                                    </div>
                                </div>
                                <span class="font-black text-primary">Rp 15.000</span>
                            </label>
                            
                            <label class="flex items-center justify-between p-4 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-primary transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pengiriman" value="cepat" class="w-4 h-4 text-primary">
                                    <div>
                                        <p class="font-black">Cepat (1 hari)</p>
                                        <p class="text-xs text-slate-400">Estimasi tiba besok</p>
                                    </div>
                                </div>
                                <span class="font-black text-primary">Rp 30.000</span>
                            </label>
                        </div>
                    </div>

                    <!-- Opsi Pembayaran -->
                    <div class="bg-white dark:bg-darkCard rounded-2xl border border-slate-200 dark:border-slate-800 p-6">
                        <h3 class="font-black text-lg mb-4 flex items-center gap-2">
                            <i data-lucide="credit-card" class="w-5 h-5 text-primary"></i>
                            Metode Pembayaran
                        </h3>
                        
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-primary transition-all">
                                <input type="radio" name="pembayaran" value="transfer" checked class="w-4 h-4 text-primary">
                                <div>
                                    <p class="font-black">Transfer Bank (BCA/Mandiri/BRI)</p>
                                    <p class="text-xs text-slate-400">Bayar via transfer ke rekening kami</p>
                                </div>
                            </label>
                            
                            <label class="flex items-center gap-3 p-4 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-primary transition-all">
                                <input type="radio" name="pembayaran" value="cod" class="w-4 h-4 text-primary">
                                <div>
                                    <p class="font-black">COD (Bayar di Tempat)</p>
                                    <p class="text-xs text-slate-400">Bayar pas barang sampai</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- RINGKASAN BELANJA (KANAN) -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-darkCard rounded-2xl border border-slate-200 dark:border-slate-800 p-6 sticky top-24">
                    <h3 class="font-black text-lg mb-6 flex items-center gap-2">
                        <i data-lucide="shopping-cart" class="w-5 h-5 text-primary"></i>
                        Ringkasan Belanja
                    </h3>

                    <!-- Daftar Produk -->
                    <div class="space-y-4 mb-6 max-h-60 overflow-y-auto">
                        <?php foreach($items as $item): ?>
                        <div class="flex justify-between text-sm">
                            <div>
                                <span class="font-black"><?= $item['nama_barang'] ?></span>
                                <span class="text-xs text-slate-400 block"><?= $item['qty'] ?> x Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                            </div>
                            <span class="font-black">Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.') ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Detail Biaya -->
                    <div class="space-y-3 mb-6 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Subtotal</span>
                            <span class="font-black">Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Ongkos Kirim</span>
                            <span class="font-black" id="ongkir">Rp 15.000</span>
                        </div>
                        <div class="flex justify-between text-lg">
                            <span class="font-black">Total</span>
                            <span class="font-black text-primary" id="totalBayar">Rp <?= number_format($total + 15000, 0, ',', '.') ?></span>
                        </div>
                    </div>

                    <!-- Tombol Buat Pesanan -->
                    <button onclick="submitCheckout()" class="w-full py-5 bg-primary text-white rounded-xl font-black hover:bg-orange-600 transition-all text-lg">
                        <i data-lucide="check-circle" class="w-5 h-5 inline mr-2"></i>
                        BUAT PESANAN
                    </button>

                    <p class="text-[10px] text-center text-slate-400 mt-4">
                        Dengan membuat pesanan, Anda menyetujui syarat & ketentuan yang berlaku
                    </p>
                </div>
            </div>
        </div>

    </main>

    <script>
        lucide.createIcons();

        // Hitung ulang total saat pilih pengiriman
        document.querySelectorAll('input[name="pengiriman"]').forEach(radio => {
            radio.addEventListener('change', function() {
                let subtotal = <?= $total ?>;
                let ongkir = this.value === 'reguler' ? 15000 : 30000;
                
                document.getElementById('ongkir').innerText = 'Rp ' + ongkir.toLocaleString('id-ID');
                document.getElementById('totalBayar').innerText = 'Rp ' + (subtotal + ongkir).toLocaleString('id-ID');
            });
        });

        // Submit form
        function submitCheckout() {
            Swal.fire({
                title: 'Buat Pesanan?',
                text: "Pastikan data pengiriman sudah benar",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#f48c25',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, PESAN!',
                cancelButtonText: 'CEK LAGI',
                background: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                borderRadius: '2rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('checkoutForm').submit();
                }
            });
        }
    </script>
</body>
</html>