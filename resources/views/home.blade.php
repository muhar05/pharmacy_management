<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Apotech - Sistem Manajemen Apotek Modern</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo/pharmacy_logo.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-indigo-50 to-white min-h-screen font-sans antialiased">

    <!-- Improved Header with better spacing and transitions -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="/assets/logo/pharmacy_logo.png" alt="Apotech Logo" class="h-10 w-auto">
                    <span class="text-2xl font-bold text-indigo-700">Apotech</span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        @php $user = Auth::user(); @endphp
                        @if ($user && $user->position === 'admin')
                            <a href="{{ url('/dashboard') }}"
                                class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors duration-200">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-lg border border-indigo-600 text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Enhanced Hero Section -->
    <section class="relative overflow-hidden bg-white py-20 sm:py-32">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-center">
                <div class="max-w-2xl">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                        data-aos="fade-right"
                        data-aos-duration="1000">
                        Kelola Apotek Anda Lebih Mudah dan Efisien
                    </h1>
                    <p class="mt-6 text-lg text-gray-600"
                        data-aos="fade-left"
                        data-aos-duration="1000"
                        data-aos-delay="200">
                        Platform manajemen apotek modern yang membantu Anda mengatur stok obat, resep, dan layanan
                        pelanggan dengan lebih efisien. Tingkatkan produktivitas apotek Anda hari ini.
                    </p>
                    <div class="mt-10 flex items-center gap-x-6"
                        data-aos="fade-up"
                        data-aos-duration="1000"
                        data-aos-delay="400">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-6 py-3 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors duration-200 shadow-lg hover:shadow-xl"
                            data-aos="zoom-in"
                            data-aos-duration="900"
                            data-aos-delay="600">
                            <span>Mulai Sekarang</span>
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#features"
                            class="text-indigo-600 hover:text-indigo-700 font-semibold inline-flex items-center"
                            data-aos="zoom-in"
                            data-aos-duration="900"
                            data-aos-delay="700">
                            Pelajari Lebih Lanjut
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-16 sm:mt-24 lg:mt-0">
                    <img src="{{ asset('assets/image/undraw_medicine.png') }}" alt="Ilustrasi Apotek"
                        class="w-full rounded-xl"
                        data-aos="fade-up"
                        data-aos-duration="1200"
                        data-aos-delay="200"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- Improved Features Section with Cards -->
    <section id="features" class="bg-gray-50 py-20 sm:py-32">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                    data-aos="fade-down"
                    data-aos-duration="1000">
                    Fitur Lengkap untuk Apotek Modern
                </h2>
                <p class="mt-4 text-lg text-gray-600"
                    data-aos="fade-up"
                    data-aos-duration="1000"
                    data-aos-delay="200">
                    Solusi komprehensif untuk mengoptimalkan pengelolaan apotek Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300"
                    data-aos="zoom-in"
                    data-aos-duration="900">
                    <div class="bg-indigo-100 rounded-lg p-3 w-12 h-12 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3"
                        data-aos="fade-right"
                        data-aos-duration="800"
                        data-aos-delay="100">
                        Manajemen Stok
                    </h3>
                    <p class="text-gray-600"
                        data-aos="fade-left"
                        data-aos-duration="800"
                        data-aos-delay="200">
                        Kelola inventaris obat dengan mudah, pantau stok secara real-time, dan dapatkan notifikasi untuk restock.
                    </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300"
                    data-aos="zoom-in"
                    data-aos-duration="900"
                    data-aos-delay="150">
                    <div class="bg-indigo-100 rounded-lg p-3 w-12 h-12 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3"
                        data-aos="fade-right"
                        data-aos-duration="800"
                        data-aos-delay="250">
                        Manajemen Resep
                    </h3>
                    <p class="text-gray-600"
                        data-aos="fade-left"
                        data-aos-duration="800"
                        data-aos-delay="300">
                        Catat, kelola, dan proses resep dokter secara digital untuk efisiensi dan akurasi yang lebih baik.
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300"
                    data-aos="zoom-in"
                    data-aos-duration="900"
                    data-aos-delay="300">
                    <div class="bg-indigo-100 rounded-lg p-3 w-12 h-12 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m0-4a4 4 0 118 0 4 4 0 01-8 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3"
                        data-aos="fade-right"
                        data-aos-duration="800"
                        data-aos-delay="400">
                        Layanan Pelanggan
                    </h3>
                    <p class="text-gray-600"
                        data-aos="fade-left"
                        data-aos-duration="800"
                        data-aos-delay="450">
                        Tingkatkan kepuasan pelanggan dengan sistem antrian, konsultasi, dan riwayat pembelian yang terintegrasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="bg-indigo-900 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="/assets/logo/pharmacy_logo.png" alt="Apotech Logo" class="h-8 w-auto">
                        <span class="text-xl font-bold">Apotech</span>
                    </div>
                    <p class="text-indigo-200 text-sm">
                        Solusi modern untuk manajemen apotek yang lebih efisien
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Produk</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-indigo-200 hover:text-white transition-colors">Features</a>
                        </li>
                        <li><a href="#" class="text-indigo-200 hover:text-white transition-colors">Pricing</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-indigo-200 hover:text-white transition-colors">About Us</a>
                        </li>
                        <li><a href="#" class="text-indigo-200 hover:text-white transition-colors">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-indigo-200 hover:text-white transition-colors">Privacy
                                Policy</a>
                        </li>
                        <li><a href="#" class="text-indigo-200 hover:text-white transition-colors">Terms of
                                Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-indigo-800 mt-12 pt-8 text-center text-indigo-200">
                <p>&copy; 2024 Apotech. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Tambahkan AOS JS dan inisialisasi -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
