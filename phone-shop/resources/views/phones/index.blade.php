@extends('layouts.app')

@section('title', 'Danh Sách Sản Phẩm - PhoneShop')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sản phẩm</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2 mb-1">Danh Sách Sản Phẩm</h1>
            <p class="text-muted">Tìm thấy {{ $phones->total() }} sản phẩm</p>
        </div>
        <div class="col-md-4 text-md-end">
            <!-- Sort Options -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-sort me-1"></i>Sắp xếp
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'featured']) }}">
                            <i class="fas fa-star me-2"></i>Nổi bật
                        </a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">
                            <i class="fas fa-clock me-2"></i>Mới nhất
                        </a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">
                            <i class="fas fa-sort-amount-up me-2"></i>Giá thấp → cao
                        </a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">
                            <i class="fas fa-sort-amount-down me-2"></i>Giá cao → thấp
                        </a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">
                            <i class="fas fa-fire me-2"></i>Phổ biến
                        </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4" style="z-index: 0">
            <div class="card sticky-top" style="top: 100px;">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Bộ Lọc</h6>
                </div>
                <div class="card-body">
                    <!-- Price Filter -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Khoảng giá</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control form-control-sm" placeholder="Từ"
                                    id="min_price" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control form-control-sm" placeholder="Đến"
                                    id="max_price" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mt-2 w-100" onclick="applyPriceFilter()">
                            Áp dụng
                        </button>
                    </div>

                    <!-- Brand Filter -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Thương hiệu</h6>
                        @foreach($brands as $brand)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="brand" id="brand{{ $brand->id }}"
                                value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'checked' : '' }}
                                onchange="applyBrandFilter({{ $brand->id }})">
                            <label class="form-check-label" for="brand{{ $brand->id }}">
                                {{ $brand->name }} ({{ $brand->phones_count ?? 0 }})
                            </label>
                        </div>
                        @endforeach
                        @if(request('brand'))
                        <button type="button" class="btn btn-outline-secondary btn-sm mt-2"
                            onclick="clearBrandFilter()">
                            Xóa bộ lọc
                        </button>
                        @endif
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Danh mục</h6>
                        @foreach($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category"
                                id="category{{ $category->id }}" value="{{ $category->id }}"
                                {{ request('category') ==$category->id ? 'checked' : '' }}
                                onchange="applyCategoryFilter({{ $category->id }})">
                            <label class="form-check-label" for="category{{ $category->id }}">
                                {{ $category->name }} ({{ $category->phones_count ?? 0 }})
                            </label>
                        </div>
                        @endforeach
                        @if(request('category'))
                        <button type="button" class="btn btn-outline-secondary btn-sm mt-2"
                            onclick="clearCategoryFilter()">
                            Xóa bộ lọc
                        </button>
                        @endif
                    </div>

                    <!-- Clear All Filters -->
                    @if(request()->hasAny(['brand', 'category', 'min_price', 'max_price']))
                    <div class="d-grid">
                        <a href="{{ route('phones.index') }}" class="btn btn-outline-danger">
                            <i class="fas fa-times me-1"></i>Xóa tất cả bộ lọc
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            @if($phones->count() > 0)
            <div class="row">
                @foreach($phones as $phone)
                <div class="col-6 col-md-4 col-xl-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <img src="images\Xiaomi 14 Ultra crop.png" class="card-img-top product-image"
                                alt="{{ $phone->name }}">

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
                            <h6 class="card-title">{{ \Str::limit($phone->name, 30) }}</h6>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i>{{ $phone->brand->name ?? $phone->brand }}
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex align-items-center mb-2">
                                    @if($phone->discount_percentage > 0)
                                    <div class="d-flex flex-column">
                                        <span
                                            class="price-original small">{{ number_format($phone->original_price) }}₫</span>
                                        <span
                                            class="price-discounted">{{ number_format($phone->discounted_price) }}₫</span>
                                    </div>
                                    @else
                                    <span class="fw-bold text-primary">{{ number_format($phone->price) }}₫</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>{{ $phone->view_count }}
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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $phones->appends(request()->query())->links() }}
            </div>
            @else
            <!-- No Products Found -->
            <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4>Không tìm thấy sản phẩm</h4>
                <p class="text-muted mb-4">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm</p>
                <a href="{{ route('phones.index') }}" class="btn btn-primary">
                    <i class="fas fa-refresh me-1"></i>Xem tất cả sản phẩm
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function applyPriceFilter() {
    const minPrice = document.getElementById('min_price').value;
    const maxPrice = document.getElementById('max_price').value;

    const url = new URL(window.location);
    if (minPrice) url.searchParams.set('min_price', minPrice);
    else url.searchParams.delete('min_price');

    if (maxPrice) url.searchParams.set('max_price', maxPrice);
    else url.searchParams.delete('max_price');

    window.location.href = url.toString();
}

function applyBrandFilter(brandId) {
    const url = new URL(window.location);
    url.searchParams.set('brand', brandId);
    window.location.href = url.toString();
}

function clearBrandFilter() {
    const url = new URL(window.location);
    url.searchParams.delete('brand');
    window.location.href = url.toString();
}

function applyCategoryFilter(categoryId) {
    const url = new URL(window.location);
    url.searchParams.set('category', categoryId);
    window.location.href = url.toString();
}

function clearCategoryFilter() {
    const url = new URL(window.location);
    url.searchParams.delete('category');
    window.location.href = url.toString();
}
</script>
@endpush
@endsection