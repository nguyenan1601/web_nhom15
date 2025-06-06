@extends('layouts.app')

@section('title', 'Trang Chủ - Cửa Hàng Điện Thoại PhoneShop')
@section('description', 'Cửa hàng điện thoại uy tín, chính hãng. iPhone, Samsung, Xiaomi, Oppo với giá tốt nhất thị trường Việt Nam.')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Điện Thoại Chính Hãng
                    <span class="text-warning">Giá Tốt Nhất</span>
                </h1>
                <p class="lead mb-4">
                    Khám phá bộ sưu tập điện thoại mới nhất từ Apple, Samsung, Xiaomi, Oppo và nhiều thương hiệu hàng đầu với ưu đãi hấp dẫn.
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
                <img src="https://via.placeholder.com/500x400/2563eb/ffffff?text=PhoneShop" alt="Hero Image" class="img-fluid rounded-3 shadow-lg">
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
            @foreach($featuredBrands as $brand)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="text-center p-3 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center">
                    <img src="https://via.placeholder.com/80x80/f8f9fa/6c757d?text={{ substr($brand->name, 0, 2) }}" 
                         alt="{{ $brand->name }}" class="img-fluid mx-auto mb-2">
                    <h6 class="mb-0">{{ $brand->name }}</h6>
                    <small class="text-muted">{{ $brand->phones_count ?? 0 }} sản phẩm</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
@if($featuredPhones->count() > 0)
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
        
        <div class="row">
            @foreach($featuredPhones as $phone)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/300x200/f8f9fa/6c757d?text={{ urlencode($phone->name) }}" 
                             class="card-img-top product-image" alt="{{ $phone->name }}">
                        
                        @if($phone->discount_percentage > 0)
                        <span class="discount-badge">-{{ number_format($phone->discount_percentage, 0) }}%</span>
                        @endif
                        
                        @if($phone->featured)
                        <span class="badge badge-featured position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-star me-1"></i>Nổi bật
                        </span>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $phone->name }}</h6>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-tag me-1"></i>{{ $phone->brand->name ?? $phone->brand }}
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex align-items-center mb-2">
                                @if($phone->discount_percentage > 0)
                                <span class="price-original me-2">{{ number_format($phone->original_price) }}₫</span>
                                <span class="price-discounted">{{ number_format($phone->discounted_price) }}₫</span>
                                @else
                                <span class="fw-bold text-primary fs-6">{{ number_format($phone->price) }}₫</span>
                                @endif
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i>{{ $phone->view_count }} lượt xem
                                </small>
                                <a href="{{ route('phones.show', $phone) }}" class="btn btn-primary btn-sm">
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
@endif

<!-- Latest Products Section -->
@if($latestPhones->count() > 0)
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
        
        <div class="row">
            @foreach($latestPhones as $phone)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/200x150/f8f9fa/6c757d?text={{ urlencode(substr($phone->name, 0, 10)) }}" 
                             class="card-img-top product-image" alt="{{ $phone->name }}">
                        
                        <span class="badge badge-new position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-sparkles me-1"></i>Mới
                        </span>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title small">{{ \Str::limit($phone->name, 20) }}</h6>
                        <p class="text-muted small mb-2">{{ $phone->brand->name ?? $phone->brand }}</p>
                        
                        <div class="mt-auto">
                            <div class="fw-bold text-primary small mb-2">{{ number_format($phone->price) }}₫</div>
                            <a href="{{ route('phones.show', $phone) }}" class="btn btn-primary btn-sm w-100">
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
@endif

<!-- Best Sellers Section -->
@if($bestSellerPhones->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Sản Phẩm Bán Chạy</h2>
            <p class="text-muted">Những sản phẩm được khách hàng yêu thích nhất</p>
        </div>
        
        <div class="row">
            @foreach($bestSellerPhones as $phone)
            <div class="col-6 col-lg-3 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/300x200/f8f9fa/6c757d?text={{ urlencode($phone->name) }}" 
                             class="card-img-top product-image" alt="{{ $phone->name }}">
                        
                        <span class="badge bg-success position-absolute" style="top: 10px; left: 10px;">
                            <i class="fas fa-fire me-1"></i>Hot
                        </span>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $phone->name }}</h6>
                        <p class="text-muted small mb-2">{{ $phone->brand->name ?? $phone->brand }}</p>
                        
                        <div class="mt-auto">
                            <div class="fw-bold text-primary mb-2">{{ number_format($phone->price) }}₫</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-success">
                                    <i class="fas fa-eye me-1"></i>{{ $phone->view_count }} views
                                </small>
                                <a href="{{ route('phones.show', $phone) }}" class="btn btn-primary btn-sm">
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
@endif

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
@endsection