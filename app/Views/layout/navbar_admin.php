<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-darkCard/80 glass-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            
            <div class="flex items-center gap-8">
                <a href="<?= base_url('/dashboard') ?>" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                        <i data-lucide="hard-hat" class="w-6 h-6"></i>
                    </div>
                    <h1 class="text-xl font-extrabold tracking-tighter uppercase text-slate-900 dark:text-white">Material <span class="text-primary">MASA KINI</span></h1>
                </a>

                <nav class="hidden md:flex items-center gap-2">
                    <a href="<?= base_url('/dashboard') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'dashboard') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="layout-grid" class="w-4 h-4"></i> Dashboard
                    </a>
                    
                    <a href="<?= base_url('/barang') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'barang') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="package" class="w-4 h-4"></i> Barang
                    </a>

                    <a href="<?= base_url('/kategori') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'kategori') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="tags" class="w-4 h-4"></i> Kategori
                    </a>

                    <a href="<?= base_url('/pelanggan') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'pelanggan') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="users" class="w-4 h-4"></i> Pelanggan
                    </a>

                    <a href="<?= base_url('/penjualan') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'penjualan') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="shopping-cart" class="w-4 h-4"></i> Penjualan
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative" id="adminDropdown">
                    <button id="adminBtn" class="flex items-center gap-3 p-1.5 pr-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-black uppercase">
                            <?= substr(session()->get('nama') ?? 'A', 0, 1) ?>
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1"><?= session()->get('role') == 'admin' ? 'Administrator' : 'Operator' ?></p>
                            <p class="text-xs font-black text-slate-700 dark:text-slate-200 leading-none"><?= session()->get('nama') ?? 'Admin' ?></p>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-primary transition-colors"></i>
                    </button>

                    <div id="adminContent" class="hidden absolute right-0 mt-3 w-52 origin-top-right bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-[2rem] shadow-2xl z-[100] overflow-hidden p-2">
                        <button onclick="showAdminInfo()" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-2xl transition-all text-left">
                            <i data-lucide="shield-check" class="w-5 h-5 text-blue-500"></i> Info Admin
                        </button>
                        
                        <button onclick="toggleDarkMode()" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-2xl transition-all text-left">
                            <i data-lucide="moon" class="w-5 h-5 text-primary"></i> Ganti Tema
                        </button>
                        
                        <div class="h-[1px] bg-slate-100 dark:bg-slate-800 my-2 mx-4"></div>
                        
                        <button onclick="logoutConfirm()" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-black text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-2xl transition-all text-left">
                            <i data-lucide="log-out" class="w-5 h-5"></i> Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Initialize Lucide
    if (typeof lucide !== 'undefined') { lucide.createIcons(); }

    // Dropdown Admin Logic
    const adminBtn = document.getElementById('adminBtn');
    const adminContent = document.getElementById('adminContent');

    if (adminBtn && adminContent) {
        adminBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            adminContent.classList.toggle('hidden');
        });
        window.addEventListener('click', () => adminContent.classList.add('hidden'));
        adminContent.addEventListener('click', (e) => e.stopPropagation());
    }

    // Toggle Dark Mode
    function toggleDarkMode() {
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        if (typeof lucide !== 'undefined') { lucide.createIcons(); }
    }

    // Info Admin Popup (Polesan Baru)
    function showAdminInfo() {
        Swal.fire({
            title: '<span class="text-xs font-black text-primary uppercase tracking-widest">Akses Kendali Utama</span>',
            html: `
                <div class="mt-4 p-6 bg-slate-50 dark:bg-slate-800/50 rounded-[2rem] border border-slate-100 dark:border-slate-700 text-left">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-dark dark:bg-primary text-white flex items-center justify-center text-xl font-black uppercase">
                            <?= substr(session()->get('nama') ?? 'A', 0, 1) ?>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Nama Petugas</p>
                            <p class="text-lg font-black text-slate-800 dark:text-white uppercase"><?= session()->get('nama') ?? 'Admin' ?></p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="p-3 bg-white dark:bg-darkCard rounded-xl border border-slate-100 dark:border-slate-700 flex justify-between items-center">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Username</span>
                            <span class="font-bold text-slate-700 dark:text-slate-200">@<?= session()->get('username') ?></span>
                        </div>
                        <div class="p-3 bg-white dark:bg-darkCard rounded-xl border border-slate-100 dark:border-slate-700 flex justify-between items-center">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Privilege</span>
                            <span class="px-2 py-0.5 bg-blue-100 text-blue-600 dark:bg-blue-500/20 dark:text-blue-400 rounded-lg text-[10px] font-black uppercase tracking-tighter">
                                <?= session()->get('role') ?? 'Staff' ?>
                            </span>
                        </div>
                    </div>
                </div>
            `,
            confirmButtonText: 'LANJUTKAN KERJA',
            confirmButtonColor: '#f48c25',
            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
            customClass: { popup: 'rounded-[3rem]', confirmButton: 'rounded-2xl px-10 font-black text-xs uppercase tracking-widest' }
        });
    }

    // Logout Logic
    function logoutConfirm() {
        Swal.fire({
            title: 'AKHIRI SESI?',
            text: "Pastikan semua laporan sudah disimpan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'YA, LOGOUT',
            cancelButtonText: 'BATAL',
            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
            customClass: { popup: 'rounded-[2.5rem]', confirmButton: 'rounded-xl', cancelButton: 'rounded-xl' }
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = "<?= base_url('/logout') ?>"; }
        });
    }

    // Pre-load theme
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }
</script>