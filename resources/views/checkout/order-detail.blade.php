@extends('layouts.app')

@section('title', 'Chi Tiết Đơn Hàng #' . $order->order_number . ' - PhoneShop')

@section('content')
<style>
    .order-detail-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .order-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .order-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
    }
    
    .status-timeline {
        display: flex;
        justify-content: space-between;
        margin: 30px 0;
        position: relative;
    }
    
    .timeline-step {
        text-align: center;
        flex: 1;
        position: relative;
    }
    
    .timeline-step::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e9ecef;
        z-index: 1;
    }
    
    .timeline-step:last-child::before {
        display: none;
    }
    
    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        position: relative;
        z-index: 2;
        font-size: 1.2rem;
    }
    
    .timeline-step.active .timeline-icon {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
    }
    
    .timeline-step.completed .timeline-icon {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
    }
    
    .timeline-step.completed::before {
        background: linear-gradient(45deg, #28a745, #20c997);
    }
    
    .order-section {
        padding: 30px;
        border-bottom: 1px solid #f1f3f4;
    }
    
    .order-section:last-child {
        border-bottom: none;
    }
    
    .section-title {
        margin-bottom: 20px;
        color: #495057;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .info-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
    }
    
    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .order-items-table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .order-items-table th {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 15px;
        font-weight: 600;
        border: none;
    }
    
    .order-items-table td {
        padding: 15px;
        border-bottom: 1px solid #f1f3f4;
        vertical-align: middle;
    }
    
    .order-items-table tr:last-child td {
        border-bottom: none;
    }
    
    .item-image {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border-radius: 10px;
        background: #f8f9fa;
        padding: 5px;
    }
    
    .price-summary {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 25px;
        margin-top: 20px;
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .price-row:last-child {
        border-bottom: 2px solid #495057;
        margin-bottom: 0;
        padding-bottom: 12px;
        font-weight: bold;
        font-size: 1.2rem;
        color: #28a745;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 30px;
    }
    
    .btn-action {
        border-radius: 25px;
        padding: 12px 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    @media (max-width: 768px) {
        .order-detail-container {
            padding: 20px 0;
        }
        
        .order-section {
            padding: 20px;
        }
        
        .status-timeline {
            flex-direction: column;
            gap: 20px;
        }
        
        .timeline-step::before {
            display: none;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .order-items-table {
            font-size: 0.9rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="order-detail-container">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('checkout.success', $order->id) }}">Đặt hàng thành công</a></li>
                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
            </ol>
        </nav>

        <div class="order-card">
            <!-- Header -->
            <div class="order-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-2">
                            <i class="fas fa-receipt me-3"></i>
                            Chi Tiết Đơn Hàng
                        </h2>
                        <p class="mb-0 fs-5">Mã đơn hàng: <strong>#{{ $order->order_number }}</strong></p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <div class="mb-2">
                            <span class="status-badge status-{{ $order->status }}">
                                @if($order->status == 'pending')
                                    <i class="fas fa-clock me-1"></i>Chờ xử lý
                                @elseif($order->status == 'processing')
                                    <i class="fas fa-cog me-1"></i>Đang xử lý
                                @elseif($order->status == 'shipped')
                                    <i class="fas fa-truck me-1"></i>Đã giao hàng
                                @elseif($order->status == 'delivered')
                                    <i class="fas fa-check-circle me-1"></i>Đã giao
                                @else
                                    {{ ucfirst($order->status) }}
                                @endif
                            </span>
                        </div>
                        <small class="opacity-75">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                </div>
            </div>

            <!-- Status Timeline -->
            <div class="order-section">
                <h4 class="section-title">
                    <i class="fas fa-route me-2 text-primary"></i>
                    Trạng Thái Đơn Hàng
                </h4>
                
                <div class="status-timeline">
                    <div class="timeline-step {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                        <div class="timeline-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="timeline-label">
                            <strong>Đã đặt hàng</strong>
                            <div class="text-muted small">{{ $order->created_at->format('d/m H:i') }}</div>
                        </div>
                    </div>
                    
                    <div class="timeline-step {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : ($order->status == 'processing' ? 'active' : '') }}">
                        <div class="timeline-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="timeline-label">
                            <strong>Đang xử lý</strong>
                            @if($order->status == 'processing')
                            <div class="text-muted small">Hiện tại</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="timeline-step {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : ($order->status == 'shipped' ? 'active' : '') }}">
                        <div class="timeline-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="timeline-label">
                            <strong>Đang giao</strong>
                            @if($order->shipped_at)
                            <div class="text-muted small">{{ $order->shipped_at->format('d/m H:i') }}</div>
                            @elseif($order->status == 'shipped')
                            <div class="text-muted small">Hiện tại</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="timeline-step {{ $order->status == 'delivered' ? 'completed' : '' }}">
                        <div class="timeline-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="timeline-label">
                            <strong>Đã giao</strong>
                            @if($order->delivered_at)
                            <div class="text-muted small">{{ $order->delivered_at->format('d/m H:i') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Information -->
            <div class="order-section">
                <h4 class="section-title">
                    <i class="fas fa-info-circle me-2 text-primary"></i>
                    Thông Tin Đơn Hàng
                </h4>
                
                <div class="info-grid">
                    <div class="info-card">
                        <h6 class="mb-3">
                            <i class="fas fa-user me-2 text-primary"></i>
                            Thông Tin Khách Hàng
                        </h6>
                        <div class="info-item">
                            <span>Họ tên:</span>
                            <span>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</span>
                        </div>
                        <div class="info-item">
                            <span>Email:</span>
                            <span>{{ $order->shipping_email }}</span>
                        </div>
                        <div class="info-item">
                            <span>Điện thoại:</span>
                            <span>{{ $order->shipping_phone }}</span>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <h6 class="mb-3">
                            <i class="fas fa-truck me-2 text-primary"></i>
                            Thông Tin Giao Hàng
                        </h6>
                        <div class="info-item">
                            <span>Địa chỉ:</span>
                            <span>{{ $order->shipping_address }}</span>
                        </div>
                        <div class="info-item">
                            <span>Thành phố:</span>
                            <span>{{ $order->shipping_city }}</span>
                        </div>
                        @if($order->shipping_postal_code)
                        <div class="info-item">
                            <span>Mã bưu điện:</span>
                            <span>{{ $order->shipping_postal_code }}</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="info-card">
                        <h6 class="mb-3">
                            <i class="fas fa-credit-card me-2 text-primary"></i>
                            Thông Tin Thanh Toán
                        </h6>
                        <div class="info-item">
                            <span>Phương thức:</span>
                            <span>
                                @if($order->payment_method == 'cod')
                                    Thanh toán khi nhận hàng
                                @elseif($order->payment_method == 'bank_transfer')
                                    Chuyển khoản ngân hàng
                                @elseif($order->payment_method == 'momo')
                                    Ví MoMo
                                @elseif($order->payment_method == 'vnpay')
                                    VNPay
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span>Trạng thái:</span>
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
                        @if($order->paid_at)
                        <div class="info-item">
                            <span>Ngày thanh toán:</span>
                            <span>{{ $order->paid_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($order->notes)
                <div class="info-card mt-3">
                    <h6 class="mb-3">
                        <i class="fas fa-sticky-note me-2 text-primary"></i>
                        Ghi Chú
                    </h6>
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Order Items -->
            <div class="order-section">
                <h4 class="section-title">
                    <i class="fas fa-shopping-bag me-2 text-primary"></i>
                    Sản Phẩm Đã Đặt
                </h4>
                
                <div class="table-responsive">
                    <table class="table table-hover order-items-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Màu sắc</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->phone && $item->phone->image_path)
                                        <img src="{{ asset($item->phone->image_path) }}" alt="{{ $item->phone->name }}" class="item-image me-3">
                                        @else
                                        <div class="item-image me-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-mobile-alt text-muted"></i>
                                        </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-1">{{ $item->phone->name ?? 'Sản phẩm không tồn tại' }}</h6>
                                            @if($item->phone)
                                            <small class="text-muted">{{ $item->phone->brand }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($item->color)
                                    <span class="badge bg-secondary">{{ $item->color }}</span>
                                    @else
                                    <span class="text-muted">Không xác định</span>
                                    @endif
                                </td>
                                <td>{{ number_format($item->price) }}₫</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-bold text-primary">{{ number_format($item->total) }}₫</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Price Summary -->
                <div class="price-summary">
                    <div class="price-row">
                        <span>Tạm tính:</span>
                        <span>{{ number_format($order->subtotal) }}₫</span>
                    </div>
                    <div class="price-row">
                        <span>Phí vận chuyển:</span>
                        <span>{{ $order->shipping_fee > 0 ? number_format($order->shipping_fee) . '₫' : 'Miễn phí' }}</span>
                    </div>
                    <div class="price-row">
                        <span>VAT (10%):</span>
                        <span>{{ number_format($order->tax_amount) }}₫</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="price-row">
                        <span>Giảm giá:</span>
                        <span class="text-success">-{{ number_format($order->discount_amount) }}₫</span>
                    </div>
                    @endif
                    <div class="price-row">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($order->total_amount) }}₫</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('phones.index') }}" class="btn btn-primary btn-action">
                <i class="fas fa-shopping-bag me-2"></i>
                Tiếp Tục Mua Sắm
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-action">
                <i class="fas fa-print me-2"></i>
                In Đơn Hàng
            </button>
            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-action">
                <i class="fas fa-home me-2"></i>
                Về Trang Chủ
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    .order-detail-container {
        background: white !important;
        padding: 0 !important;
    }
    
    .action-buttons,
    .breadcrumb,
    nav {
        display: none !important;
    }
    
    .order-card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}
</style>
@endsection
