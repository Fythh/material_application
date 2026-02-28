<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Material Kita.</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        primary: '#f48c25',
                        amber: { 500: '#f59e0b', 600: '#d97706' },
                        dark: '#0f172a'
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background: #f8fafc;
            background-image: radial-gradient(at 0% 0%, rgba(244, 140, 37, 0.1) 0px, transparent 50%);
            min-height: 100vh;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #f48c25 0%, #f59e0b 100%);
        }
        .tab-active {
            color: #f48c25;
            border-bottom: 3px solid #f48c25;
        }
        /* Transisi halus buat ganti konten */
        #content-wrapper {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">

    <div class="w-full max-w-[1000px] grid grid-cols-1 lg:grid-cols-2 bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-slate-100">
        
        <div class="hidden lg:flex bg-dark relative p-16 flex-col justify-between">
            <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-12">
                    <div class="bg-primary p-2 rounded-xl text-white">
                        <i data-lucide="construction" class="w-8 h-8"></i>
                    </div>
                    <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter">Material <span class="text-primary">Masa Kini</span></h1>
                </div>
                
                <div id="hero-content">
                    <h2 id="hero-text" class="text-5xl font-extrabold text-white leading-tight italic uppercase">
                        Build Your <br><span class="text-primary">Dreams</span> With Us.
                    </h2>
                    <p id="hero-sub" class="text-slate-400 mt-6 text-lg font-medium tracking-wide">Platform belanja material bangunan terlengkap dan terpercaya.</p>
                </div>
            </div>

            <div class="relative z-10 text-slate-500 text-sm font-bold uppercase tracking-widest">
                Professional Grade &bull; v3.0
            </div>
        </div>

        <div class="p-8 md:p-12 lg:p-16 flex flex-col">
            
            <div class="flex border-b border-slate-100 mb-10">
                <button type="button" onclick="switchRole('pengguna')" id="tab-user" class="flex-1 py-4 text-sm font-black uppercase tracking-widest transition-all tab-active">
                    <i data-lucide="shopping-bag" class="w-4 h-4 inline mr-2"></i> Akun Mitra
                </button>
                <button type="button" onclick="switchRole('admin')" id="tab-admin" class="flex-1 py-4 text-sm font-black uppercase tracking-widest text-slate-400 transition-all">
                    <i data-lucide="shield-check" class="w-4 h-4 inline mr-2"></i> Akun Seller
                </button>
            </div>

            <div class="mb-8" id="title-wrapper">
                <h3 id="form-title" class="text-3xl font-black text-slate-800 italic uppercase tracking-tight">Halo <span class="text-primary">Mitra!</span></h3>
                <p id="form-desc" class="text-slate-500 font-medium mt-1">Siap untuk melengkapi kebutuhan proyek Anda?</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 text-red-700 text-sm font-bold rounded-2xl flex items-center gap-3 border-l-4 border-red-500 animate-pulse">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('login/process') ?>" method="post" class="space-y-5">
                <input type="hidden" name="login_role" id="login_role" value="pengguna">

                <div class="space-y-2">
                    <div class="flex items-center gap-4 bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 focus-within:border-primary transition-all group">
                        <i data-lucide="user" class="text-slate-400 group-focus-within:text-primary transition-colors w-5 h-5"></i>
                        <input type="text" name="username" placeholder="Masukkan username" required 
                            class="bg-transparent w-full outline-none font-bold text-slate-700 placeholder:text-slate-300 placeholder:font-normal">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center gap-4 bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 focus-within:border-primary transition-all group">
                        <i data-lucide="lock" class="text-slate-400 group-focus-within:text-primary transition-colors w-5 h-5"></i>
                        <input type="password" name="password" placeholder="Password" required 
                            class="bg-transparent w-full outline-none font-bold text-slate-700 placeholder:text-slate-300">
                    </div>
                </div>

                <button type="submit" class="btn-gradient w-full py-5 rounded-2xl text-white font-black uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3 mt-4">
                    LOGIN SEKARANG
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>

            <div class="mt-auto pt-10 text-center">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                    &copy; 2026 Material Kita. &bull; Build with Heart.
                </p>
            </div>
        </div>

    </div>

    <script>
        // Inisialisasi Icon Lucide
        lucide.createIcons();

        function switchRole(role) {
            const tabUser = document.getElementById('tab-user');
            const tabAdmin = document.getElementById('tab-admin');
            const formTitle = document.getElementById('form-title');
            const formDesc = document.getElementById('form-desc');
            const heroText = document.getElementById('hero-text');
            const heroSub = document.getElementById('hero-sub');
            const hiddenInput = document.getElementById('login_role');
            
            // Set value hidden input untuk dikirim ke PHP
            hiddenInput.value = role;

            if (role === 'admin') {
                // Update Style Tab
                tabAdmin.classList.add('tab-active');
                tabAdmin.classList.remove('text-slate-400');
                tabUser.classList.remove('tab-active');
                tabUser.classList.add('text-slate-400');
                
                // Update Teks Form (Kanan)
                formTitle.innerHTML = 'Halo <span class="text-primary">Seller!</span>';
                formDesc.innerText = 'Silahkan masuk untuk mengelola stok & pesanan.';
                
                // Update Teks Branding (Kiri)
                heroText.innerHTML = 'Efficient <br><span class="text-primary">Management.</span>';
                heroSub.innerText = 'Kendalikan inventori gudang dalam satu dasbor cerdas.';
            } else {
                // Update Style Tab
                tabUser.classList.add('tab-active');
                tabUser.classList.remove('text-slate-400');
                tabAdmin.classList.remove('tab-active');
                tabAdmin.classList.add('text-slate-400');

                // Update Teks Form (Kanan)
                formTitle.innerHTML = 'Halo <span class="text-primary">Mitra!</span>';
                formDesc.innerText = 'Siap untuk melengkapi kebutuhan proyek Anda?';
                
                // Update Teks Branding (Kiri)
                heroText.innerHTML = 'Build Your <br><span class="text-primary">Dreams</span> With Us.';
                heroSub.innerText = 'Platform belanja material bangunan terlengkap dan terpercaya.';
            }
        }
    </script>
</body>
</html>