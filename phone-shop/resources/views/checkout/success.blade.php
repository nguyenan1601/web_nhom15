@extends('layouts.app')

@section('title', 'Đặt Hàng Thành Công - PhoneShop')

@section('content')
<style>
    .success-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
    }
    
    .success-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .success-header {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 50px 30px;
        text-align: center;
        position: relative;
    }
    
    .success-icon {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 3rem;
        animation: checkmark 0.6s ease-in-out;
    }
    
    @keyframes checkmark {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .order-details {
        padding: 40px;
    }
    
    .order-info-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .info-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
    }
    
    .info-value {
        color: #212529;
    }
    
    .order-items {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .order-item {
        padding: 20px;
        border-bottom: 1px solid #f1f3f4;
        display: flex;
        align-items: center;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: contain;
        background: #f8f9fa;
        padding: 5px;
        margin-right: 15px;
    }
    
    .btn-action {
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .btn-primary-custom {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        color: white;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    
    .btn-secondary-custom {
        background: transparent;
        border: 2px solid #6c757d;
        color: #6c757d;
    }
    
    .btn-secondary-custom:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-pending {
        background: linear-gradient(45deg, #ffc107, #ffeb3b);
        color: #856404;
    }
    
    .payment-status-pending {
        background: linear-gradient(45deg, #fd7e14, #ffc107);
        color: #833900;
    }
    
    .payment-status-waiting {
        background: linear-gradient(45deg, #17a2b8, #20c997);
        color: white;
    }
    
    @media (max-width: 768px) {
        .success-container {
            padding: 20px 0;
        }
        
        .success-header {
            padding: 30px 20px;
        }
        
        .order-details {
            padding: 20px;
        }
        
        .order-item {
            flex-direction: column;
            text-align: center;
        }
        
        .item-image {
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
</style>

<div class="success-container">
    <div class="container">
        <div class="success-card">
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1 class="mb-3">Đặt Hàng Thành Công!</h1>
                <p class="mb-0 fs-5">Cảm ơn bạn đã mua hàng tại PhoneShop</p>
            </div>
            
            <div class="order-details">
                <!-- Thông tin đơn hàng -->
                <div class="order-info-card">
                    <h4 class="mb-4">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Thông Tin Đơn Hàng
                    </h4>
                    
                    <div class="info-row">
                        <span class="info-label">Mã đơn hàng:</span>
                        <span class="info-value fw-bold text-primary">#{{ $order->order_number }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Ngày đặt:</span>
                        <span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Trạng thái:</span>
                        <span class="status-badge status-{{ $order->status }}">
                            @if($order->status == 'pending')
                                Chờ xử lý
                            @elseif($order->status == 'processing')
                                Đang xử lý
                            @elseif($order->status == 'shipped')
                                Đã giao
                            @else
                                {{ ucfirst($order->status) }}
                            @endif
                        </span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Thanh toán:</span>
                        <span class="status-badge payment-status-{{ $order->payment_status }}">
                            @if($order->payment_status == 'pending')
                                Chờ thanh toán
                            @elseif($order->payment_status == 'waiting')
                                Đang chờ xử lý
                            @elseif($order->payment_status == 'paid')
                                Đã thanh toán
                            @else
                                {{ ucfirst($order->payment_status) }}
                            @endif
                        </span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Phương thức thanh toán:</span>
                        <span class="info-value">
                            @if($order->payment_method == 'cod')
                                <i class="fas fa-money-bill-wave text-success me-1"></i>
                                Thanh toán khi nhận hàng
                            @elseif($order->payment_method == 'bank_transfer')
                                <i class="fas fa-university text-primary me-1"></i>
                                Chuyển khoản ngân hàng
                            @elseif($order->payment_method == 'momo')
                                <i class="fas fa-mobile-alt text-danger me-1"></i>
                                Ví MoMo
                            @elseif($order->payment_method == 'vnpay')
                                <i class="fas fa-credit-card text-info me-1"></i>
                                VNPay
                            @endif
                        </span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Tổng tiền:</span>
                        <span class="info-value fw-bold text-success fs-5">{{ number_format($order->total_amount) }}₫</span>
                    </div>
                </div>
                
                <!-- Thông tin giao hàng -->
                <div class="order-info-card">
                    <h4 class="mb-4">
                        <i class="fas fa-truck text-primary me-2"></i>
                        Thông Tin Giao Hàng
                    </h4>
                    
                    <div class="info-row">
                        <span class="info-label">Người nhận:</span>
                        <span class="info-value">{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Số điện thoại:</span>
                        <span class="info-value">{{ $order->shipping_phone }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $order->shipping_email }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Địa chỉ:</span>
                        <span class="info-value">
                            {{ $order->shipping_address }}, {{ $order->shipping_city }}
                            @if($order->shipping_postal_code)
                                , {{ $order->shipping_postal_code }}
                            @endif
                        </span>
                    </div>
                    
                    @if($order->notes)
                    <div class="info-row">
                        <span class="info-label">Ghi chú:</span>
                        <span class="info-value">{{ $order->notes }}</span>
                    </div>
                    @endif
                </div>
                
                <!-- Danh sách sản phẩm -->
                <div class="mb-4">
                    <h4 class="mb-3">
                        <i class="fas fa-shopping-bag text-primary me-2"></i>
                        Sản Phẩm Đã Đặt
                    </h4>
                    
                    <div class="order-items">
                        @foreach($order->orderItems as $item)
                        <div class="order-item">
                            @if($item->phone && $item->phone->image_path)
                            <img src="{{ asset($item->phone->image_path) }}" alt="{{ $item->phone->name }}" class="item-image">
                            @else
                            <div class="item-image d-flex align-items-center justify-content-center">
                                <i class="fas fa-mobile-alt text-muted"></i>
                            </div>
                            @endif
                            
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $item->phone->name ?? 'Sản phẩm không tồn tại' }}</h6>
                                <div class="text-muted small">
                                    @if($item->color)
                                    <span class="me-3">
                                        <i class="fas fa-palette me-1"></i>Màu: {{ $item->color }}
                                    </span>
                                    @endif
                                    <span class="me-3">
                                        <i class="fas fa-sort-numeric-up me-1"></i>SL: {{ $item->quantity }}
                                    </span>
                                    <span>
                                        <i class="fas fa-tag me-1"></i>{{ number_format($item->price) }}₫/sp
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <div class="fw-bold text-primary">{{ number_format($item->total) }}₫</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Hướng dẫn tiếp theo -->
                @if($order->payment_method != 'cod')
                <div class="alert alert-info border-0 rounded-3 mb-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-info-circle me-2"></i>
                        Hướng Dẫn Thanh Toán
                    </h5>
                    @if($order->payment_method == 'bank_transfer')
                    <p class="mb-2">Vui lòng chuyển khoản theo thông tin sau:</p>
                    <ul class="mb-0">
                        <li><strong>Ngân hàng:</strong> Vietcombank</li>
                        <li><strong>Số tài khoản:</strong> 0123456789</li>
                        <li><strong>Chủ tài khoản:</strong> PHONESHOP</li>
                        <li><strong>Nội dung:</strong> {{ $order->order_number }}</li>
                        <li><strong>Số tiền:</strong> {{ number_format($order->total_amount) }}₫</li>
                    </ul>
                    @else
                    <p class="mb-0">Chúng tôi sẽ gửi hướng dẫn thanh toán qua email trong vài phút tới.</p>
                    @endif
                </div>
                @endif
                
                <!-- Nút hành động -->
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('phones.index') }}" class="btn btn-primary-custom btn-action">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Tiếp Tục Mua Sắm
                    </a>
                    <a href="{{ route('checkout.show', $order->id) }}" class="btn btn-secondary-custom btn-action">
                        <i class="fas fa-receipt me-2"></i>
                        Xem Chi Tiết
                    </a>
                </div>
                
                <!-- Thông tin hỗ trợ -->
                <div class="mt-5 text-center">
                    <div class="border-top pt-4">
                        <h6 class="mb-3">Cần hỗ trợ?</h6>
                        <p class="text-muted mb-3">
                            Liên hệ với chúng tôi qua hotline <strong>1900-xxxx</strong> 
                            hoặc email <strong>support@phoneshop.com</strong>
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="tel:1900xxxx" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-phone me-1"></i>Gọi ngay
                            </a>
                            <a href="mailto:support@phoneshop.com" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-envelope me-1"></i>Gửi email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add confetti effect
    if (typeof confetti !== 'undefined') {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 }
        });
    }
    
    // Auto scroll to top
    window.scrollTo(0, 0);
});
</script>
@endsection
