@extends('layouts.app')

@section('title', 'Trang Chủ - Cửa Hàng Điện Thoại PhoneShop')
@section('description', 'Cửa hàng điện thoại uy tín, chính hãng. iPhone, Samsung, Xiaomi, Oppo với giá tốt nhất thị
trường Việt Nam.')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Điện Thoại Chính Hãng
                    <span class="text-warning">Giá Tốt Nhất</span>
                </h1>
                <p class="lead mb-4">
                    Khám phá bộ sưu tập điện thoại mới nhất từ Apple, Samsung, Xiaomi, Oppo và nhiều thương hiệu hàng
                    đầu với ưu đãi hấp dẫn.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('phones.index') }}" class="btn btn-warning btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>Mua Ngay
                    </a>
                    <a href="{{ route('phones.index', ['sort' => 'newest']) }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-star me-2"></i>Sản Phẩm Mới
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                    alt="Smartphone Collection" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats Section -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <div class="row text-center">
            <div class="col-6 col-md-3 mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-shipping-fast text-primary me-2 fs-4"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Miễn Phí Ship</h6>
                        <small class="text-muted">Đơn từ 500k</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-shield-alt text-success me-2 fs-4"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Bảo Hành</h6>
                        <small class="text-muted">12 tháng</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-undo-alt text-warning me-2 fs-4"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Đổi Trả</h6>
                        <small class="text-muted">7 ngày</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-headset text-info me-2 fs-4"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">Hỗ Trợ</h6>
                        <small class="text-muted">24/7</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Brands Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Thương Hiệu Nổi Bật</h2>
            <p class="text-muted">Các thương hiệu điện thoại hàng đầu thế giới</p>
        </div>
        <div class="row">
            @php
            $featuredBrands = [
            ['name' => 'Apple', 'slug' => 'apple', 'logo' =>
            'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg'],
            ['name' => 'Samsung', 'slug' => 'samsung', 'logo' =>
            'https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi', 'logo' =>
            'https://upload.wikimedia.org/wikipedia/commons/a/ae/Xiaomi_logo_%282021-%29.svg'],
            ['name' => 'Oppo', 'slug' => 'oppo', 'logo' =>
            'https://upload.wikimedia.org/wikipedia/commons/7/78/OPPO_LOGO_2019.svg'],
            ['name' => 'Vivo', 'slug' => 'vivo', 'logo' =>
            'https://upload.wikimedia.org/wikipedia/commons/9/99/Vivo_logo.svg'],
            ['name' => 'Realme', 'slug' => 'realme', 'logo' =>
            'https://upload.wikimedia.org/wikipedia/commons/9/9b/Realme_logo.svg'],
            ];
            @endphp

            @foreach($featuredBrands as $brand)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="text-center p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center">
                    <a href="{{ url('/thuong-hieu/' . $brand['slug']) }}" class="d-block mb-2">
                        <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }}" class="img-fluid"
                            style="max-height: 50px; object-fit: contain;">
                    </a>
                    <h6 class="mb-0">
                        <a href="{{ url('/thuong-hieu/' . $brand['slug']) }}" class="text-decoration-none text-dark">
                            {{ $brand['name'] }}
                        </a>
                    </h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>




