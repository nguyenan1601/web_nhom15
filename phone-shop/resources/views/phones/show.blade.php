@extends('layouts.app')

@section('title', $phone->name . ' - PhoneShop')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('phones.index') }}">Sản phẩm</a></li>
            <li class="breadcrumb-item active">{{ $phone->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail Section -->
    <div class="row mb-5">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <!-- Main Image -->
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/phones/' . \Illuminate\Support\Str::slug($phone->name) . '.jpg') }}" 
                             alt="{{ $phone->name }}" 
                             class="img-fluid rounded" 
                             style="max-height: 400px; object-fit: contain;">
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="row g-2">
                        @for($i = 1; $i <= 3; $i++)
                            <div class="col-4">
                                <a href="#" class="d-block border rounded p-1">
                                    <img src="{{ asset('images/phones/' . \Illuminate\Support\Str::slug($phone->name) . '-' . $i . '.jpg') }}" 
                                         alt="{{ $phone->name }} - {{ $i }}" 
                                         class="img-fluid" 
                                         style="height: 80px; object-fit: contain;">
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Brand & Status -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary">{{ $phone->brand->name }}</span>
                        @if($phone->discount_percentage > 0)
                            <span class="badge bg-danger">-{{ number_format($phone->discount_percentage, 0) }}%</span>
                        @endif
                    </div>
                    
                    <!-- Product Name -->
                    <h1 class="h3 mb-2">{{ $phone->name }}</h1>
                    
                    <!-- Model & SKU -->
                    <p class="text-muted small mb-3">
                        <span class="me-3"><i class="fas fa-box me-1"></i>Model: {{ $phone->model }}</span>
                        <span><i class="fas fa-barcode me-1"></i>SKU: {{ $phone->sku }}</span>
                    </p>
                    
                    <!-- Price Section -->
                    <div class="mb-4">
                        @if($phone->discount_percentage > 0)
                            <div class="d-flex align-items-center">
                                <span class="h3 fw-bold text-danger me-3">{{ number_format($phone->price) }}₫</span>
                                <span class="text-decoration-line-through text-muted">{{ number_format($phone->original_price) }}₫</span>
                            </div>
                        @else
                            <span class="h3 fw-bold text-primary">{{ number_format($phone->price) }}₫</span>
                        @endif
                    </div>
                    
                    <!-- Color Options -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Màu sắc:</h6>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary active">{{ $phone->color }}</button>
                        </div>
                    </div>
                    
                    <!-- Storage Options -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Dung lượng:</h6>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary active">{{ $phone->storage }}</button>
                        </div>
                    </div>
                    
                    <!-- Quantity & Add to Cart -->
                    <div class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <h6 class="fw-bold mb-0">Số lượng:</h6>
                            </div>
                            <div class="col-4">
                                <input type="number" class="form-control" value="1" min="1" max="{{ $phone->stock_quantity }}">
                            </div>
                            <div class="col">
                                <button class="btn btn-primary w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Highlights -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Đặc điểm nổi bật:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Màn hình {{ $phone->screen_size }}</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Camera {{ $phone->camera }}</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Pin {{ $phone->battery }}</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>{{ $phone->ram }} RAM</li>
                        </ul>
                    </div>
                    
                    <!-- Warranty & Shipping -->
                    <div class="d-flex flex-wrap gap-3 small text-muted">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt me-2"></i>Bảo hành: {{ $phone->warranty_period }}
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-truck me-2"></i>Miễn phí vận chuyển đơn từ 500k
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                                <i class="fas fa-file-alt me-2"></i>Mô tả sản phẩm
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">
                                <i class="fas fa-list-ul me-2"></i>Thông số kỹ thuật
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-4" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            {!! nl2br(e($phone->description)) !!}
                        </div>
                        
                        <!-- Specifications Tab -->
                        <div class="tab-pane fade" id="specs" role="tabpanel">
                            @php
                                $specs = json_decode($phone->specifications, true);
                            @endphp
                            
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach($specs as $key => $value)
                                        <tr>
                                            <th width="30%">{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedPhones->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="fw-bold mb-4">Sản phẩm cùng thương hiệu</h3>
            </div>
            
            @foreach($relatedPhones as $relatedPhone)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <img src="{{ asset('images/phones/' . \Illuminate\Support\Str::slug($relatedPhone->name) . '.jpg') }}" 
                                 class="card-img-top product-image" 
                                 alt="{{ $relatedPhone->name }}"
                                 style="height: 180px; object-fit: contain;">
                            
                            @if($relatedPhone->discount_percentage > 0)
                                <span class="discount-badge">-{{ number_format($relatedPhone->discount_percentage, 0) }}%</span>
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title">{{ \Str::limit($relatedPhone->name, 30) }}</h6>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-tag me-1"></i>{{ $relatedPhone->brand->name }}
                            </p>
                            
                            <div class="mt-auto">
                                <div class="d-flex align-items-center mb-2">
                                    @if($relatedPhone->discount_percentage > 0)
                                        <div class="d-flex flex-column">
                                            <span class="price-original small">{{ number_format($relatedPhone->original_price) }}₫</span>
                                            <span class="price-discounted">{{ number_format($relatedPhone->price) }}₫</span>
                                        </div>
                                    @else
                                        <span class="fw-bold text-primary">{{ number_format($relatedPhone->price) }}₫</span>
                                    @endif
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>{{ $relatedPhone->view_count }}
                                    </small>
                                    <a href="{{ route('phones.show', $relatedPhone) }}" class="btn btn-primary btn-sm">
                                        Chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script>
// Product image gallery functionality
document.addEventListener('DOMContentLoaded', function() {
    // Change main image when thumbnail is clicked
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('.main-product-image');
    
    if (thumbnails.length && mainImage) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function(e) {
                e.preventDefault();
                const newSrc = this.getAttribute('data-full-image');
                mainImage.setAttribute('src', newSrc);
                
                // Update active class
                thumbnails.forEach(t => t.parentElement.classList.remove('active'));
                this.parentElement.classList.add('active');
            });
        });
    }
});
</script>
@endpush

<style>
.product-image {
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

.nav-tabs .nav-link {
    border: none;
    color: #495057;
    font-weight: 500;
    padding: 12px 20px;
}

.nav-tabs .nav-link.active {
    color: var(--primary-color);
    border-bottom: 3px solid var(--primary-color);
    background: transparent;
}

.tab-content {
    min-height: 200px;
}

.price-original {
    text-decoration: line-through;
    color: var(--secondary-color);
}

.price-discounted {
    color: var(--danger-color);
    font-weight: 600;
}

.discount-badge {
    background: var(--danger-color);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.thumbnail {
    cursor: pointer;
    transition: all 0.3s ease;
}

.thumbnail:hover {
    opacity: 0.8;
}

.thumbnail.active {
    border-color: var(--primary-color) !important;
}
</style>
@endsection