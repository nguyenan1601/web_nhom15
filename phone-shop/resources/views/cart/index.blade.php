@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>

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
        <table class="table table-hover align-middle">
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
                    <td class="align-middle">{{ $item['name'] }}</td>
                    <td class="align-middle">
                        @if($item['image'])
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                            class="img-thumbnail" style="max-width: 100px;">
                        @else
                        <span class="text-muted">Không có hình ảnh</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                    <td class="align-middle">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                class="form-control me-2" style="width: 80px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Cập nhật</button>
                        </form>
                    </td>
                    <td class="align-middle">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                    <td class="align-middle">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Xoá</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end fw-bold fs-5">Tổng cộng:</td>
                    <td colspan="2" class="fw-bold fs-5">{{ number_format($total, 0, ',', '.') }}đ</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('phones.index') }}" class="btn btn-success me-2">Tiếp tục mua hàng</a>
        <a href="#" class="btn btn-primary">Thanh toán</a>
    </div>
    @else
    <p class="text-center fs-5">Giỏ hàng của bạn đang trống.</p>
    <div class="text-center mt-4">
        <a href="{{ route('phones.index') }}" class="btn btn-primary">Mua sắm ngay</a>
    </div>
    @endif
</div>
@endsection