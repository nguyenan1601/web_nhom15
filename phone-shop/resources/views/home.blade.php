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
                <img src="{{ asset('Images\Home-img.png') }}" alt="Smartphone Collection"
                    class="img-fluid rounded-3 shadow-lg">

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
            'images\Apple-logo.png'],
            ['name' => 'Samsung', 'slug' => 'samsung', 'logo' =>
            'images\Samsung-logo.png'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi', 'logo' =>
            'images\Xiaomi-logo.png'],
            ['name' => 'Oppo', 'slug' => 'oppo', 'logo' =>
            'images\oppo-logo.png'],
            ['name' => 'Vivo', 'slug' => 'vivo', 'logo' =>
            'images\Vivo-Logo.png'],
            ['name' => 'Realme', 'slug' => 'realme', 'logo' =>
            'images\realme-logo.png'],
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
<style>
.hot-deals-section {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 50%, #dc3545 100%);
    position: relative;
    overflow: hidden;
}

.hot-deals-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
    opacity: 0.3;
}

.deal-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
}

.deal-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.deal-image {
    transition: transform 0.3s ease;
    border-radius: 15px;
    padding: 10px;
    background: #f8f9fa;
}

.deal-card:hover .deal-image {
    transform: scale(1.1);
}

.discount-badge {
    background: linear-gradient(45deg, #ff4757, #ff6b7a);
    color: white;
    font-weight: bold;
    border-radius: 20px;
    padding: 8px 12px;
    font-size: 0.9rem;
    box-shadow: 0 4px 15px rgba(255, 71, 87, 0.4);
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

.price-old {
    position: relative;
    color: #6c757d;
    font-size: 0.9rem;
    opacity: 0.8;
    display: inline-block;
    text-decoration: line-through;
    text-decoration-color: #495057;
    text-decoration-thickness: 2px;
}

.deal-btn {
    background: linear-gradient(45deg, #dc3545, #ff4757);
    border: none;
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: bold;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.deal-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.deal-btn:hover::before {
    left: 100%;
}

.deal-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

.fire-icon {
    animation: flicker 1.5s infinite alternate;
}

@keyframes flicker {
    0% {
        opacity: 1;
        transform: scale(1);
    }

    100% {
        opacity: 0.8;
        transform: scale(1.1);
    }
}

/* Hiệu ứng hover cho ảnh sản phẩm có thể click */
.product-card .position-relative a:hover .product-image,
.deal-card .position-relative a:hover .deal-image {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.product-card .position-relative a,
.deal-card .position-relative a {
    display: block;
    overflow: hidden;
    border-radius: 8px;
}

.product-card .position-relative a:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.deal-card .position-relative a:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Thêm cursor pointer cho ảnh */
.product-image, .deal-image {
    cursor: pointer;
    transition: transform 0.3s ease;
}
</style>

<section class="py-5 hot-deals-section text-white position-relative">
    <div class="container position-relative">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5 mb-3">
                <i class="fas fa-fire me-3 fire-icon text-warning"></i>
                ƯU ĐÃI HOT
                <i class="fas fa-fire ms-3 fire-icon text-warning"></i>
            </h2>
            <p class="fs-5 mb-0">🔥 Giảm giá lên đến 50% - Số lượng có hạn 🔥</p>
            <div class="mt-3">
                <span class="badge bg-warning text-dark px-4 py-2 fs-6">
                    <i class="fas fa-clock me-2"></i>Chỉ còn 24 giờ!
                </span>
            </div>
        </div>

        <div class="row justify-content-center">
            @if(isset($hotDeals) && (is_array($hotDeals) ? count($hotDeals) > 0 : $hotDeals->count() > 0))
            @foreach($hotDeals as $deal)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card deal-card bg-white text-dark h-100">
                    <div class="position-relative p-3">
                        <a href="{{ route('phones.show', $deal) }}" class="d-block">
                            <img src="{{ $deal->image_path ? asset($deal->image_path) : asset('images/default-phone.png') }}"
                                class="card-img-top deal-image" alt="{{ $deal->name }}"
                                style="height: 220px; object-fit: contain;">
                        </a>
                        <span class="discount-badge position-absolute" style="top: 15px; right: 15px;">
                            -{{ number_format($deal->discount_percentage, 0) }}%
                        </span>
                        @if($deal->featured)
                        <span class="badge bg-warning text-dark position-absolute" style="top: 15px; left: 15px;">
                            <i class="fas fa-star me-1"></i>HOT
                        </span>
                        @endif
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-2">{{ \Str::limit($deal->name, 35) }}</h5>
                        <p class="text-muted mb-3">
                            <i class="fas fa-tag me-1"></i>{{ $deal->brand }}
                        </p>

                        <div class="price-section mb-4">
                            @if($deal->original_price && $deal->original_price > $deal->price)
                            <div class="price-old mb-1">
                                {{ number_format($deal->original_price) }}₫
                            </div>
                            @endif
                            <div class="fw-bold text-danger" style="font-size: 1.5rem;">
                                {{ number_format($deal->price) }}₫
                            </div>
                            <small class="text-success">
                                <i class="fas fa-arrow-down me-1"></i>
                                Tiết kiệm {{ number_format($deal->original_price - $deal->price) }}₫
                            </small>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('phones.show', $deal) }}" class="btn deal-btn text-white">
                                <i class="fas fa-shopping-cart me-2"></i>MUA NGAY
                            </a>
                            <small class="text-muted">
                                <i class="fas fa-truck me-1"></i>Miễn phí vận chuyển
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <!-- Fallback to sample data if no hot deals from database -->
            @php
            $sampleHotDeals = [
            [
            'id' => 1,
            'name' => 'iPhone 15 Pro Max',
            'brand' => 'Apple',
            'original_price' => 34990000,
            'price' => 29990000,
            'discount_percentage' => 15,
            'image_path' => 'images/iPhone 15 Pro Max crop.png',
            'featured' => true
            ],
            [
            'id' => 2,
            'name' => 'Samsung Galaxy S24 Ultra',
            'brand' => 'Samsung',
            'original_price' => 29990000,
            'price' => 24990000,
            'discount_percentage' => 17,
            'image_path' => 'images/Samsung Galaxy S24 Ultra crop.png',
            'featured' => true
            ],
            [
            'id' => 3,
            'name' => 'Xiaomi 14 Ultra',
            'brand' => 'Xiaomi',
            'original_price' => 24990000,
            'price' => 19990000,
            'discount_percentage' => 20,
            'image_path' => 'images/Xiaomi 14 Ultra crop.png',
            'featured' => false
            ]
            ];
            @endphp

            @foreach($sampleHotDeals as $deal)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card deal-card bg-white text-dark h-100">
                    <div class="position-relative p-3">
                        <a href="{{ route('phones.show', $deal['id']) }}" class="d-block">
                            <img src="{{ asset($deal['image_path']) }}" class="card-img-top deal-image"
                                alt="{{ $deal['name'] }}" style="height: 220px; object-fit: contain;">
                        </a>
                        <span class="discount-badge position-absolute" style="top: 15px; right: 15px;">
                            -{{ $deal['discount_percentage'] }}%
                        </span>
                        @if($deal['featured'])
                        <span class="badge bg-warning text-dark position-absolute" style="top: 15px; left: 15px;">
                            <i class="fas fa-star me-1"></i>HOT
                        </span>
                        @endif
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold mb-2">{{ \Str::limit($deal['name'], 35) }}</h5>
                        <p class="text-muted mb-3">
                            <i class="fas fa-tag me-1"></i>{{ $deal['brand'] }}
                        </p>

                        <div class="price-section mb-4">
                            <div class="price-old mb-1">
                                {{ number_format($deal['original_price']) }}₫
                            </div>
                            <div class="fw-bold text-danger" style="font-size: 1.5rem;">
                                {{ number_format($deal['price']) }}₫
                            </div>
                            <small class="text-success">
                                <i class="fas fa-arrow-down me-1"></i>
                                Tiết kiệm {{ number_format($deal['original_price'] - $deal['price']) }}₫
                            </small>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('phones.show', $deal['id']) }}" class="btn deal-btn text-white">
                                <i class="fas fa-shopping-cart me-2"></i>MUA NGAY
                            </a>
                            <small class="text-muted">
                                <i class="fas fa-truck me-1"></i>Miễn phí vận chuyển
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
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
        'id' => 1,
        'name' => 'iPhone 15 Pro',
        'brand' => 'Apple',
        'price' => 28990000,
        'original_price' => 31990000,
        'discount_percentage' => 9,
        'view_count' => 1250,
        'featured' => true,
        'image_path' => 'images/iPhone 15 Pro Max crop.png'
        ],
        [
        'id' => 2,
        'name' => 'Samsung Galaxy S24',
        'brand' => 'Samsung',
        'price' => 22990000,
        'view_count' => 980,
        'featured' => true,
        'image_path' => 'images/Samsung Galaxy S24 Ultra crop.png'
        ],
        [
        'id' => 3,
        'name' => 'Xiaomi 14',
        'brand' => 'Xiaomi',
        'price' => 15990000,
        'original_price' => 17990000,
        'discount_percentage' => 11,
        'view_count' => 756,
        'featured' => true,
        'image_path' => 'images/Xiaomi 14 Ultra crop.png'
        ],
        [
        'id' => 4,
        'name' => 'Oppo Find X7',
        'brand' => 'Oppo',
        'price' => 18990000,
        'view_count' => 642,
        'featured' => true,
        'image_path' => 'images/Oppo Find X7 crop.png'
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
                        <a href="{{ route('phones.show', $phone->id ?? $phone['id']) }}" class="d-block">
                            <img src="{{ isset($phone->image_path) ? asset($phone->image_path) : asset('images/default-phone.png') }}"
                                class="card-img-top product-image" alt="{{ $phone->name }}"
                                style="height: 200px; object-fit: contain;">
                        </a>

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
                                <a href="{{ route('phones.show', $phone->id ?? $phone['id']) }}" class="btn btn-primary btn-sm">
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
        ['id' => 5, 'name' => 'iPhone 15 Plus', 'brand' => 'Apple', 'price' => 25990000, 'image_path' =>
        'images/iPhone 15 Pro Max crop.png'],
        ['id' => 6, 'name' => 'Galaxy A55', 'brand' => 'Samsung', 'price' => 10990000, 'image_path' =>
        'images/Galaxy A55 crop.png'],
        ['id' => 7, 'name' => 'Redmi Note 13', 'brand' => 'Xiaomi', 'price' => 5990000, 'image_path' =>
        'images/Redmi Note 13 crop.png'],
        ['id' => 8, 'name' => 'Oppo A79', 'brand' => 'Oppo', 'price' => 6990000, 'image_path' =>
        'images/Oppo A79 crop.png'],
        ['id' => 9, 'name' => 'Vivo Y36', 'brand' => 'Vivo', 'price' => 4990000, 'image_path' =>
        'images/Vivo Y36 crop.png'],
        ['id' => 10, 'name' => 'Realme 11', 'brand' => 'Realme', 'price' => 7990000, 'image_path' =>
        'images/Realme_11.png']
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
                        <a href="{{ route('phones.show', $phone->id ?? $phone['id']) }}" class="d-block">
                            <img src="{{ isset($phone->image_path) ? asset($phone->image_path) : (isset($phone->image) ? asset($phone->image) : asset('images/default-phone.png')) }}"
                                class="card-img-top product-image" alt="{{ $phone->name }}"
                                style="height: 150px; object-fit: contain;">
                        </a>

                        <span class="badge bg-success position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-sparkles me-1"></i>Mới
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title small">{{ \Str::limit($phone->name, 20) }}</h6>
                        <p class="text-muted small mb-2">{{ $phone->brand }}</p>

                        <div class="mt-auto">
                            <div class="fw-bold text-primary small mb-2">{{ number_format($phone->price) }}₫</div>
                            <a href="{{ route('phones.show', $phone->id ?? $phone['id']) }}" class="btn btn-primary btn-sm w-100">
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
        ['id' => 11, 'name' => 'iPhone 14', 'brand' => 'Apple', 'price' => 19990000, 'view_count' => 2450, 'image_path' =>
        'images/iPhone 14 crop.png'],
        ['id' => 12, 'name' => 'Galaxy A54', 'brand' => 'Samsung', 'price' => 9990000, 'view_count' => 1890, 'image_path' =>
        'images/Galaxy A54 crop.png'],
        ['id' => 13, 'name' => 'Redmi 12', 'brand' => 'Xiaomi', 'price' => 4990000, 'view_count' => 1650, 'image_path' =>
        'images/Redmi 12 crop.png'],
        ['id' => 14, 'name' => 'Oppo A58', 'brand' => 'Oppo', 'price' => 5490000, 'view_count' => 1320, 'image_path' =>
        'images/Oppo A58 crop.png']
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
                        <a href="{{ route('phones.show', $phone->id ?? $phone['id']) }}" class="d-block">
                            <img src="{{ isset($phone->image_path) ? asset($phone->image_path) : (isset($phone->image) ? asset($phone->image) : asset('images/default-phone.png')) }}"
                                class="card-img-top product-image" alt="{{ $phone->name }}"
                                style="height: 200px; object-fit: contain;">
                        </a>

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
                                <a href="{{ route('phones.show', $phone->id ?? $phone['id']) }}" class="btn btn-primary btn-sm">
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
            <a href="{{ route('about') }}" class="btn btn-warning btn-lg">
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