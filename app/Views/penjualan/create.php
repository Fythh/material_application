<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Penjualan - MateriaPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        /* Hilangkan spinner input number biar rapi */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body>

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-2xl">
        <a href="/penjualan" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 mb-6 transition-colors font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Riwayat
        </a>

        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200 overflow-hidden">
            <div class="bg-slate-900 p-8 border-b-4 border-orange-500">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white flex items-center gap-3">
                            <div class="bg-orange-500 p-2 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            Transaksi Baru
                        </h2>
                        <p class="text-slate-400 text-xs mt-2 uppercase tracking-[0.2em] font-bold">Input Penjualan Material</p>
                    </div>
                    <div class="text-right">
                        <span class="text-slate-500 text-[10px] font-bold uppercase block">Tanggal</span>
                        <span class="text-white font-bold text-sm"><?= date('d F Y'); ?></span>
                    </div>
                </div>
            </div>

            <form action="/penjualan/store" method="post" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Cari Barang</label>
                    <select name="id_barang" id="id_barang" onchange="updateTotal()" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm font-semibold text-slate-800 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGZpbGw9Im5vbmUiIHZpZXdCb3g9IjAgMCAyNCAyNCIgc3Ryb2tlPSJ0ZXh0LXNsYXRlLTQwMCI+PHBhdGggc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjIiIGQ9Ik0xOSA5bC03IDctNy03Ii8+PC9zdmc+')] bg-[length:20px] bg-[right_1rem_center] bg-no-repeat">
                        <option value="" disabled selected>Pilih material...</option>
                        <?php foreach($barang as $b): ?>
    <option value="<?= $b['id']; ?>" data-harga="<?= $b['harga']; ?>" data-stok="<?= $b['stok']; ?>">
        <?= $b['nama_barang']; ?> — Sisa: <?= $b['stok']; ?> (Rp <?= number_format($b['harga'], 0, ',', '.'); ?>)
    </option>
<?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Pelanggan</label>
                    <select name="id_pelanggan" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm">
                        <?php foreach($pelanggan as $p): ?>
                            <option value="<?= $p['id_pelanggan']; ?>"><?= $p['nama_pelanggan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Jumlah Beli</label>
                    <input type="number" name="jumlah" id="jumlah" oninput="updateTotal()" placeholder="0" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 outline-none transition-all text-sm font-bold">
                </div>

                <div class="md:col-span-2 bg-slate-50 rounded-2xl p-6 border border-dashed border-slate-300">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 font-bold text-sm">Estimasi Total Bayar:</span>
                        <span id="total_display" class="text-2xl font-black text-orange-600">Rp 0</span>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" 
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Konfirmasi & Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateTotal() {
    const selectBarang = document.getElementById('id_barang');
    const jumlahInput = document.getElementById('jumlah');
    const totalDisplay = document.getElementById('total_display');
    const btnSimpan = document.querySelector('button[type="submit"]');

    const selectedOption = selectBarang.options[selectBarang.selectedIndex];
    
    // Ambil harga dan stok dari atribut data-
    const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
    const stokTersedia = parseInt(selectedOption.getAttribute('data-stok')) || 0;
    const jumlahBeli = parseInt(jumlahInput.value) || 0;

    // Hitung Total
    const total = harga * jumlahBeli;
    totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');

    // LOGIKA VALIDASI STOK
    if (jumlahBeli > stokTersedia) {
        // Jika melebihi stok
        jumlahInput.classList.add('border-red-500', 'ring-red-500/20');
        jumlahInput.classList.remove('border-slate-200');
        
        // Munculin notif kecil (optional) atau ganti teks total jadi peringatan
        totalDisplay.innerHTML = `<span class="text-sm text-red-500 font-bold">Stok tidak cukup! (Sisa: ${stokTersedia})</span>`;
        
        // Matikan tombol simpan
        btnSimpan.disabled = true;
        btnSimpan.classList.add('opacity-50', 'cursor-not-allowed');
        btnSimpan.innerText = 'Stok Kurang!';
    } else {
        // Jika stok aman
        jumlahInput.classList.remove('border-red-500', 'ring-red-500/20');
        jumlahInput.classList.add('border-slate-200');
        
        // Aktifkan tombol kembali
        btnSimpan.disabled = false;
        btnSimpan.classList.remove('opacity-50', 'cursor-not-allowed');
        btnSimpan.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Konfirmasi & Simpan Transaksi`;
    }
}
</script>

</body>
</html>