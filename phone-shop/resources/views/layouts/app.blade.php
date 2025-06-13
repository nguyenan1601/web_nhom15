<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cửa Hàng Điện Thoại - PhoneShop')</title>

    <!-- Meta Tags for SEO -->
    <meta name="description"
        content="@yield('description', 'Cửa hàng điện thoại uy tín, chính hãng. iPhone, Samsung, Xiaomi, Oppo với giá tốt nhất.')">
    <meta name="keywords" content="@yield('keywords', 'điện thoại, smartphone, iPhone, Samsung, Xiaomi, Oppo')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #64748b;
        --accent-color: #f59e0b;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --dark-color: #1e293b;
        --light-color: #f8fafc;
        --border-color: #e2e8f0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: #334155;
        background-color: #ffffff;
    }

    /* Header */
    .navbar {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
        z-index: 1;
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: white !important;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: white !important;
        transform: translateY(-1px);
    }

    /* Search Box */
    .search-box {
        position: relative;
        max-width: 400px;
    }

    .search-box input {
        border-radius: 25px;
        padding-left: 50px;
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .search-box .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--secondary-color);
    }

    /* Product Cards */
    .product-card {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-color);
    }

    .product-image {
        height: 200px;
        object-fit: cover;
        background: var(--light-color);
    }

    .price-original {
        text-decoration: line-through;
        color: var(--secondary-color);
        font-size: 0.9rem;
    }

    .price-discounted {
        color: var(--danger-color);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .discount-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--danger-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Buttons */
    .btn-primary {
        background: var(--primary-color);
        border-color: var(--primary-color);
        border-radius: 8px;
        font-weight: 500;
        padding: 10px 24px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-outline-primary {
        border-color: var(--primary-color);
        color: var(--primary-color);
        border-radius: 8px;
        font-weight: 500;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
        color: white;
        padding: 80px 0;
    }

    /* Footer */
    .footer {
        background: var(--dark-color);
        color: white;
        padding: 40px 0 20px;
    }

    .text-muted1 {
        color: white !important;
    }

    .footer h5 {
        color: var(--accent-color);
        margin-bottom: 20px;
    }

    .footer a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer a:hover {
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .search-box {
            margin-top: 15px;
            width: 100%;
        }

        .hero-section {
            padding: 40px 0;
        }
    }

    /* Loading Animation */
    .loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, .3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Badge Styles */
    .badge-featured {
        background: var(--accent-color);
        color: white;
    }

    .badge-new {
        background: var(--success-color);
        color: white;
    }

    .badge-sale {
        background: var(--danger-color);
        color: white;
    }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-mobile-alt me-2"></i>PhoneShop
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Trang Chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('phones.index') }}">
                            <i class="fas fa-mobile-alt me-1"></i>Sản Phẩm
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('brands.index') }}">
                    <i class="fas fa-tags me-1"></i>Thương Hiệu
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            <i class="fas fa-list me-1"></i>Danh Mục
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i>Về Chúng Tôi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            <i class="fas fa-phone me-1"></i>Liên Hệ
                        </a>
                    </li>
                </ul>

                <!-- Search Form -->
                <form class="d-flex search-box me-3" action="{{ route('search') }}" method="GET">
                    <div class="position-relative w-100">
                        <i class="fas fa-search search-icon"></i>
                        <input class="form-control" type="search" name="q" placeholder="Tìm kiếm điện thoại..."
                            value="{{ request('q') }}">
                    </div>
                </form>

                <!-- User Menu -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-heart me-1"></i>Yêu Thích
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i>Giỏ Hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="# ">
                            <i class="fas fa-user me-1"></i>Tài Khoản
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact" class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5><i class="fas fa-mobile-alt me-2"></i>PhoneShop</h5>
                    <p class="text-muted1">Cửa hàng điện thoại uy tín, chính hãng với giá tốt nhất thị trường.</p>
                    <div class="social-links">
                        <a href="#" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#"><i class="fab fa-tiktok fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Sản Phẩm</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">iPhone</a></li>
                        <li><a href="#">Samsung Galaxy</a></li>
                        <li><a href="#">Xiaomi</a></li>
                        <li><a href="#">Oppo</a></li>
                        <li><a href="#">Vivo</a></li>
                        <li><a href="#">Realme</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Hỗ Trợ</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Phương thức thanh toán</a></li>
                        <li><a href="#">Vận chuyển</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Liên Hệ</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>123 Đường ABC, Quận Hà Đông, Hà Nội</li>
                        <li><i class="fas fa-phone me-2"></i>0123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i>info@phoneshop.vn</li>
                        <li><i class="fas fa-clock me-2"></i>T2-CN: 8:00 - 22:00</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center py-3">
                <p class="mb-0">&copy; {{ date('Y') }} PhoneShop. All rights reserved. Designed with <i
                        class="fas fa-heart text-danger"></i> by Team 15</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.querySelector('.search-box form');
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                const input = this.querySelector('input[name="q"]');
                if (!input.value.trim()) {
                    e.preventDefault();
                    input.focus();
                }
            });
        }
    });
    </script>

    @stack('scripts')
</body>

</html>