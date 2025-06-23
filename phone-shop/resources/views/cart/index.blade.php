@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<style>
.cart-table {
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.cart-table th,
.cart-table td {
    vertical-align: middle !important;
}

.cart-table th:first-child,
.cart-table td:first-child {
    text-align: left;
}

.cart-table th:not(:first-child),
.cart-table td:not(:first-child) {
    text-align: center;
}

.cart-total-row {
    background: #f8f9fa;
}

.btn-delete {
    color: #fff;
    background: #dc3545;
    border: none;
    transition: all 0.3s ease;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 0.875rem;
}

.btn-delete:hover {
    background: #bb2d3b;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

.empty-cart-illustration {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

/* Quantity badge styling */
.badge.fs-6 {
    font-size: 1rem !important;
    min-width: 50px;
    border-radius: 20px;
}

/* Product link styling */
.product-link {
    color: #333 !important;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.product-link:hover {
    color: #007bff !important;
    text-decoration: none !important;
}

.product-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: #007bff;
    transition: width 0.3s ease;
}

.product-link:hover::after {
    width: 100%;
}
</style>
<div class="container my-4">
    <h1 class="mb-4 text-center">🛒 Giỏ hàng của bạn</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(count($cart) > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle cart-table">            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>                @foreach($cart as $id => $item)                <tr>
                    <td class="align-middle">
                        @if(isset($item['id']))
                        <div class="fw-semibold">
                            <a href="{{ route('phones.show', $item['id']) }}" class="text-decoration-none text-dark product-link">
                                {{ $item['name'] }}
                            </a>
                        </div>
                        @else
                        <div class="fw-semibold">{{ $item['name'] }}</div>
                        @endif
                        @if(isset($item['color']))
                        <small class="text-muted">
                            <i class="fas fa-palette me-1"></i>Màu: {{ $item['color'] }}
                        </small>
                        @endif
                    </td>
                    <td class="align-middle text-primary fw-bold">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                    <td class="align-middle text-center">
                        <span class="badge bg-secondary fs-6 px-3 py-2">{{ $item['quantity'] }}</span>
                    </td>
                    <td class="align-middle fw-semibold">
                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                    <td class="align-middle">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-sm" title="Xoá">
                                <i class="bi bi-trash"></i> Xoá
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach                <tr class="cart-total-row">
                    <td colspan="3" class="text-end fw-bold fs-5">Tổng cộng:</td>
                    <td class="fw-bold fs-5 text-danger">{{ number_format($total, 0, ',', '.') }}đ</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>    <div class="d-flex justify-content-end mt-3 gap-2">
        <a href="{{ route('phones.index') }}" class="btn btn-success me-2">
            <i class="bi bi-arrow-left-circle"></i> Tiếp tục mua hàng
        </a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">
            <i class="bi bi-credit-card"></i> Thanh toán
        </a>
    </div>
    @else
    <div class="text-center py-5">
        <div class="empty-cart-illustration">🛒</div>
        <p class="fs-5 mb-3">Giỏ hàng của bạn đang trống.</p>
        <a href="{{ route('phones.index') }}" class="btn btn-primary">
            <i class="bi bi-bag-plus"></i> Mua sắm ngay
        </a>
    </div>
    @endif
</div>
@endsection