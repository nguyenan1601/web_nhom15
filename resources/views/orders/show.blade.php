@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->order_number)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Chi tiết đơn hàng #{{ $order->order_number }}</h2>
                    <p class="text-muted">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <span class="badge 
                        @if($order->status == 'pending') badge-warning
                        @elseif($order->status == 'confirmed') badge-primary
                        @elseif($order->status == 'shipped') badge-info
                        @elseif($order->status == 'delivered') badge-success
                        @elseif($order->status == 'cancelled') badge-danger
                        @else badge-secondary
                        @endif fs-6 px-3 py-2">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <div class="row">
                <!-- Thông tin đơn hàng -->
                <div class="col-12 col-md-8">
                    <!-- Sản phẩm -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-box me-2"></i>Sản phẩm đã đặt</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-end">Đơn giá</th>
                                            <th class="text-end">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->phone && $item->phone->image_path)
                                                    <img src="{{ asset('storage/' . $item->phone->image_path) }}" 
                                                         alt="{{ $item->phone_name }}" 
                                                         class="me-3 rounded"
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                    <div class="me-3 bg-light rounded d-flex align-items-center justify-content-center"
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-mobile-alt text-muted"></i>
                                                    </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $item->phone_name }}</h6>
                                                        @if($item->phone_color)
                                                        <small class="text-muted">Màu: {{ $item->phone_color }}</small>
                                                        @endif
                                                        @if($item->phone_storage)
                                                        <br><small class="text-muted">Bộ nhớ: {{ $item->phone_storage }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($item->unit_price, 0, ',', '.') }}đ
                                            </td>
                                            <td class="text-end fw-bold">
                                                {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}đ
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin giao hàng -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>Thông tin giao hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">                                    <h6 class="text-muted mb-2">Người nhận</h6>
                                    <p class="mb-1">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</p>
                                    <p class="mb-1">{{ $order->shipping_phone }}</p>
                                    <p class="mb-0">{{ $order->shipping_email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Địa chỉ giao hàng</h6>
                                    <p class="mb-0">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                            @if($order->notes)
                            <div class="mt-3">
                                <h6 class="text-muted mb-2">Ghi chú</h6>
                                <p class="mb-0">{{ $order->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tóm tắt đơn hàng -->
                <div class="col-12 col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-calculator me-2"></i>Tóm tắt đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span>{{ number_format($order->subtotal, 0, ',', '.') }}đ</span>
                            </div>
                            @if($order->discount_amount > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Giảm giá:</span>
                                <span class="text-success">-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</span>
                            </div>
                            @endif
                            @if($order->tax_amount > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Thuế:</span>
                                <span>{{ number_format($order->tax_amount, 0, ',', '.') }}đ</span>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span>{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</span>
                            </div>
                            <hr>                            <div class="d-flex justify-content-between fs-5 fw-bold">
                                <span>Tổng cộng:</span>
                                <span class="text-primary">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hành động -->
                    <div class="card mt-3 shadow-sm">
                        <div class="card-body">
                            @if($order->status == 'pending')
                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                                <i class="fas fa-times me-2"></i>Hủy đơn hàng
                            </button>
                            @endif
                            
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal hủy đơn hàng -->
@if($order->status == 'pending')
<div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelOrderModalLabel">Xác nhận hủy đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn hủy đơn hàng <strong>#{{ $order->order_number }}</strong>?</p>
                <p class="text-muted">Sau khi hủy, bạn sẽ không thể khôi phục lại đơn hàng này.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.badge {
    font-size: 0.8em;
}

.table th {
    font-weight: 600;
    color: #6c757d;
    border-bottom: 2px solid #dee2e6;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border-bottom: 1px solid #e3e6f0;
}

.table-responsive {
    border-radius: 0 0 12px 12px;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.text-primary {
    color: #007bff !important;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>
@endsection
