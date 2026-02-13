<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>MaterialKita - Solusi Konstruksi Anda</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f48c25",
                        "background-light": "#f8f7f5",
                        "background-dark": "#221910",
                    },
                    fontFamily: {
                        "display": ["Public Sans"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<style>
        body { font-family: 'Public Sans', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-background-light dark:bg-background-dark text-[#1c140d]">
<!-- Header -->
<header class="sticky top-0 z-50 flex items-center bg-white/90 backdrop-blur-md px-4 py-3 justify-between border-b border-primary/10">
<div class="flex items-center gap-2">
<div class="bg-primary p-1.5 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-white">construction</span>
</div>
<h2 class="text-[#1c140d] text-xl font-bold tracking-tight">MaterialKita</h2>
</div>
<div class="flex items-center gap-3">
<button class="text-[#1c140d] p-2 hover:bg-primary/10 rounded-full transition-colors">
<span class="material-symbols-outlined">search</span>
</button>
<button class="text-[#1c140d] p-2 hover:bg-primary/10 rounded-full transition-colors relative">
<span class="material-symbols-outlined">shopping_cart</span>
<span class="absolute top-1 right-1 bg-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">2</span>
</button>
</div>
</header>
<main class="pb-24">
<!-- Hero Section -->
<section class="@container">
<div class="@[480px]:px-4 @[480px]:py-4">
<div class="relative bg-cover bg-center flex flex-col justify-end overflow-hidden rounded-none @[480px]:rounded-xl min-h-[420px]" data-alt="High quality construction materials stacked neatly in warehouse" style='background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.2) 50%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuB2H7ZhSjounpzOKMtlbIoeXj_tn1ClN2ljGFNq9bhF9TUzqdR_szdXy5uTyWoHKvDMKx04PN9CuI7-jtgcFzEgDY0qtI6YMEDTY7jC61rFPOl6IVA3dYd2ex1DQKNyKYzK1O3LtxvIi6HcmSeD5juUhkiszk5wgNh-zRAHwhPVRg0Nx9HMDAz8dZuIPusGG2BU8ibNx3AfEb3dfFBGomopcnbS_4N5M-yq1FyAxoopL1MBohvfJGSZyNrUl82UTUOb_m0C71z0dDI");'>
<div class="p-6 space-y-4">
<h1 class="text-white text-3xl font-bold leading-tight">Bangun Impian Anda dengan Material Berkualitas</h1>
<p class="text-white/80 text-sm max-w-[280px]">Penyedia bahan bangunan terlengkap dan terpercaya untuk proyek skala besar maupun renovasi rumah.</p>
<button class="flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary text-white text-base font-bold shadow-lg shadow-primary/30 active:scale-95 transition-transform w-fit">
<span>Lihat Produk</span>
<span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- Categories -->
<section class="px-4 py-8">
<div class="flex justify-between items-center mb-6">
<h3 class="text-[#1c140d] text-lg font-bold">Kategori Pilihan</h3>
<a class="text-primary text-sm font-semibold" href="#">Lihat Semua</a>
</div>
<div class="grid grid-cols-4 gap-3">
<div class="flex flex-col items-center gap-2">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary border border-primary/20">
<span class="material-symbols-outlined text-3xl">home_repair_service</span>
</div>
<span class="text-xs font-semibold text-center">Semen</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary border border-primary/20">
<span class="material-symbols-outlined text-3xl">grid_view</span>
</div>
<span class="text-xs font-semibold text-center">Besi Baja</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary border border-primary/20">
<span class="material-symbols-outlined text-3xl">forest</span>
</div>
<span class="text-xs font-semibold text-center">Kayu</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary border border-primary/20">
<span class="material-symbols-outlined text-3xl">rebase_edit</span>
</div>
<span class="text-xs font-semibold text-center">Batu Bata</span>
</div>
</div>
</section>
<!-- Why Choose Us -->
<section class="bg-white px-4 py-8 border-y border-primary/5">
<h3 class="text-[#1c140d] text-lg font-bold mb-6">Mengapa MaterialKita?</h3>
<div class="space-y-4">
<div class="flex items-start gap-4 p-4 rounded-xl bg-background-light border border-primary/10">
<div class="p-2 bg-primary rounded-lg text-white">
<span class="material-symbols-outlined">verified</span>
</div>
<div>
<h4 class="font-bold text-sm">Kualitas Terjamin</h4>
<p class="text-xs text-slate-500 mt-1">Hanya menyediakan produk berstandar SNI untuk keamanan bangunan Anda.</p>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-background-light border border-primary/10">
<div class="p-2 bg-primary rounded-lg text-white">
<span class="material-symbols-outlined">local_shipping</span>
</div>
<div>
<h4 class="font-bold text-sm">Pengiriman Cepat</h4>
<p class="text-xs text-slate-500 mt-1">Armada sendiri siap mengantar pesanan Anda dalam 24 jam ke lokasi proyek.</p>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-background-light border border-primary/10">
<div class="p-2 bg-primary rounded-lg text-white">
<span class="material-symbols-outlined">payments</span>
</div>
<div>
<h4 class="font-bold text-sm">Harga Kompetitif</h4>
<p class="text-xs text-slate-500 mt-1">Dapatkan harga terbaik langsung dari pabrik dan diskon volume.</p>
</div>
</div>
</div>
</section>
<!-- Gallery/Recent Projects -->
<section class="px-4 py-8">
<div class="flex justify-between items-center mb-6">
<h3 class="text-[#1c140d] text-lg font-bold">Proyek Terbaru</h3>
<span class="material-symbols-outlined text-slate-400">arrow_forward</span>
</div>
<div class="flex gap-4 overflow-x-auto pb-4 snap-x no-scrollbar">
<div class="min-w-[280px] snap-center">
<div class="h-44 rounded-xl overflow-hidden mb-3">
<img class="w-full h-full object-cover" data-alt="Modern office building architecture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXF7koDUYATTgt6qjHrqQVIA1197M1qa8f2BkwoOwPy3f66m_p5BufIo_-Z37CJ3em43v0rX8odlJV6raykY9J6ZEXSgS9WV73x0PW3b8yS4mAtMlpIW7kYwWa_6S4IOKE5OLNcqAJa14segBGA3SJPa5ej-XSVXh2ndCBUKvmzYOSrP_Wr1fysiShpxGWq7CWVutshG8yO8pyUK2RnShRt33WoHEaXCXf0u8Mn5f1hiIu8x-XUOQjUBCTLaTD2a2cyYCtSUr7JOI"/>
</div>
<h4 class="font-bold text-sm">Gedung Perkantoran Sudirman</h4>
<p class="text-xs text-slate-500">Suplai Besi &amp; Semen</p>
</div>
<div class="min-w-[280px] snap-center">
<div class="h-44 rounded-xl overflow-hidden mb-3">
<img class="w-full h-full object-cover" data-alt="Modern luxury house under construction" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAn9M88VzOxWb-5YNEHvr0w97XajDjR83eJ2KcUYvSkay7TMGXJumOY7DY1rW-gkDuaKQd2oRBdtfdkmDMn0yr6-LIzrXEOIz6TwtK-hweon9yxSlsgPkNn6qhO8AmUJOqbUn83x2M6qKBaigpCVGD7kQKGuGQ7cXdkgsFy7-LtXBEUBc4eUxBmg1NBJHa9hOihDHNJdeRq8Mtl9y3PkU1Q6-fZa5cRZ4ymqktLzhIkdEEzWJnSXW3yrA9O7Acr1HK-UUz5QFKMVU"/>
</div>
<h4 class="font-bold text-sm">Cluster Harmoni Sentul</h4>
<p class="text-xs text-slate-500">Suplai Batu Bata &amp; Kayu</p>
</div>
</div>
</section>
<!-- Footer -->
<footer class="bg-[#1c140d] text-white px-6 py-10 mt-4 rounded-t-3xl">
<div class="flex items-center gap-2 mb-6">
<div class="bg-primary p-1.5 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-white">construction</span>
</div>
<h2 class="text-white text-xl font-bold tracking-tight">MaterialKita</h2>
</div>
<p class="text-white/60 text-sm leading-relaxed mb-8">
                Mitra terpercaya untuk seluruh kebutuhan material bangunan Anda. Berkualitas, Cepat, dan Terjangkau.
            </p>
<div class="space-y-4 mb-8">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">call</span>
<span class="text-sm">(021) 888-9999</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">mail</span>
<span class="text-sm">halo@materialkita.com</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary">location_on</span>
<span class="text-sm">Jl. Industri No. 123, Jakarta</span>
</div>
</div>
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
<span class="material-symbols-outlined text-sm">share</span>
</div>
<div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
<span class="material-symbols-outlined text-sm">person</span>
</div>
<div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
<span class="material-symbols-outlined text-sm">group</span>
</div>
</div>
<p class="text-white/30 text-xs mt-10 border-t border-white/10 pt-6 text-center">
                © 2025 MaterialKita. All rights reserved.
            </p>
</footer>
</main>
<!-- Bottom Navigation Bar -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-primary/10 px-4 pb-4 pt-2 flex justify-between items-center z-50">
<a class="flex flex-col items-center gap-1 text-primary" href="#">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">home</span>
<span class="text-[10px] font-bold">Beranda</span>
</a>
<a class="flex flex-col items-center gap-1 text-slate-400" href="#">
<span class="material-symbols-outlined">inventory_2</span>
<span class="text-[10px] font-medium">Produk</span>
</a>
<a class="flex flex-col items-center gap-1 text-slate-400" href="#">
<span class="material-symbols-outlined">receipt_long</span>
<span class="text-[10px] font-medium">Pesanan</span>
</a>
<a class="flex flex-col items-center gap-1 text-slate-400" href="#">
<span class="material-symbols-outlined">person</span>
<span class="text-[10px] font-medium">Profil</span>
</a>
</nav>
</body></html>