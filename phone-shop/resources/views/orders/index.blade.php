@extends('layouts.app')

@section('title', 'Danh sách đơn hàng')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Danh sách đơn hàng</h1>

    @foreach ($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>Đơn hàng #{{ $order->order_number }}</strong> - Trạng thái: {{ ucfirst($order->status) }}
            </div>
            <div class="card-body">
                <p><strong>Khách hàng:</strong> {{ $order->customer_id ?? 'Không rõ' }}</p>
                <p><strong>Tạm tính:</strong> {{ number_format($order->subtotal, 0, ',', '.') }}đ</p>
                <p><strong>Thuế:</strong> {{ number_format($order->tax_amount, 0, ',', '.') }}đ</p>
                <p><strong>Phí vận chuyển:</strong> {{ number_format($order->shipping_fee, 0, ',', '.') }}đ</p>
                <p><strong>Giảm giá:</strong> {{ number_format($order->discount_amount, 0, ',', '.') }}đ</p>
                <p><strong>Tổng cộng:</strong> {{ number_format($order->total, 0, ',', '.') }}đ</p>

                <h5 class="mt-4">Sản phẩm:</h5>
                <ul class="list-group">
                    @foreach ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <div><strong>{{ $item->phone_name }}</strong></div>
                                <div>Màu: {{ $item->phone_color ?? 'N/A' }}, Bộ nhớ: {{ $item->phone_storage ?? 'N/A' }}</div>
                                <div>SKU: {{ $item->phone_sku ?? 'N/A' }}</div>
                            </div>
                            <div>
                                <div>SL: {{ $item->quantity }}</div>
                                <div>Đơn giá: {{ number_format($item->unit_price, 0, ',', '.') }}đ</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
