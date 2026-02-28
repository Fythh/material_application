<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Material Masa Kini.</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: { primary: '#f48c25', dark: '#0f172a' }
                }
            }
        }
    </script>

    <style>
        body { margin: 0; overflow: hidden; background: #0f172a; }
        #video-bg {
            position: fixed; right: 0; bottom: 0;
            min-width: 100%; min-height: 100%;
            z-index: -1; filter: brightness(0.4) contrast(1.2);
            object-fit: cover;
        }
        .main-card-glow {
            position: relative; padding: 3px; border-radius: 3.1rem;
            overflow: hidden; background: rgba(255, 255, 255, 0.1);
        }
        .main-card-glow::before {
            content: ''; position: absolute; top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: conic-gradient(transparent, transparent, transparent, #f48c25);
            animation: rotate-border 6s linear infinite;
        }
        @keyframes rotate-border { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .premium-card {
            position: relative; z-index: 1; background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
        }
        .btn-glow-container {
            position: relative; padding: 2px; border-radius: 1rem;
            overflow: hidden; display: inline-block; width: 100%;
        }
        .btn-glow-container::before {
            content: ''; position: absolute; top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: conic-gradient(transparent, transparent, transparent, #f48c25);
            animation: rotate-border 3s linear infinite;
        }
        .btn-inner {
            position: relative; z-index: 1; background: white;
            width: 100%; border-radius: 0.9rem; transition: all 0.3s;
            color: #f48c25; font-weight: 900;
        }
        .btn-inner:hover { background: #f48c25; color: white; }
        .typed-cursor { display: none !important; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <video autoplay muted loop playsinline id="video-bg">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-construction-site-of-a-new-building-44141-large.mp4" type="video/mp4">
    </video>

    <div class="main-card-glow w-full max-w-[1050px]">
        <div class="grid grid-cols-1 lg:grid-cols-2 premium-card rounded-[3rem] overflow-hidden">
            
            <div class="hidden lg:flex p-16 flex-col justify-between text-white bg-slate-900/95 relative">
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-20">
                        <div class="bg-primary p-3 rounded-2xl text-white rotate-3">
                            <i data-lucide="construction" class="w-8 h-8"></i>
                        </div>
                        <h1 class="text-2xl font-black italic uppercase tracking-tighter">Material <span class="text-primary">Masa Kini.</span></h1>
                    </div>
                    
                    <div class="min-h-[300px] flex flex-col justify-start">
                        <h2 class="text-5xl font-black leading-[1.1] italic uppercase tracking-tighter mb-8 min-h-[180px]">
                            <span id="typing-hero"></span>
                        </h2>
                        <p class="text-slate-400 text-lg font-medium max-w-xs">
                            Solusi material bangunan kualitas juara untuk proyek impian Anda.
                        </p>
                    </div>
                </div>
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-[0.5em]">SINCE 2026 &bull; PARTNER</div>
            </div>

            <div class="p-10 md:p-14 lg:p-16 flex flex-col bg-white">
                <div class="flex bg-slate-100 p-1 rounded-2xl mb-12 border border-slate-200">
                    <button onclick="switchRole('pengguna')" id="tab-user" class="flex-1 py-3 text-[10px] font-black uppercase tracking-widest bg-primary text-white rounded-xl shadow-md">Akun Mitra</button>
                    <button onclick="switchRole('admin')" id="tab-admin" class="flex-1 py-3 text-[10px] font-black uppercase tracking-widest text-slate-500">Akun Seller</button>
                </div>

                <div class="mb-10 min-h-[100px]">
                    <h3 class="text-4xl font-black italic uppercase tracking-tighter text-slate-900">
                        <span id="typing-title"></span>
                    </h3>
                    <p class="text-slate-500 font-bold mt-2">Silahkan masuk ke dashboard Anda.</p>
                </div>

                <form action="<?= base_url('login/process') ?>" method="post" class="space-y-5">
                    <input type="hidden" name="login_role" id="login_role" value="pengguna">
                    <input type="text" name="username" placeholder="Username" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 outline-none focus:border-primary font-bold text-slate-700">
                    <input type="password" name="password" placeholder="Password" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 outline-none focus:border-primary font-bold text-slate-700">
                    <div class="btn-glow-container mt-4">
                        <button type="submit" class="btn-inner py-5 text-xs font-black uppercase tracking-[0.3em]">Masuk Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        var typedHero = new Typed('#typing-hero', {
            strings: ['Build Your<br><span class="text-primary">Dreams</span><br>With Us.', 'Bangun<br><span class="text-primary">Proyek</span><br>Hebat.'],
            typeSpeed: 50, backSpeed: 30, loop: true, showCursor: false
        });
        var typedTitle = new Typed('#typing-title', {
            strings: ['Halo <span class="text-primary">Mitra!</span>', 'Selamat <span class="text-primary">Datang!</span>'],
            typeSpeed: 60, backSpeed: 40, loop: true, showCursor: false
        });
        function switchRole(role) {
            const tu = document.getElementById('tab-user'); const ta = document.getElementById('tab-admin');
            document.getElementById('login_role').value = role;
            if(role === 'admin') {
                ta.className = "flex-1 py-3 text-[10px] font-black uppercase tracking-widest transition-all bg-primary text-white rounded-xl shadow-md";
                tu.className = "flex-1 py-3 text-[10px] font-black uppercase tracking-widest text-slate-500 transition-all";
                typedTitle.strings = ['Halo <span class="text-primary">Seller!</span>', 'Kelola <span class="text-primary">Stok!</span>'];
            } else {
                tu.className = "flex-1 py-3 text-[10px] font-black uppercase tracking-widest transition-all bg-primary text-white rounded-xl shadow-md";
                ta.className = "flex-1 py-3 text-[10px] font-black uppercase tracking-widest text-slate-500 transition-all";
                typedTitle.strings = ['Halo <span class="text-primary">Mitra!</span>', 'Selamat <span class="text-primary">Datang!</span>'];
            }
            typedTitle.reset();
        }
    </script>
</body>
</html>