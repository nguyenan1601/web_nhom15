@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Tài khoản</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-edit me-2"></i>Thông tin cá nhân
                        </a>
                        <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action active">
                            <i class="fas fa-shopping-bag me-2"></i>Đơn hàng của tôi
                        </a>
                        <a href="{{ route('cart.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-shopping-cart me-2"></i>Giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nội dung chính -->
        <div class="col-12 col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-shopping-bag me-2"></i>Đơn hàng của tôi</h2>
                <div class="d-flex gap-2">
                    <!-- Lọc theo trạng thái -->
                    <select class="form-select form-select-sm" id="statusFilter" style="width: auto;">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="shipped">Đang vận chuyển</option>
                        <option value="delivered">Đã giao hàng</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                    
                    <!-- Sắp xếp -->
                    <select class="form-select form-select-sm" id="sortOrder" style="width: auto;">
                        <option value="latest">Mới nhất</option>
                        <option value="oldest">Cũ nhất</option>
                        <option value="total_desc">Giá cao nhất</option>
                        <option value="total_asc">Giá thấp nhất</option>
                    </select>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($orders->count() > 0)
                <div id="ordersContainer">
                    @foreach ($orders as $order)
                    <div class="card mb-4 shadow-sm order-card" data-status="{{ $order->status }}">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light">
                            <div>
                                <h5 class="mb-1">
                                    <i class="fas fa-receipt me-2"></i>
                                    Đơn hàng #{{ $order->order_number }}
                                </h5>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="text-end">
                                <span class="badge 
                                    @if($order->status == 'pending') bg-warning text-dark
                                    @elseif($order->status == 'confirmed') bg-primary
                                    @elseif($order->status == 'shipped') bg-info
                                    @elseif($order->status == 'delivered') bg-success
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif fs-6 px-3 py-2">
                                    @if($order->status == 'pending') Chờ xử lý
                                    @elseif($order->status == 'confirmed') Đã xác nhận
                                    @elseif($order->status == 'shipped') Đang vận chuyển
                                    @elseif($order->status == 'delivered') Đã giao hàng
                                    @elseif($order->status == 'cancelled') Đã hủy
                                    @else {{ ucfirst($order->status) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Sản phẩm trong đơn hàng -->
                                    <h6 class="text-muted mb-3">Sản phẩm đã đặt:</h6>
                                    @foreach ($order->orderItems->take(3) as $item)
                                    <div class="d-flex align-items-center mb-2">
                                        @if($item->phone && $item->phone->image_path)
                                        <img src="{{ asset('storage/' . $item->phone->image_path) }}" 
                                             alt="{{ $item->phone_name }}" 
                                             class="me-3 rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                        <div class="me-3 bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-mobile-alt text-muted"></i>
                                        </div>
                                        @endif
                                        
                                        <div class="flex-grow-1">
                                            <div class="fw-medium">{{ $item->phone_name }}</div>
                                            <small class="text-muted">
                                                @if($item->phone_color)Màu: {{ $item->phone_color }}@endif
                                                @if($item->phone_color && $item->phone_storage) • @endif
                                                @if($item->phone_storage){{ $item->phone_storage }}@endif
                                                • SL: {{ $item->quantity }}
                                            </small>
                                        </div>
                                        
                                        <div class="text-end">
                                            <div class="fw-medium">{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}đ</div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @if($order->orderItems->count() > 3)
                                    <small class="text-muted">
                                        <i class="fas fa-ellipsis-h me-1"></i>
                                        và {{ $order->orderItems->count() - 3 }} sản phẩm khác
                                    </small>
                                    @endif
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="text-end">
                                        <div class="mb-2">
                                            <small class="text-muted">Tổng tiền:</small>
                                            <div class="fs-5 fw-bold text-primary">
                                                {{ number_format($order->total_amount, 0, ',', '.') }}đ
                                            </div>
                                        </div>
                                        
                                        <div class="mb-2">
                                            <small class="text-muted">Giao đến:</small>
                                            <div class="small">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</div>
                                            <div class="small text-muted">{{ $order->shipping_phone }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($order->status == 'pending')
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#cancelOrderModal{{ $order->id }}">
                                        <i class="fas fa-times me-1"></i>Hủy đơn
                                    </button>
                                    @endif
                                </div>
                                
                                <div>
                                    <a href="{{ route('orders.show', $order->id) }}" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal hủy đơn hàng -->
                    @if($order->status == 'pending')
                    <div class="modal fade" id="cancelOrderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xác nhận hủy đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                    @endforeach
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-bag fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Bạn chưa có đơn hàng nào</h4>
                    <p class="text-muted mb-4">Hãy khám phá các sản phẩm tuyệt vời của chúng tôi</p>
                    <a href="{{ route('phones.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Mua sắm ngay
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border-bottom: 1px solid #e3e6f0;
}

.card-footer {
    border-radius: 0 0 12px 12px !important;
}

.badge {
    font-size: 0.8em;
    font-weight: 500;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.list-group-item.active {
    background-color: #007bff;
    border-color: #007bff;
}

.list-group-item {
    border: none;
    border-bottom: 1px solid #e3e6f0;
}

.list-group-item:last-child {
    border-bottom: none;
}

.form-select {
    border-radius: 8px;
}

.order-card {
    transition: all 0.3s ease;
}

.order-card:hover {
    border-color: #007bff;
}

@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.5rem !important;
    }
    
    .form-select {
        width: 100% !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('statusFilter');
    const sortOrder = document.getElementById('sortOrder');
    const ordersContainer = document.getElementById('ordersContainer');
    
    // Lọc theo trạng thái
    statusFilter.addEventListener('change', function() {
        const selectedStatus = this.value;
        const orderCards = document.querySelectorAll('.order-card');
        
        orderCards.forEach(card => {
            if (selectedStatus === '' || card.dataset.status === selectedStatus) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Sắp xếp (client-side đơn giản)
    sortOrder.addEventListener('change', function() {
        const selectedSort = this.value;
        const orderCards = Array.from(document.querySelectorAll('.order-card'));
        
        orderCards.sort((a, b) => {
            const aDate = new Date(a.querySelector('.text-muted').textContent.match(/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}/)[0]);
            const bDate = new Date(b.querySelector('.text-muted').textContent.match(/\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}/)[0]);
            
            switch(selectedSort) {
                case 'latest':
                    return bDate - aDate;
                case 'oldest':
                    return aDate - bDate;
                default:
                    return bDate - aDate;
            }
        });
        
        // Thêm lại vào container
        orderCards.forEach(card => {
            ordersContainer.appendChild(card);
        });
    });
});
</script>
@endsection
