<style>
    /* Animasi Goyang Kenyal */
    @keyframes cart-bounce {
        0%, 100% { transform: scale(1); }
        25% { transform: scale(1.3) rotate(-15deg); }
        50% { transform: scale(1.3) rotate(15deg); }
        75% { transform: scale(1.3) rotate(-10deg); }
    }
    .cart-animate { 
        animation: cart-bounce 0.6s cubic-bezier(0.34, 1.56, 0.64, 1); 
    }
    .glass-nav { 
        backdrop-filter: blur(12px); 
        -webkit-backdrop-filter: blur(12px); 
    }
</style>

<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-darkCard/80 glass-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            
            <div class="flex items-center gap-8">
                <a href="<?= base_url('/user/dashboard') ?>" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                        <i data-lucide="hard-hat" class="w-6 h-6"></i>
                    </div>
                    <h1 class="text-xl font-extrabold tracking-tighter uppercase text-slate-900 dark:text-white">
                        Material <span class="text-primary">Masa Kini</span>
                    </h1>
                </a>

                <nav class="hidden md:flex items-center gap-2">
                    <a href="<?= base_url('/user/dashboard') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'user/dashboard') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="home" class="w-4 h-4"></i> Home
                    </a>
                    <a href="<?= base_url('/user/produk') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'user/produk') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="package" class="w-4 h-4"></i> Produk
                    </a>
                    <a href="<?= base_url('/user/pesanan') ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-bold <?= (uri_string() == 'user/pesanan') ? 'text-primary bg-orange-50 dark:bg-orange-500/10' : 'text-slate-500 hover:text-primary' ?> rounded-xl transition-all">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i> Pesanan Saya
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <a href="<?= base_url('/user/cart') ?>" id="cartIcon" class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-500 hover:text-primary border border-slate-200 dark:border-slate-700 transition-all relative">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    <?php 
                        $cart = session()->get('cart') ?? [];
                        $cartCount = count($cart); 
                    ?>
                    <span id="cartBadge" class="<?= ($cartCount > 0) ? '' : 'hidden' ?> absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white border-2 border-white dark:border-darkCard">
                        <?= $cartCount ?>
                    </span>
                </a>

                <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700 mx-1"></div>

                <div class="relative" id="userDropdown">
                    <button id="userBtn" class="flex items-center gap-3 p-1.5 pr-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-primary transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-black uppercase">
                            <?= substr(session()->get('username') ?? 'U', 0, 1) ?>
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-[10px] font-bold text-slate-400 uppercase leading-none mb-1">Mitra</p>
                            <p class="text-xs font-black text-slate-700 dark:text-slate-200 leading-none"><?= session()->get('username') ?? 'User' ?></p>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-primary transition-colors"></i>
                    </button>

                    <div id="userContent" class="hidden absolute right-0 mt-3 w-56 origin-top-right bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 rounded-[2rem] shadow-2xl z-[100] overflow-hidden p-2">
                        <button onclick="showAccountInfo()" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-2xl transition-all text-left">
                            <i data-lucide="user" class="w-5 h-5 text-blue-500"></i> Akun Saya
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
    // 1. GLOBAL ANIMATION FUNCTION
    window.animateCart = function(newCount) {
        const cartIcon = document.getElementById('cartIcon');
        const badge = document.getElementById('cartBadge');
        
        if(badge) {
            badge.innerText = newCount;
            badge.classList.remove('hidden');
        }
        
        cartIcon.classList.add('cart-animate', 'text-primary', 'border-primary');
        setTimeout(() => {
            cartIcon.classList.remove('cart-animate');
        }, 600);
    }

    // 2. INITIALIZE LOGIC
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') { lucide.createIcons(); }

        // Dropdown Toggle
        const userBtn = document.getElementById('userBtn');
        const userContent = document.getElementById('userContent');
        if (userBtn && userContent) {
            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userContent.classList.toggle('hidden');
            });
            window.addEventListener('click', () => userContent.classList.add('hidden'));
            userContent.addEventListener('click', (e) => e.stopPropagation());
        }

        // Check Flashdata for Refresh Sync
        <?php if (session()->getFlashdata('cart_added')): ?>
            window.animateCart(<?= count(session()->get('cart') ?? []) ?>);
        <?php endif; ?>
    });

    // 3. ACCOUNT INFO POPUP
    function showAccountInfo() {
        Swal.fire({
            title: '<span class="text-xs font-black text-primary uppercase tracking-widest">Detail Mitra</span>',
            html: `
                <div class="mt-4 p-6 bg-slate-50 dark:bg-slate-800/50 rounded-[2rem] border border-slate-100 dark:border-slate-700 text-left">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-primary text-white flex items-center justify-center text-xl font-black uppercase">
                            <?= substr(session()->get('username') ?? 'U', 0, 1) ?>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Username</p>
                            <p class="text-lg font-black text-slate-800 dark:text-white italic lowercase">@<?= session()->get('username') ?></p>
                        </div>
                    </div>
                    <div class="p-3 bg-white dark:bg-darkCard rounded-xl border border-slate-100 dark:border-slate-700">
                        <span class="text-[9px] font-bold text-slate-400 uppercase block mb-1">Role Akun</span>
                        <span class="font-bold text-slate-700 dark:text-slate-200 capitalize"><?= session()->get('role') ?> Material</span>
                    </div>
                </div>
            `,
            showConfirmButton: true,
            confirmButtonText: 'TUTUP',
            confirmButtonColor: '#f48c25',
            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
            customClass: { popup: 'rounded-[3rem]', confirmButton: 'rounded-2xl px-10 font-black' }
        });
    }

    // 4. DARK MODE LOGIC
    function toggleDarkMode() {
        const html = document.documentElement;
        const isDark = html.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        if (typeof lucide !== 'undefined') { lucide.createIcons(); }
    }

    // 5. LOGOUT LOGIC
    function logoutConfirm() {
        Swal.fire({
            title: 'KELUAR SEKARANG?',
            text: "Pastikan pesanan Anda sudah aman.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'KELUAR',
            cancelButtonText: 'BATAL',
            background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
            color: document.documentElement.classList.contains('dark') ? '#f1f5f9' : '#1e293b',
            customClass: { popup: 'rounded-[2.5rem]', confirmButton: 'rounded-xl', cancelButton: 'rounded-xl' }
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = "<?= base_url('/logout') ?>"; }
        });
    }
</script>