<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $page_title ?? 'Cửa hàng điện thoại' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
    /* giữ nguyên CSS */
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-mobile-alt"></i> PhoneStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Trang chủ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu">
                            @if (!empty($categories))
                            @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item" href="/category/{{ $category['slug'] }}">
                                    {{ $category['name'] }}
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/about">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Liên hệ</a></li>
                </ul>
                <div class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." />
                    <button class="btn btn-outline-primary me-2" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="/cart" class="btn btn-outline-success">
                        <i class="fas fa-shopping-cart"></i> Giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <!-- giữ nguyên phần hero -->
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4 text-center">
                <div class="col-12">
                    <h2 class="fw-bold">Sản phẩm nổi bật</h2>
                    <p class="text-muted">Những sản phẩm được khách hàng yêu thích nhất</p>
                </div>
            </div>
            <div class="row">
                @if (!empty($featured_phones) && $featured_phones->count() > 0)
                @foreach ($featured_phones as $phone)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <img src="{{ $phone->image ?? '/images/default-phone.jpg' }}" class="card-img-top"
                                alt="{{ $phone->name }}" style="height: 250px; object-fit: cover;" />
                            @if (!empty($phone->discount))
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                -{{ $phone->discount }}%
                            </span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ $phone->name }}</h6>
                            <p class="text-muted small mb-2">{{ $phone->brand }}</p>
                            <div class="mt-auto">
                                <div class="price mb-2">
                                    {{ number_format($phone->price, 0, ',', '.') }}₫
                                    @if (!empty($phone->old_price))
                                    <small class="old-price ms-2">
                                        {{ number_format($phone->old_price, 0, ',', '.') }}₫
                                    </small>
                                    @endif
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="/product/{{ $phone->slug }}" class="btn btn-primary btn-sm">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12 text-center">
                    <p class="text-muted">Chưa có sản phẩm nổi bật</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Brand Section -->
    @if (!empty($brand_phones))
    <section class="brand-section">
        <div class="container">
            @foreach ($brand_phones as $brand => $phones)
            <div class="mb-5">
                <div class="row mb-4">
                    <div class="col-12">
                        <h3 class="fw-bold">{{ $brand }}</h3>
                        <p class="text-muted">Sản phẩm mới nhất từ {{ $brand }}</p>
                    </div>
                </div>
                <div class="row">
                    @foreach ($phones as $phone)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card product-card h-100">
                            <img src="{{ $phone->image ?? '/images/default-phone.jpg' }}" class="card-img-top"
                                alt="{{ $phone->name }}" style="height: 200px; object-fit: cover;" />
                            <div class="card-body">
                                <h6 class="card-title">{{ $phone->name }}</h6>
                                <div class="price">
                                    {{ number_format($phone->price, 0, ',', '.') }}₫
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="/product/{{ $phone->slug }}" class="btn btn-outline-primary btn-sm">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Latest Products -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4 text-center">
                <div class="col-12">
                    <h2 class="fw-bold">Sản phẩm mới nhất</h2>
                    <p class="text-muted">Cập nhật những mẫu điện thoại mới nhất</p>
                </div>
            </div>
            <div class="row">
                @if (!empty($latest_phones) && $latest_phones->count() > 0)
                @foreach ($latest_phones as $phone)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <img src="{{ $phone->image ?? '/images/default-phone.jpg' }}" class="card-img-top"
                            alt="{{ $phone->name }}" style="height: 250px; object-fit: cover;" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $phone->name }}</h5>
                            <p class="text-muted">{{ $phone->brand }}</p>
                            <div class="price mb-3">
                                {{ number_format($phone->price, 0, ',', '.') }}₫
                            </div>
                            <a href="/product/{{ $phone->slug }}" class="btn btn-primary">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-mobile-alt"></i> PhoneStore</h5>
                    <p>Cửa hàng điện thoại uy tín, chất lượng cao với giá cả hợp lý. Bảo hành chính hãng, giao hàng toàn
                        quốc.
                    </p>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Liên kết</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white-50">Trang chủ</a></li>
                        <li><a href="/products" class="text-white-50">Sản phẩm</a></li>
                        <li><a href="/about" class="text-white-50">Giới thiệu</a></li>
                        <li><a href="/contact" class="text-white-50">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Thương hiệu</h6>
                    <ul class="list-unstyled">
                        @if (!empty($brands))
                        @foreach ($brands->take(6) as $brand)
                        <li><a href="/brand/{{ strtolower($brand) }}" class="text-white-50">{{ $brand }}</a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Liên hệ</h6>
                    <p class="text-white-50">
                        <i class="fas fa-phone"></i> 0123 456 789<br />
                        <i class="fas fa-envelope"></i> info@phonestore.com<br />
                        <i class="fas fa-map-marker-alt"></i> 123 Đường ABC, Hà Nội
                    </p>
                </div>
            </div>
            <hr class="my-4" />
            <div class="text-center">
                <p>&copy; 2024 PhoneStore. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>