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
    text-align: center;
}

.cart-table img {
    border-radius: 50%;
    transition: transform 0.2s;
}

.cart-table img:hover {
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.cart-total-row {
    background: #f8f9fa;
}

.btn-update {
    color: #fff;
    background: #0d6efd;
    border: none;
    transition: background 0.2s;
}

.btn-update:hover {
    background: #0b5ed7;
}

.btn-delete {
    color: #fff;
    background: #dc3545;
    border: none;
    transition: background 0.2s;
}

.btn-delete:hover {
    background: #bb2d3b;
}

.empty-cart-illustration {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
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
        <table class="table table-hover align-middle cart-table">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td class="align-middle fw-semibold">{{ $item['name'] }}</td>
                    <td class="align-middle">
                        @if($item['image'])
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                            class="img-thumbnail" style="max-width: 80px;">
                        @else
                        <span class="text-muted">Không có hình ảnh</span>
                        @endif
                    </td>
                    <td class="align-middle text-primary fw-bold">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                    <td class="align-middle">
                        <form action="{{ route('cart.update', $id) }}" method="POST"
                            class="d-flex align-items-center justify-content-center gap-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                class="form-control me-2 text-center" style="width: 80px;">
                            <button type="submit" class="btn btn-update btn-sm" title="Cập nhật">
                                <i class="bi bi-arrow-repeat"></i> Cập nhật
                            </button>
                        </form>
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
                @endforeach
                <tr class="cart-total-row">
                    <td colspan="4" class="text-end fw-bold fs-5">Tổng cộng:</td>
                    <td colspan="2" class="fw-bold fs-5 text-danger">{{ number_format($total, 0, ',', '.') }}đ</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-3 gap-2">
        <a href="{{ route('phones.index') }}" class="btn btn-success me-2">
            <i class="bi bi-arrow-left-circle"></i> Tiếp tục mua hàng
        </a>
        <a href="#" class="btn btn-primary">
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