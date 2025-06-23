@extends('layouts.app')

@section('title', $phone->name . ' - PhoneShop')

@section('content')
<style>
    /* Loading effect for image */
    .product-image-loading {
        background: linear-gradient(90deg, #e2e2e2 25%, #f0f0f0 50%, #e2e2e2 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }    .product-image-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 30px;
        padding: 35px;
        box-shadow: 
            0 20px 60px rgba(0,0,0,0.08),
            0 5px 15px rgba(0,0,0,0.06),
            inset 0 1px 0 rgba(255,255,255,0.95),
            inset 0 -1px 0 rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
        aspect-ratio: 9/16; /* Tỷ lệ gần giống điện thoại thực tế */
        height: 650px;
        width: 400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid rgba(255,255,255,0.95);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background-image: 
            radial-gradient(ellipse at top left, rgba(255,255,255,0.9) 0%, transparent 60%),
            radial-gradient(ellipse at bottom right, rgba(0,0,0,0.02) 0%, transparent 60%);
        z-index: 1; /* Đảm bảo không đè lên header */
    }      .product-image-container:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 25px 60px rgba(0,0,0,0.12),
            0 8px 20px rgba(0,0,0,0.06),
            inset 0 1px 0 rgba(255,255,255,1),
            inset 0 -1px 0 rgba(0,0,0,0.08);
        border-color: rgba(255,255,255,1);
        z-index: 2; /* Tăng nhẹ z-index khi hover nhưng vẫn thấp hơn header */
    }      .product-image-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            linear-gradient(135deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.3) 50%, transparent 100%),
            radial-gradient(ellipse at center, rgba(255,255,255,0.6) 0%, rgba(255,255,255,0.2) 70%);
        z-index: 1;
        opacity: 0.7;
        animation: shimmer 4s ease-in-out infinite;
        pointer-events: none; /* Đảm bảo không ảnh hưởng đến tương tác */
    }
    
    @keyframes shimmer {
        0%, 100% { 
            opacity: 0.7; 
            background-position: -200% 0;
        }
        50% { 
            opacity: 0.9; 
            background-position: 200% 0;
        }
    }      .product-image-container::after {
        content: '';
        position: absolute;
        top: 20px;
        right: 20px;
        bottom: 20px;
        left: 20px;
        border: 3px solid rgba(255,255,255,0.5);
        border-radius: 25px;
        z-index: 1;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.15), transparent);
        animation: borderPulse 3s ease-in-out infinite;
        pointer-events: none; /* Đảm bảo không ảnh hưởng đến tương tác */
    }
    
    @keyframes borderPulse {
        0%, 100% { 
            border-color: rgba(255,255,255,0.5);
            box-shadow: inset 0 0 20px rgba(255,255,255,0.2);
        }
        50% { 
            border-color: rgba(255,255,255,0.8);
            box-shadow: inset 0 0 30px rgba(255,255,255,0.4);
        }
    }      .product-image {
        max-height: 92%;
        max-width: 85%;
        width: auto;
        height: auto;
        object-fit: contain;
        object-position: center;
        border-radius: 20px;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 2; /* Giảm z-index để không đè lên header */
        filter: drop-shadow(0 15px 35px rgba(0,0,0,0.12));
        background: linear-gradient(145deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%);
        padding: 20px;
        backdrop-filter: blur(15px);
        box-shadow: 
            0 8px 32px rgba(0,0,0,0.08),
            inset 0 1px 0 rgba(255,255,255,0.8);
        border: 2px solid rgba(255,255,255,0.6);
    }      .product-image:hover {
        transform: scale(1.05) rotate(1deg);
        filter: drop-shadow(0 18px 40px rgba(0,0,0,0.15));
        background: linear-gradient(145deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.9) 100%);
        box-shadow: 
            0 10px 35px rgba(0,0,0,0.1),
            inset 0 1px 0 rgba(255,255,255,0.9);
        border-color: rgba(255,255,255,0.8);
    }
    
    .price-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .specs-card {
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border-radius: 15px;
        overflow: hidden;
    }
    
    .spec-item {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease;
    }
    
    .spec-item:hover {
        background-color: #f8f9fa;
    }
    
    .spec-item:last-child {
        border-bottom: none;
    }
    
    .related-product {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .related-product:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    
    .badge-stock {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }
    
    .badge-out-stock {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }
    
    .product-detail-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }
      .btn-add-to-cart {
        background: linear-gradient(45deg, #ff6b35, #f7931e, #ff6b35);
        background-size: 200% 100%;
        animation: gradient-shift 3s ease infinite;
        border: none;
        border-radius: 50px;
        padding: 15px 30px;
        font-weight: 700;
        font-size: 1.1rem;
        color: white;
        box-shadow: 
            0 8px 25px rgba(255, 107, 53, 0.4),
            0 0 0 0 rgba(255, 107, 53, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }
    
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .btn-add-to-cart::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s;
    }
    
    .btn-add-to-cart:hover::before {
        left: 100%;
    }
    
    .btn-add-to-cart:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 
            0 12px 35px rgba(255, 107, 53, 0.6),
            0 0 0 8px rgba(255, 107, 53, 0.1);
        animation-play-state: paused;
        background: linear-gradient(45deg, #f7931e, #ff6b35);
        color: white;
    }
    
    .btn-add-to-cart:active {
        transform: translateY(-1px) scale(0.98);
        box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
    }

    .btn-secondary-action {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        border-radius: 50px;
        padding: 12px 25px;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-secondary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        background: linear-gradient(45deg, #20c997, #28a745);
    }    @media (max-width: 768px) {
        .product-image-container {
            height: 550px;
            width: 340px;
            padding: 25px;
            border-radius: 25px;
            aspect-ratio: 9/16;
        }
        
        .product-image {
            max-height: 90%;
            max-width: 88%;
            padding: 15px;
            border-radius: 18px;
        }
        
        .product-image-container::after {
            top: 15px;
            right: 15px;
            bottom: 15px;
            left: 15px;
            border-width: 2px;
            border-radius: 20px;
        }
        
        .btn-add-to-cart, .btn-secondary-action {
            font-size: 1rem;
            padding: 12px 20px;
        }
    }
    
    @media (max-width: 576px) {
        .product-image-container {
            height: 480px;
            width: 300px;
            padding: 20px;
            border-radius: 22px;
        }
        
        .product-image {
            max-height: 92%;
            max-width: 90%;
            padding: 12px;
            border-radius: 15px;
        }
        
        .product-image-container::after {
            top: 12px;
            right: 12px;
            bottom: 12px;
            left: 12px;
            border-width: 2px;
            border-radius: 18px;
        }
        
        .product-image:hover {
            transform: scale(1.05) rotate(1deg);
        }
    }
    
    /* Color selection styles */
    .color-options {
        gap: 10px;
    }
    
    .color-option {
        position: relative;
    }
    
    .color-btn {
        border-radius: 25px;
        padding: 8px 16px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        border: 2px solid #dee2e6;
    }
    
    .color-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .btn-check:checked + .color-btn {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        border-color: #007bff;
        box-shadow: 0 5px 15px rgba(0,123,255,0.3);
    }
    
    .color-swatch {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    /* Quantity selector styles */
    .quantity-selector {
        max-width: 300px;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .quantity-btn:hover {
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        transform: scale(1.1);
    }
    
    #quantity {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    #quantity:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    
    /* Đảm bảo tất cả elements trong trang chi tiết không đè lên header */
    .container {
        position: relative;
        z-index: 1;
    }
    
    /* Sticky header protection */
    .navbar-fixed-top {
        z-index: 1050 !important;
    }
    
    /* Product page specific z-index controls */
    .product-detail-page {
        z-index: auto;
    }
    
    .product-detail-page .product-image-container {
        z-index: 1;
        isolation: isolate; /* Tạo stacking context mới */
    }
    
    .product-detail-page .product-image-container:hover {
        z-index: 2;
    }
</style>

<div class="container py-4 product-detail-page">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('phones.index') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">{{ $phone->name }}</li>
        </ol>
    </nav>    <div class="row">        <!-- Product Images -->        <div class="col-lg-6 mb-4">
            <div class="product-image-container">
                <img src="{{ $phone->detail_image_path ? asset($phone->detail_image_path) : ($phone->image_path ? asset($phone->image_path) : asset('images/default-phone.png')) }}" 
                     alt="{{ $phone->name }}" 
                     class="img-fluid product-image product-image-loading"
                     onload="this.classList.remove('product-image-loading')"
                     onerror="handleImageError(this)">
            </div>
        </div><!-- Product Info -->
        <div class="col-lg-6">
            <div class="product-detail-card">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h1 class="h2 mb-3 fw-bold">{{ $phone->name }}</h1>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-2">
                                <i class="fas fa-tag me-1"></i>{{ $phone->brand }}
                            </span>
                            <span class="text-muted">
                                <i class="fas fa-eye me-1"></i>{{ $phone->view_count }} lượt xem
                            </span>
                        </div>
                        
                        @if($phone->featured)
                        <span class="badge bg-warning text-dark mb-3 fs-6">
                            <i class="fas fa-star me-1"></i>Sản phẩm nổi bật
                        </span>
                        @endif
                    </div>

                    <!-- Price Section -->
                    <div class="price-section">
                        <div class="row align-items-center">
                            <div class="col-8">
                                @if($phone->discount_percentage > 0)
                                <div class="mb-2">
                                    <span class="h3 mb-0 fw-bold">{{ number_format($phone->price) }}₫</span>
                                    <span class="badge bg-danger ms-2 fs-6">-{{ number_format($phone->discount_percentage, 0) }}%</span>
                                </div>
                                <small class="text-white-50">
                                    <del class="fs-6">{{ number_format($phone->original_price) }}₫</del>
                                </small>
                                @else
                                <span class="h3 mb-0 fw-bold">{{ number_format($phone->price) }}₫</span>
                                @endif
                            </div>
                            <div class="col-4 text-end">
                                @if($phone->stock_quantity > 0)
                                <span class="badge-stock">
                                    <i class="fas fa-check me-1"></i>Còn hàng
                                </span>
                                @else
                                <span class="badge-out-stock">
                                    <i class="fas fa-times me-1"></i>Hết hàng
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>                    <!-- Product Options -->
                    @if($phone->stock_quantity > 0)
                        @auth
                        <!-- User đã đăng nhập - hiện form bình thường -->
                        <form action="{{ route('cart.add', $phone->id) }}" method="POST" id="productForm" class="mb-4">
                            @csrf
                            
                            <!-- Color Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-palette me-2"></i>Chọn màu sắc:
                                </label>
                                <div class="color-options d-flex flex-wrap gap-2">                                @php
                                        $availableColors = ['Trắng', 'Đen', 'Vàng'];
                                        $phoneColor = $phone->color ?? 'Trắng';
                                    @endphp@foreach($availableColors as $color)
                                    <div class="color-option">
                                        <input type="radio" class="btn-check" name="color" id="color_{{ strtolower($color) }}" 
                                               value="{{ $color }}" {{ $color == $phoneColor ? 'checked' : '' }}>                                        <label class="btn btn-outline-primary color-btn" for="color_{{ strtolower($color) }}">
                                            @if($color == 'Đen')
                                                <span class="color-swatch me-2" style="background-color: #000000; border: 2px solid #ddd;"></span>
                                            @elseif($color == 'Trắng')
                                                <span class="color-swatch me-2" style="background-color: #ffffff; border: 2px solid #333;"></span>
                                            @elseif($color == 'Vàng')
                                                <span class="color-swatch me-2" style="background-color: #ffc107; border: 2px solid #ddd;"></span>
                                            @endif
                                            {{ $color }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Quantity Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-sort-numeric-up me-2"></i>Số lượng:
                                </label>
                                <div class="quantity-selector d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="decreaseQuantity()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" id="quantity" class="form-control text-center mx-2" 
                                           value="1" min="1" max="{{ $phone->stock_quantity }}" style="width: 80px;">
                                    <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="increaseQuantity()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <span class="ms-3 text-muted">
                                        (Còn {{ $phone->stock_quantity }} sản phẩm)
                                    </span>
                                </div>
                            </div>

                            <!-- Product Actions -->
                            <div class="d-flex gap-3 mb-4">                                <!-- Nút Mua Ngay -->
                                <button type="submit" name="buy_now" value="1" class="btn btn-add-to-cart flex-fill" 
                                        title="Thêm vào giỏ hàng và chuyển thẳng đến trang thanh toán">
                                    <i class="fas fa-bolt me-2"></i>MUA NGAY - THANH TOÁN
                                </button>
                            </div>
                              
                            <!-- Secondary Actions -->
                            <div class="d-flex gap-2 mb-4">
                                <button type="submit" class="btn btn-secondary-action flex-fill">
                                    <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                                </button>
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </form>
                        @else
                        <!-- User chưa đăng nhập - hiện thông báo yêu cầu đăng nhập -->
                        <div class="alert alert-info mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle me-3 fs-4"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Cần đăng nhập để mua hàng</h6>
                                    <p class="mb-0">Để thêm sản phẩm vào giỏ hàng hoặc mua ngay, bạn cần đăng nhập tài khoản.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Color Selection (chỉ hiển thị, không thể chọn) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted">
                                <i class="fas fa-palette me-2"></i>Màu sắc có sẵn:
                            </label>
                            <div class="color-options d-flex flex-wrap gap-2">
                                @php
                                    $availableColors = ['Trắng', 'Đen', 'Vàng'];
                                @endphp
                                @foreach($availableColors as $color)
                                <div class="color-option">
                                    <span class="btn btn-outline-secondary disabled color-btn">
                                        @if($color == 'Đen')
                                            <span class="color-swatch me-2" style="background-color: #000000; border: 2px solid #ddd;"></span>
                                        @elseif($color == 'Trắng')
                                            <span class="color-swatch me-2" style="background-color: #ffffff; border: 2px solid #333;"></span>
                                        @elseif($color == 'Vàng')
                                            <span class="color-swatch me-2" style="background-color: #ffc107; border: 2px solid #ddd;"></span>
                                        @endif
                                        {{ $color }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Actions cho user chưa đăng nhập -->
                        <div class="d-flex gap-3 mb-4">
                            <a href="{{ route('login') }}?intended={{ urlencode(request()->fullUrl()) }}" 
                               class="btn btn-add-to-cart flex-fill">
                                <i class="fas fa-sign-in-alt me-2"></i>ĐĂNG NHẬP ĐỂ MUA NGAY
                            </a>
                        </div>
                          
                        <div class="d-flex gap-2 mb-4">
                            <a href="{{ route('login') }}?intended={{ urlencode(request()->fullUrl()) }}" 
                               class="btn btn-secondary-action flex-fill">
                                <i class="fas fa-cart-plus me-2"></i>Đăng nhập để thêm vào giỏ
                            </a>
                            <button type="button" class="btn btn-outline-danger" disabled>
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        @endauth
                    @else
                    <div class="d-flex gap-2 mb-4">
                        <button class="btn btn-secondary w-100" disabled>
                            <i class="fas fa-ban me-2"></i>Hết hàng
                        </button>
                        <button type="button" class="btn btn-outline-danger">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    @endif

                    <!-- Quick Info -->
                    <div class="row text-center mb-4">
                        <div class="col-4">
                            <div class="border rounded-3 p-3 bg-light">
                                <i class="fas fa-mobile-alt text-primary mb-2 d-block fs-4"></i>
                                <small class="fw-bold">{{ $phone->screen_size }}</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded-3 p-3 bg-light">
                                <i class="fas fa-memory text-primary mb-2 d-block fs-4"></i>
                                <small class="fw-bold">{{ $phone->ram }}</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded-3 p-3 bg-light">
                                <i class="fas fa-battery-full text-primary mb-2 d-block fs-4"></i>
                                <small class="fw-bold">{{ $phone->battery }}</small>
                            </div>
                        </div>
                    </div>                    <!-- Warranty & Support -->
                    <div class="alert alert-info border-0 rounded-3 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt me-3 text-primary fs-4"></i>
                            <div>
                                <strong>Bảo hành:</strong> {{ $phone->warranty_period }}<br>
                                <small>Miễn phí giao hàng toàn quốc</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Special Offers -->
                    <div class="alert alert-warning border-0 rounded-3" style="background: linear-gradient(45deg, #ffc107, #ffeb3b); border: none;">
                        <div class="text-center">
                            <h6 class="fw-bold text-dark mb-2">
                                <i class="fas fa-gift me-2"></i>ƯU ĐÃI ĐẶC BIỆT
                            </h6>
                            <div class="row text-dark">
                                <div class="col-6">
                                    <small><i class="fas fa-check-circle me-1 text-success"></i>Trả góp 0%</small>
                                </div>
                                <div class="col-6">
                                    <small><i class="fas fa-check-circle me-1 text-success"></i>Đổi cũ lấy mới</small>
                                </div>
                                <div class="col-6">
                                    <small><i class="fas fa-check-circle me-1 text-success"></i>Bảo hiểm rơi vỡ</small>
                                </div>
                                <div class="col-6">
                                    <small><i class="fas fa-check-circle me-1 text-success"></i>Giao hàng 2h</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="row mt-5">
        <div class="col-12">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" 
                            data-bs-target="#description" type="button" role="tab">
                        <i class="fas fa-info-circle me-2"></i>Mô tả sản phẩm
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specs-tab" data-bs-toggle="tab" 
                            data-bs-target="#specs" type="button" role="tab">
                        <i class="fas fa-cogs me-2"></i>Thông số kỹ thuật
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" 
                            data-bs-target="#reviews" type="button" role="tab">
                        <i class="fas fa-star me-2"></i>Đánh giá
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4" id="productTabsContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="specs-card card">
                        <div class="card-body">
                            <h5 class="card-title">Mô tả sản phẩm</h5>
                            <p class="card-text">{{ $phone->description }}</p>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h6>Thông tin cơ bản:</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Model:</strong> {{ $phone->model }}</li>
                                        <li><strong>Màu sắc:</strong> {{ $phone->color }}</li>
                                        <li><strong>Bộ nhớ:</strong> {{ $phone->storage }}</li>
                                        <li><strong>Tình trạng:</strong> {{ ucfirst($phone->condition) }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Chi tiết khác:</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Trọng lượng:</strong> {{ $phone->weight }}g</li>
                                        <li><strong>SKU:</strong> {{ $phone->sku }}</li>
                                        <li><strong>Ngày phát hành:</strong> {{ \Carbon\Carbon::parse($phone->released_at)->format('d/m/Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div class="tab-pane fade" id="specs" role="tabpanel">
                    <div class="specs-card card">
                        <div class="card-body">
                            <h5 class="card-title">Thông số kỹ thuật chi tiết</h5>
                            @if($phone->specifications)
                                @php $specs = json_decode($phone->specifications, true); @endphp
                                @foreach($specs as $key => $value)
                                <div class="spec-item d-flex justify-content-between">
                                    <span class="fw-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                    <span>{{ $value }}</span>
                                </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="spec-item d-flex justify-content-between">
                                            <span class="fw-semibold">Màn hình:</span>
                                            <span>{{ $phone->screen_size }}</span>
                                        </div>
                                        <div class="spec-item d-flex justify-content-between">
                                            <span class="fw-semibold">Camera:</span>
                                            <span>{{ $phone->camera }}</span>
                                        </div>
                                        <div class="spec-item d-flex justify-content-between">
                                            <span class="fw-semibold">Pin:</span>
                                            <span>{{ $phone->battery }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="spec-item d-flex justify-content-between">
                                            <span class="fw-semibold">Bộ xử lý:</span>
                                            <span>{{ $phone->processor }}</span>
                                        </div>
                                        <div class="spec-item d-flex justify-content-between">
                                            <span class="fw-semibold">RAM:</span>
                                            <span>{{ $phone->ram }}</span>
                                        </div>
                                        <div class="spec-item d-flex justify-content-between">
                                            <span class="fw-semibold">Hệ điều hành:</span>
                                            <span>{{ $phone->operating_system }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="specs-card card">
                        <div class="card-body">
                            <h5 class="card-title">Đánh giá sản phẩm</h5>
                            <p class="text-muted">Chức năng đánh giá sẽ được cập nhật trong phiên bản tiếp theo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedPhones->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Sản phẩm liên quan</h3>
            <div class="row">
                @foreach($relatedPhones as $relatedPhone)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card related-product h-100">
                        <img src="{{ $relatedPhone->image_path ? asset($relatedPhone->image_path) : asset('images/default-phone.png') }}" 
                             class="card-img-top" alt="{{ $relatedPhone->name }}" style="height: 200px; object-fit: contain;">
                        <div class="card-body">
                            <h6 class="card-title">{{ \Str::limit($relatedPhone->name, 30) }}</h6>
                            <p class="text-muted small mb-2">{{ $relatedPhone->brand }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">{{ number_format($relatedPhone->price) }}đ</span>
                                <a href="{{ route('phones.show', $relatedPhone) }}" class="btn btn-outline-primary btn-sm">
                                    Xem
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>    @endif
</div>

<script>
// Function to handle image loading errors
function handleImageError(img) {
    img.src = '/images/default-phone.png';
    img.classList.remove('product-image-loading');
}

document.addEventListener('DOMContentLoaded', function() {
    // Optimize image loading
    const productImage = document.querySelector('.product-image');
    
    if (productImage) {
        // Add intersection observer for lazy loading effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'scale(1)';
                }
            });
        });
        
        observer.observe(productImage);
        
        // Image load success
        productImage.addEventListener('load', function() {
            this.classList.remove('product-image-loading');
        });
    }
    
    // Smooth scroll for related products
    const relatedProductLinks = document.querySelectorAll('.related-product a');
    relatedProductLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang tải...';
        });
    });
});

// Quantity selector functions
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.getAttribute('max'));
    
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
        updateQuantityDisplay();
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const minValue = parseInt(quantityInput.getAttribute('min'));
    
    if (currentValue > minValue) {
        quantityInput.value = currentValue - 1;
        updateQuantityDisplay();
    }
}

function updateQuantityDisplay() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.getAttribute('max'));
    
    // Update button states
    const decreaseBtn = document.querySelector('.quantity-btn[onclick="decreaseQuantity()"]');
    const increaseBtn = document.querySelector('.quantity-btn[onclick="increaseQuantity()"]');
    
    if (decreaseBtn) {
        decreaseBtn.disabled = currentValue <= 1;
    }
    
    if (increaseBtn) {
        increaseBtn.disabled = currentValue >= maxValue;
    }
}

// Form validation
function validateForm() {
    const quantityInput = document.getElementById('quantity');
    const selectedColor = document.querySelector('input[name="color"]:checked');
    
    if (!selectedColor) {
        alert('Vui lòng chọn màu sắc!');
        return false;
    }
    
    const quantity = parseInt(quantityInput.value);
    const maxQuantity = parseInt(quantityInput.getAttribute('max'));
    
    if (quantity < 1 || quantity > maxQuantity) {
        alert(`Số lượng phải từ 1 đến ${maxQuantity}!`);
        return false;
    }
    
    return true;
}

// Enhanced Buy Now button functionality
document.addEventListener('DOMContentLoaded', function() {
    const buyNowBtn = document.querySelector('button[name="buy_now"]');
    const productForm = document.getElementById('productForm');
    
    // Simple validation for form submit
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    }
    
    // Initialize quantity display
    updateQuantityDisplay();
    
    // Add quantity input event listener
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantityInput.addEventListener('input', function() {
            updateQuantityDisplay();
        });
    }
});
</script>
@endsection