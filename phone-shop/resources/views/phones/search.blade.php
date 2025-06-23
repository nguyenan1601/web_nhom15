@extends('layouts.app')

@section('title', 'Tìm kiếm sản phẩm - PhoneShop')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Kết quả tìm kiếm</h2>
    <form method="GET" action="{{ route('search') }}" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="q" class="form-control" placeholder="Từ khóa..." value="{{ $query ?? '' }}">
            </div>
            <div class="col-md-2">
                <select name="brand" class="form-select">
                    <option value="">-- Thương hiệu --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if(isset($brandId) && $brandId == $brand->id) selected @endif>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="category" class="form-select">
                    <option value="">-- Danh mục --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($categoryId) && $categoryId == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="Giá từ" value="{{ $minPrice ?? '' }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="Đến" value="{{ $maxPrice ?? '' }}">
            </div>
            <div class="col-12 col-md-auto mt-2 mt-md-0">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i>Tìm kiếm</button>
            </div>
        </div>
    </form>

    @if($phones->count() > 0)
    <div class="row">
        @foreach($phones as $phone)
        <div class="col-6 col-md-4 col-xl-3 mb-4">
            <div class="card product-card h-100">
                <a href="{{ route('phones.show', $phone) }}">
                    <img src="{{ $phone->image_path ?? asset('images/phones/default.jpg') }}" class="product-image">
                </a>    
                <div class="card-body">
                    <h5 class="card-title mb-1">
                        <a href="{{ route('phones.show', $phone) }}" class="text-decoration-none text-dark">
                            {{ $phone->name }}
                        </a>
                    </h5>
                    <div class="mb-2 text-muted" style="font-size: 0.95em;">
                        {{ $phone->brand->name ?? $phone->brand }}
                    </div>
                    <div class="price-section mb-2">
                        @if($phone->discount_percentage > 0)
                            <span class="price-original me-2">{{ number_format($phone->original_price) }}đ</span>
                            <span class="price-discounted">{{ number_format($phone->price) }}đ</span>
                            <span class="discount-badge ms-2">-{{ $phone->discount_percentage }}%</span>
                        @else
                            <span class="price-discounted">{{ number_format($phone->price) }}đ</span>
                        @endif
                    </div>
                    <div>
                        <span class="badge bg-success">Còn {{ $phone->stock_quantity }} sp</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $phones->appends(request()->query())->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="fas fa-search fa-3x text-muted mb-3"></i>
        <h4>Không tìm thấy sản phẩm phù hợp</h4>
        <p class="text-muted mb-4">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm</p>
        <a href="{{ route('phones.index') }}" class="btn btn-primary">
            Xem tất cả sản phẩm
        </a>
    </div>
    @endif
</div>

<style>
    .product-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        object-position: center;
        background: #f8f9fa;
        border-radius: 8px 8px 0 0;
        display: block;
    }
</style>
@endsection
