<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bệnh Viện HUIT - Hệ thống Quản lý Khám chữa bệnh') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 font-sans">
    <!-- Header với Navigation -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <nav class="container max-w-screen-xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo và Tên -->
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-medical-600 to-medical-800 p-3 rounded-xl">
                        <i class="fas fa-hospital text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Bệnh Viện HUIT</h1>
                        <p class="text-sm text-gray-600">Hệ thống Quản lý Khám chữa bệnh</p>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}"
                        class="text-gray-700 hover:text-medical-600 transition-colors duration-300 font-medium">
                        <i class="fas fa-home mr-2"></i>Trang chủ
                    </a>
                    <a href="#"
                        class="text-gray-700 hover:text-medical-600 transition-colors duration-300 font-medium">
                        <i class="fas fa-info-circle mr-2"></i>Về chúng tôi
                    </a>
                    <a href="#"
                        class="text-gray-700 hover:text-medical-600 transition-colors duration-300 font-medium">
                        <i class="fas fa-stethoscope mr-2"></i>Dịch vụ
                    </a>
                    <a href="#"
                        class="text-gray-700 hover:text-medical-600 transition-colors duration-300 font-medium">
                        <i class="fas fa-phone mr-2"></i>Liên hệ
                    </a>

                    <!-- Login Buttons -->
                    <div class="flex items-center space-x-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="login-button px-5 py-2 rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-gradient-to-r from-medical-600 to-medical-700 text-white px-6 py-2 rounded-lg hover:from-medical-700 hover:to-medical-800 transition-all duration-300 font-medium shadow-lg">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Đăng nhập
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="bg-gradient-to-r from-health-600 to-health-700 text-white px-6 py-2 rounded-lg hover:from-health-700 hover:to-health-800 transition-all duration-300 font-medium shadow-lg">
                                        <i class="fas fa-user-plus mr-2"></i>Đăng ký
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-r from-medical-600 to-medical-800 p-3 rounded-xl">
                            <i class="fas fa-hospital text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Bệnh Viện HUIT</h3>
                            <p class="text-gray-400 text-sm">Chăm sóc sức khỏe toàn diện</p>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Hệ thống quản lý khám chữa bệnh hiện đại, mang đến trải nghiệm tốt nhất cho bệnh nhân.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Thông Tin Thêm</h4>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-medical-400 transition-colors duration-300"><i
                                    class="fas fa-calendar-plus mr-2"></i>Đặt lịch hẹn</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-medical-400 transition-colors duration-300"><i
                                    class="fas fa-briefcase mr-2"></i>Tuyển dụng</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-medical-400 transition-colors duration-300"><i
                                    class="fas fa-file-alt mr-2"></i>Quy định sử dụng</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-medical-400 transition-colors duration-300"><i
                                    class="fas fa-shield-alt mr-2"></i>Chính sách bảo mật</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Liên Hệ</h4>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-medical-400 mt-1"></i>
                            <div>
                                <p class="text-gray-400">140 Lê Trọng Tấn</p>
                                <p class="text-gray-400">Tây Thạnh</p>
                                <p class="text-gray-400">Tân Phú, TP.HCM</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-medical-400"></i>
                            <span class="text-gray-400">Hotline: 1800 6767</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-medical-400"></i>
                            <span class="text-gray-400">trananhvu@huit.edu.vn</span>
                        </div>
                    </div>
                </div>

                <!-- Working Hours -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Giờ Làm Việc</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Thứ 2 - Chủ nhật</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Sáng:</span>
                            <span class="text-white">7:00 - 12:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Chiều:</span>
                            <span class="text-white">13:30 - 17:00</span>
                        </div>
                        <div class="bg-gradient-to-r from-red-500 to-red-600 p-3 rounded-lg mt-4">
                            <p class="text-white font-semibold text-center">
                                <i class="fas fa-ambulance mr-2"></i>Cấp cứu 24/7
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-center md:text-left">
                        © {{ date('Y') }} Nhóm JQK - Hệ thống quản lý bệnh viện. Tất cả quyền được bảo lưu.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-medical-400 transition-colors duration-300">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-medical-400 transition-colors duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-medical-400 transition-colors duration-300">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-medical-400 transition-colors duration-300">
                            <i class="fab fa-discord text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-medical-400 transition-colors duration-300">
                            <i class="fab fa-kaggle text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button
            class="bg-gradient-to-r from-health-500 to-health-600 text-white w-16 h-16 rounded-full shadow-2xl hover:from-health-600 hover:to-health-700 transition-all duration-300 transform hover:scale-110 animate-bounce-slow">
            <i class="fas fa-phone text-xl"></i>
        </button>
    </div>

    <!-- Mobile Menu Toggle (Hidden by default, can be shown with JavaScript) -->
    <div class="md:hidden fixed top-4 right-4 z-50">
        <button id="mobileMenuButton"
            class="bg-white p-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <i class="fas fa-bars text-gray-600"></i>
        </button>
    </div>

    <!-- Mobile Menu (Ẩn mặc định) -->
    <div id="mobileMenu" class="md:hidden fixed top-0 left-0 w-full h-full bg-white z-40 hidden">
        <div class="flex flex-col items-center justify-center h-full space-y-6">
            <a href="#" class="text-gray-700 hover:text-medical-600 text-lg font-medium">
                <i class="fas fa-home mr-2"></i>Trang chủ
            </a>
            <a href="#" class="text-gray-700 hover:text-medical-600 text-lg font-medium">
                <i class="fas fa-info-circle mr-2"></i>Về chúng tôi
            </a>
            <a href="#" class="text-gray-700 hover:text-medical-600 text-lg font-medium">
                <i class="fas fa-stethoscope mr-2"></i>Dịch vụ
            </a>
            <a href="#" class="text-gray-700 hover:text-medical-600 text-lg font-medium">
                <i class="fas fa-phone mr-2"></i>Liên hệ
            </a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="login-button px-5 py-2 rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-gradient-to-r from-medical-600 to-medical-700 text-white px-6 py-2 rounded-lg hover:from-medical-700 hover:to-medical-800 transition-all duration-300 font-medium shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Đăng nhập
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-health-600 to-health-700 text-white px-6 py-2 rounded-lg hover:from-health-700 hover:to-health-800 transition-all duration-300 font-medium shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>Đăng ký
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