<!-- Hot Deals Section -->
<section class="py-5 bg-danger text-white">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">
                <i class="fas fa-fire me-2"></i>
                Ưu Đãi Hôm Nay
            </h2>
            <p class="mb-0">Giảm giá lên đến 50% cho một số sản phẩm</p>
        </div>

        <div class="row">
            @php
            $hotDeals = [
            [
            'name' => 'iPhone 15 Pro Max',
            'brand' => 'Apple',
            'original_price' => 34990000,
            'sale_price' => 29990000,
            'discount' => 15,
            'image' =>
            'https://images.unsplash.com/photo-1695048133142-1a20484d2569?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
            ],
            [
            'name' => 'Samsung Galaxy S24 Ultra',
            'brand' => 'Samsung',
            'original_price' => 29990000,
            'sale_price' => 24990000,
            'discount' => 17,
            'image' =>
            'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
            ],
            [
            'name' => 'Xiaomi 14 Ultra',
            'brand' => 'Xiaomi',
            'original_price' => 24990000,
            'sale_price' => 19990000,
            'discount' => 20,
            'image' =>
            'https://images.unsplash.com/photo-1567581935884-3349723552ca?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
            ]
            ];
            @endphp

            @foreach($hotDeals as $deal)
            <div class="col-md-4 mb-4">
                <div class="card bg-white text-dark h-100 shadow-lg">
                    <div class="position-relative">
                        <img src="{{ $deal['image'] }}" class="card-img-top" alt="{{ $deal['name'] }}"
                            style="height: 200px; object-fit: cover;">
                        <span class="badge bg-danger position-absolute" style="top: 10px; right: 10px;">
                            -{{ $deal['discount'] }}%
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $deal['name'] }}</h5>
                        <p class="text-muted mb-2">{{ $deal['brand'] }}</p>
                        <div class="price-section">
                            <span class="text-decoration-line-through text-muted me-2">
                                {{ number_format($deal['original_price']) }}₫
                            </span>
                            <span class="fw-bold text-danger fs-5">
                                {{ number_format($deal['sale_price']) }}₫
                            </span>
                        </div>
                        <a href="#" class="btn btn-danger w-100 mt-3">
                            <i class="fas fa-shopping-cart me-2"></i>Mua Ngay
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Sản Phẩm Nổi Bật</h2>
                <p class="text-muted mb-0">Những sản phẩm được yêu thích nhất</p>
            </div>
            <a href="{{ route('phones.index', ['featured' => 1]) }}" class="btn btn-outline-primary">
                Xem Tất Cả <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        @php
        $sampleFeaturedPhones = [
        [
        'name' => 'iPhone 15 Pro',
        'brand' => 'Apple',
        'price' => 28990000,
        'original_price' => 31990000,
        'discount_percentage' => 9,
        'view_count' => 1250,
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
        ],
        [
        'name' => 'Samsung Galaxy S24',
        'brand' => 'Samsung',
        'price' => 22990000,
        'view_count' => 980,
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
        ],
        [
        'name' => 'Xiaomi 14',
        'brand' => 'Xiaomi',
        'price' => 15990000,
        'original_price' => 17990000,
        'discount_percentage' => 11,
        'view_count' => 756,
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1567581935884-3349723552ca?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
        ],
        [
        'name' => 'Oppo Find X7',
        'brand' => 'Oppo',
        'price' => 18990000,
        'view_count' => 642,
        'featured' => true,
        'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&w=300&h=200&fit=crop'
        ]
        ];

        $featuredPhones = isset($featuredPhones) ? $featuredPhones :
        collect($sampleFeaturedPhones)->map(function($phone) {
        return (object) $phone;
        });
        @endphp

        <div class="row">
            @foreach($featuredPhones as $phone)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $phone->image ?? 'https://via.placeholder.com/300x200/f8f9fa/6c757d?text=' . urlencode($phone->name) }}"
                            class="card-img-top product-image" alt="{{ $phone->name }}"
                            style="height: 200px; object-fit: cover;">

                        @if(isset($phone->discount_percentage) && $phone->discount_percentage > 0)
                        <span class="badge bg-danger position-absolute" style="top: 10px; right: 10px;">
                            -{{ number_format($phone->discount_percentage, 0) }}%
                        </span>
                        @endif

                        @if(isset($phone->featured) && $phone->featured)
                        <span class="badge bg-warning position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-star me-1"></i>Nổi bật
                        </span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $phone->name }}</h6>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-tag me-1"></i>{{ $phone->brand }}
                        </p>

                        <div class="mt-auto">
                            <div class="d-flex align-items-center mb-2">
                                @if(isset($phone->discount_percentage) && $phone->discount_percentage > 0)
                                <span class="text-decoration-line-through text-muted me-2 small">
                                    {{ number_format($phone->original_price) }}₫
                                </span>
                                <span class="fw-bold text-danger">{{ number_format($phone->price) }}₫</span>
                                @else
                                <span class="fw-bold text-primary fs-6">{{ number_format($phone->price) }}₫</span>
                                @endif
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i>{{ $phone->view_count }} lượt xem
                                </small>
                                <a href="{{ route('phones.show', $phone->id ?? 1) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-info-circle me-1"></i>Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Products Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Sản Phẩm Mới Nhất</h2>
                <p class="text-muted mb-0">Những sản phẩm vừa ra mắt</p>
            </div>
            <a href="{{ route('phones.index', ['sort' => 'newest']) }}" class="btn btn-outline-primary">
                Xem Tất Cả <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>

        @php
        $sampleLatestPhones = [
        ['name' => 'iPhone 15 Plus', 'brand' => 'Apple', 'price' => 25990000, 'image' =>
        'https://images.unsplash.com/photo-1695048133142-1a20484d2569?ixlib=rb-4.0.3&w=200&h=150&fit=crop'],
        ['name' => 'Galaxy A55', 'brand' => 'Samsung', 'price' => 10990000, 'image' =>
        'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&w=200&h=150&fit=crop'],
        ['name' => 'Redmi Note 13', 'brand' => 'Xiaomi', 'price' => 5990000, 'image' =>
        'https://images.unsplash.com/photo-1567581935884-3349723552ca?ixlib=rb-4.0.3&w=200&h=150&fit=crop'],
        ['name' => 'Oppo A79', 'brand' => 'Oppo', 'price' => 6990000, 'image' =>
        'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&w=200&h=150&fit=crop'],
        ['name' => 'Vivo Y36', 'brand' => 'Vivo', 'price' => 4990000, 'image' =>
        'https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?ixlib=rb-4.0.3&w=200&h=150&fit=crop'],
        ['name' => 'Realme 11', 'brand' => 'Realme', 'price' => 7990000, 'image' =>
        'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&w=200&h=150&fit=crop']
        ];

        $latestPhones = isset($latestPhones) ? $latestPhones : collect($sampleLatestPhones)->map(function($phone) {
        return (object) $phone;
        });
        @endphp

        <div class="row">
            @foreach($latestPhones as $phone)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $phone->image ?? 'https://via.placeholder.com/200x150/f8f9fa/6c757d?text=' . urlencode(substr($phone->name, 0, 10)) }}"
                            class="card-img-top product-image" alt="{{ $phone->name }}"
                            style="height: 150px; object-fit: cover;">

                        <span class="badge bg-success position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-sparkles me-1"></i>Mới
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title small">{{ \Str::limit($phone->name, 20) }}</h6>
                        <p class="text-muted small mb-2">{{ $phone->brand }}</p>

                        <div class="mt-auto">
                            <div class="fw-bold text-primary small mb-2">{{ number_format($phone->price) }}₫</div>
                            <a href="{{ route('phones.show', $phone->id ?? 1) }}" class="btn btn-primary btn-sm w-100">
                                Xem
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Best Sellers Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Sản Phẩm Bán Chạy</h2>
            <p class="text-muted">Những sản phẩm được khách hàng yêu thích nhất</p>
        </div>

        @php
        $sampleBestSellers = [
        ['name' => 'iPhone 14', 'brand' => 'Apple', 'price' => 19990000, 'view_count' => 2450, 'image' =>
        'https://images.unsplash.com/photo-1695048133142-1a20484d2569?ixlib=rb-4.0.3&w=300&h=200&fit=crop'],
        ['name' => 'Galaxy A54', 'brand' => 'Samsung', 'price' => 9990000, 'view_count' => 1890, 'image' =>
        'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?ixlib=rb-4.0.3&w=300&h=200&fit=crop'],
        ['name' => 'Redmi 12', 'brand' => 'Xiaomi', 'price' => 4990000, 'view_count' => 1650, 'image' =>
        'https://images.unsplash.com/photo-1567581935884-3349723552ca?ixlib=rb-4.0.3&w=300&h=200&fit=crop'],
        ['name' => 'Oppo A58', 'brand' => 'Oppo', 'price' => 5490000, 'view_count' => 1320, 'image' =>
        'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?ixlib=rb-4.0.3&w=300&h=200&fit=crop']
        ];

        $bestSellerPhones = isset($bestSellerPhones) ? $bestSellerPhones :
        collect($sampleBestSellers)->map(function($phone) {
        return (object) $phone;
        });
        @endphp

        <div class="row">
            @foreach($bestSellerPhones as $phone)
            <div class="col-6 col-lg-3 mb-4">
                <div class="card product-card h-100 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $phone->image ?? 'https://via.placeholder.com/300x200/f8f9fa/6c757d?text=' . urlencode($phone->name) }}"
                            class="card-img-top product-image" alt="{{ $phone->name }}"
                            style="height: 200px; object-fit: cover;">

                        <span class="badge bg-success position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-fire me-1"></i>Hot
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $phone->name }}</h6>
                        <p class="text-muted small mb-2">{{ $phone->brand }}</p>

                        <div class="mt-auto">
                            <div class="fw-bold text-primary mb-2">{{ number_format($phone->price) }}₫</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-success">
                                    <i class="fas fa-eye me-1"></i>{{ $phone->view_count }} views
                                </small>
                                <a href="{{ route('phones.show', $phone->id ?? 1) }}" class="btn btn-primary btn-sm">
                                    Chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-3">Đăng Ký Nhận Tin</h3>
                <p class="mb-4">Nhận thông báo về sản phẩm mới và ưu đãi đặc biệt</p>
            </div>
            <div class="col-lg-6">
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Nhập email của bạn">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-paper-plane me-2"></i>Đăng Ký
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Tìm Không Ra Sản Phẩm Ưng Ý?</h2>
        <p class="lead mb-4">Liên hệ với chúng tôi để được tư vấn miễn phí về sản phẩm phù hợp nhất</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('contact') }}" class="btn btn-warning btn-lg">
                <i class="fas fa-phone me-2"></i>Liên Hệ Ngay
            </a>
            <a href="{{ route('phones.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-search me-2"></i>Tìm Kiếm
            </a>
        </div>
    </div>
