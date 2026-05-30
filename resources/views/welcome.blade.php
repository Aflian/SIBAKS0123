<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakso Ayam 234</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Font Awesome 6 (Ikon) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Efek bayangan lembut dan transisi */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- HERO SECTION --}}
    <section class="relative bg-gradient-to-br from-red-600 via-red-500 to-orange-500 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-15">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-yellow-300 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 py-16 md:py-24 z-10 flex flex-col md:flex-row items-center gap-10">
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight drop-shadow-lg">
                    Bakso <span class="text-yellow-300">Ayam 234</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 font-light max-w-3xl opacity-95">
                    <i class="fas fa-check-circle mr-2 text-yellow-300"></i>
                    Produksi Bakso Ayam siap makan dan Frozen
                </p>
                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                    <a href="/karyawan/login"
                       class="bg-white text-red-600 font-semibold px-10 py-4 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 hover:bg-gray-100 flex items-center gap-2 text-lg">
                        <i class="fas fa-sign-in-alt"></i> Masuk Sistem
                    </a>
                    <a href="#produk"
                       class="bg-transparent border-2 border-white text-white font-semibold px-10 py-4 rounded-full hover:bg-white hover:text-red-600 transition-all duration-300 flex items-center gap-2 text-lg">
                        <i class="fas fa-utensils"></i> Lihat Produk
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{asset('hero.jpeg')}}"
                     alt="Bakso Ayam"
                     class="w-100 h-64 md:w-100 md:h-72 object-cover rounded-3xl shadow-2xl border-4 border-white/30">
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white" fill-opacity="1"></path>
            </svg>
        </div>
    </section>

    {{-- DESKRIPSI TOKO --}}
    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <span class="text-red-500 font-semibold tracking-wider text-sm uppercase">Tentang Kami</span>
            <h2 class="text-4xl font-bold mb-6 text-gray-800">Kualitas adalah <span class="text-red-600">Prioritas Utama</span></h2>
            <p class="text-gray-600 leading-relaxed text-lg max-w-3xl mx-auto">
                Bakso Ayan 234 adalah usaha produksi bakso yang berfokus pada kualitas bahan baku,
                kebersihan proses produksi, dan pelayanan terbaik kepada pelanggan.
                Kami memproduksi bakso dengan sistem pemesanan yang terkontrol
                untuk menjaga konsistensi dan kualitas bakso.
            </p>
            <div class="mt-10">
                <img src="{{asset('produk2.jpg')}}"
                     alt="Proses Produksi Bakso"
                     class="w-full max-w-3xl mx-auto rounded-2xl shadow-xl object-cover h-64 md:h-80">
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 text-center">
                <div class="p-4">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-red-600 text-3xl mb-3"><i class="fas fa-drumstick-bite"></i></div>
                    <h4 class="font-bold text-xl">Daging Ayam</h4>
                    <p class="text-gray-500 text-sm">Kualitas terbaik</p>
                </div>
                <div class="p-4">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-red-600 text-3xl mb-3"><i class="fas fa-leaf"></i></div>
                    <h4 class="font-bold text-xl">Bahan Alami</h4>
                    <p class="text-gray-500 text-sm">Tanpa pengawet</p>
                </div>
                <div class="p-4">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-red-600 text-3xl mb-3"><i class="fas fa-snowflake"></i></div>
                    <h4 class="font-bold text-xl">Frozen Fresh</h4>
                    <p class="text-gray-500 text-sm">Tahan lama</p>
                </div>
                <div class="p-4">
                    <div class="bg-red-100 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-red-600 text-3xl mb-3"><i class="fas fa-truck"></i></div>
                    <h4 class="font-bold text-xl">COD</h4>
                    <p class="text-gray-500 text-sm">Daerah sekitar</p>
                </div>

            </div>
        </div>
    </section>

    {{-- PRODUK UNGGULAN --}}
    <section id="produk" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-red-500 font-semibold tracking-wider text-sm uppercase">Varian Produk</span>
                <h2 class="text-4xl font-bold text-gray-800">Pilihan <span class="text-red-600">Bakso</span> Kami</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card Produk 1 -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden card-hover">
                    <img src="{{asset('produk1.jpg')}}"
                         alt="Bakso Ayam 200 gram"
                         class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-2xl mb-2">Bakso Ayam 200 gram</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-red-600 font-bold text-xl">Rp 8.000.00</span>
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </div>
                <!-- Card Produk 2 -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden card-hover">
                    <img src="{{asset('produk3.jpg')}}"
                         alt="Bakso Ayam 500 gram"
                         class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-2xl mb-2">Bakso ayam 500 gram</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-red-600 font-bold text-xl">Rp 20.000.00</span>
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </div>
                <!-- Card Produk 3 -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden card-hover">
                    <img src="{{asset('produk1.jpg')}}"
                         alt="Bakso Ayam 1 kg"
                         class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-2xl mb-2">Bakso Ayam 1 kg</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-red-600 font-bold text-xl">Rp 40.000.00</span>
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </div>
                 <!-- Card Produk 4 -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden card-hover">
                    <img src="{{asset('produk3.jpg')}}"
                         alt="Bakso Ayam 2 kg"
                         class="h-48 w-full object-cover">
                    <div class="p-6">
                        <h3 class="font-bold text-2xl mb-2">Bakso Ayam 2 kg</h3>
                        <div class="flex items-center justify-between">
                            <span class="text-red-600 font-bold text-xl">Rp 80.000.00</span>
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- OWNER --}}
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-3xl shadow-xl p-10 md:p-14 border border-red-100 relative overflow-hidden">
                <!-- Lingkaran hias -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-red-200 rounded-full opacity-50 blur-2xl"></div>
                <div class="relative z-10 text-center md:text-left md:flex items-center gap-10">
                    <div class="flex justify-center md:block mb-6 md:mb-0">
                        <div class="w-36 h-36 rounded-full bg-gradient-to-tr from-red-500 to-orange-400 flex items-center justify-center text-white text-6xl shadow-2xl border-4 border-white">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-red-600 mb-2">Owner</h2>
                        <p class="text-3xl font-bold text-gray-800 mb-3">Ibu Sukini</p>
                        <p class="text-gray-600 leading-relaxed max-w-xl">
                            Berpengalaman lebih dari 5 tahun dalam industri produksi bakso dan pengolahan daging berkualitas. Beliau aktif mengawasi langsung proses produksi untuk menjaga cita rasa yang konsisten.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <span class="text-red-500 font-semibold tracking-wider text-sm uppercase">Testimoni</span>
            <h2 class="text-4xl font-bold mb-16 text-gray-800">Apa Kata <span class="text-red-600">Pelanggan</span></h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testi 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-lg card-hover border border-gray-100">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-500 text-2xl"><i class="fas fa-user-circle"></i></div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"Baksonya enak dan konsisten, selalu fresh! Saya sudah langganan tiap minggu."</p>
                    <p class="mt-2 font-semibold text-red-600">- Ibu Rina</p>
                    <p class="text-yellow-400 text-sm">★★★★★</p>
                </div>
                <!-- Testi 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-lg card-hover border border-gray-100">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-500 text-2xl"><i class="fas fa-user-circle"></i></div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"Pelayanan cepat dan kualitas terjamin. Saya beli untuk kebutuhan dapur."</p>
                    <p class="mt-2 font-semibold text-red-600">- Ibu Sri</p>
                    <p class="text-yellow-400 text-sm">★★★★★</p>
                </div>
                <!-- Testi 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-lg card-hover border border-gray-100">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-500 text-2xl"><i class="fas fa-user-circle"></i></div>
                    </div>
                    <p class="text-gray-600 italic mb-4">"Bakso frozen sangat membantu usaha saya. Praktis dan rasanya tidak berubah."</p>
                    <p class="mt-2 font-semibold text-red-600">- Ibu Aurel</p>
                    <p class="text-yellow-400 text-sm">★★★★★</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTACT & ALAMAT --}}
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-gray-50 rounded-3xl shadow-lg p-10 md:p-14 grid md:grid-cols-2 gap-10 border border-gray-200">
                <div>
                    <h3 class="text-2xl font-bold text-red-600 mb-6 flex items-center gap-2"><i class="fas fa-headset"></i> Kontak Kami</h3>
                    <div class="space-y-4 text-gray-700">
                        <p class="flex items-center gap-3"><i class="fas fa-phone-alt w-6 text-red-500"></i> 0813-7236-0154 (WhatsApp)</p>
                        <p class="flex items-center gap-3"><i class="fas fa-envelope w-6 text-red-500"></i> baksoayam234@gmail.com</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-red-600 mb-6 flex items-center gap-2"><i class="fas fa-map-marker-alt"></i> Alamat</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Jl. Lintas Bangkinang-Petapahan<br>
                        Kecamatan Bangkinang<br>
                        Kabupaten Kampar, Riau 28463
                    </p>
                    <a href="https://maps.app.goo.gl/ikRyW8NnBLytRYGJ9" target="_blank" class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 transition">
                        <i class="fas fa-map-marked-alt"></i> Lihat di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="font-bold text-2xl text-white mb-3">Bakso Ayam 234</p>
            <p class="text-sm opacity-80 mb-6">Sistem Informasi Produksi • © {{ date('Y') }} All rights reserved</p>
            <div class="flex justify-center gap-6 text-2xl mb-6">
                <a href="#" class="hover:text-red-400 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-red-400 transition"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-red-400 transition"><i class="fab fa-whatsapp"></i></a>
            </div>
            <p class="text-xs opacity-60">Dibuat dengan <i class="fas fa-heart text-red-500"></i> untuk pelanggan setia</p>
        </div>
    </footer>

</body>
</html>