</section>



<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 500px;
}

.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.product-image {
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.brand-card {
    transition: transform 0.3s ease;
}

.brand-card:hover {
    transform: translateY(-3px);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.discount-badge {
    background: #dc3545;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
}

.badge-featured {
    background: #ffc107;
    color: #000;
}

.badge-new {
    background: #28a745;
    color: white;
}

.price-original {
    text-decoration: line-through;
    color: #6c757d;
}

.price-discounted {
    color: #dc3545;
    font-weight: bold;
}

.brand-logo img {
    max-height: 50px;
    max-width: 80px;
    object-fit: contain;
}

.price-section {
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2rem;
    }

    .hero-section .lead {
        font-size: 1rem;
    }

    .product-card .card-title {
        font-size: 0.9rem;
    }
}



/* Animation for badges */
.badge {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }

    100% {
        transform: scale(1);
    }
}

/* Loading state for images */
.product-image {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }

    100% {
        background-position: -200% 0;
    }
}

.product-image img {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-image img.loaded {
    opacity: 1;
}
</style>

<script>
// Add loading animation for images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.product-image img');

    images.forEach(img => {
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
        }
    });

    // Add smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add newsletter form validation
    const newsletterForm = document.querySelector('form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;

            if (email) {
                // Here you would typically send the email to your backend
                alert('Cảm ơn bạn đã đăng ký nhận tin!');
                this.reset();
            }
        });
    }
});
</script>
@endsection