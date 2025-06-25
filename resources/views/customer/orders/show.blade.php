@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->order_number)

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>Tài Khoản
                    </h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>Thông tin cá nhân
                    </a>
                    <a href="{{ route('customer.orders.index') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-shopping-bag me-2"></i>Đơn hàng của tôi
                    </a>
                    <a href="{{ route('cart.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-shopping-cart me-2"></i>Giỏ hàng
                    </a>
                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Chi tiết đơn hàng #{{ $order->order_number }}</h3>
                    <a href="{{ route('customer.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
                <div class="card-body">
                    <!-- Thông tin đơn hàng -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Thông tin đơn hàng</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Mã đơn hàng:</strong></td>
                                    <td>{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Trạng thái:</strong></td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'warning',
                                                'confirmed' => 'info',
                                                'processing' => 'primary',
                                                'shipped' => 'secondary',
                                                'delivered' => 'success',
                                                'completed' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                            $statusTexts = [
                                                'pending' => 'Chờ xử lý',
                                                'confirmed' => 'Đã xác nhận',
                                                'processing' => 'Đang xử lý',
                                                'shipped' => 'Đang giao',
                                                'delivered' => 'Đã giao',
                                                'completed' => 'Hoàn thành',
                                                'cancelled' => 'Đã hủy'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusClasses[$order->status] ?? 'secondary' }} fs-6">
                                            {{ $statusTexts[$order->status] ?? $order->status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Phương thức thanh toán:</strong></td>
                                    <td>{{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : $order->payment_method }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày đặt:</strong></td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @if($order->confirmed_at)
                                <tr>
                                    <td><strong>Xác nhận lúc:</strong></td>
                                    <td>{{ $order->confirmed_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                                @if($order->shipped_at)
                                <tr>
                                    <td><strong>Giao hàng lúc:</strong></td>
                                    <td>{{ $order->shipped_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                                @if($order->delivered_at)
                                <tr>
                                    <td><strong>Đã giao lúc:</strong></td>
                                    <td>{{ $order->delivered_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                                @if($order->completed_at)
                                <tr>
                                    <td><strong>Hoàn thành lúc:</strong></td>
                                    <td>{{ $order->completed_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin giao hàng</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Tên:</strong></td>
                                    <td>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $order->shipping_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Điện thoại:</strong></td>
                                    <td>{{ $order->shipping_phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Địa chỉ:</strong></td>
                                    <td>{{ $order->shipping_address }}, {{ $order->shipping_city }}</td>
                                </tr>
                                @if($order->tracking_info)
                                <tr>
                                    <td><strong>Mã vận đơn:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $order->tracking_info['tracking_number'] ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                @if(isset($order->tracking_info['shipping_company']))
                                <tr>
                                    <td><strong>Đơn vị vận chuyển:</strong></td>
                                    <td>{{ $order->tracking_info['shipping_company'] }}</td>
                                </tr>
                                @endif
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Timeline trạng thái -->
                    <div class="mb-4">
                        <h5>Lịch sử đơn hàng</h5>
                        <div class="timeline">
                            <div class="timeline-item {{ $order->created_at ? 'completed' : '' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Đơn hàng được tạo</h6>
                                    <small class="text-muted">{{ $order->created_at->format('d/m/Y H:i:s') }}</small>
                                </div>
                            </div>

                            @if($order->confirmed_at || in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered', 'completed']))
                            <div class="timeline-item {{ $order->confirmed_at ? 'completed' : 'active' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Đơn hàng đã xác nhận</h6>
                                    @if($order->confirmed_at)
                                    <small class="text-muted">{{ $order->confirmed_at->format('d/m/Y H:i:s') }}</small>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(in_array($order->status, ['processing', 'shipped', 'delivered', 'completed']))
                            <div class="timeline-item {{ in_array($order->status, ['shipped', 'delivered', 'completed']) ? 'completed' : 'active' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Đang xử lý</h6>
                                </div>
                            </div>
                            @endif

                            @if($order->shipped_at || in_array($order->status, ['shipped', 'delivered', 'completed']))
                            <div class="timeline-item {{ $order->shipped_at ? 'completed' : 'active' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Đã giao hàng</h6>
                                    @if($order->shipped_at)
                                    <small class="text-muted">{{ $order->shipped_at->format('d/m/Y H:i:s') }}</small>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($order->delivered_at || in_array($order->status, ['delivered', 'completed']))
                            <div class="timeline-item {{ $order->delivered_at ? 'completed' : 'active' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Đã nhận hàng</h6>
                                    @if($order->delivered_at)
                                    <small class="text-muted">{{ $order->delivered_at->format('d/m/Y H:i:s') }}</small>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($order->completed_at || $order->status == 'completed')
                            <div class="timeline-item {{ $order->completed_at ? 'completed' : 'active' }}">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Hoàn thành</h6>
                                    @if($order->completed_at)
                                    <small class="text-muted">{{ $order->completed_at->format('d/m/Y H:i:s') }}</small>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($order->status == 'cancelled')
                            <div class="timeline-item cancelled">
                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h6>Đã hủy</h6>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sản phẩm -->
                    <div class="mb-4">
                        <h5>Sản phẩm đã đặt</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Màu sắc</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->phone_name }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->unit_price) }}₫</td>
                                        <td>{{ number_format($item->total_price) }}₫</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-end">Tổng tiền:</th>
                                        <th>{{ number_format($order->total_amount) }}₫</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Ghi chú -->
                    @if($order->notes)
                    <div class="mb-4">
                        <h5>Ghi chú đơn hàng</h5>
                        <div class="alert alert-light">
                            {{ $order->notes }}
                        </div>
                    </div>
                    @endif

                    <!-- Thao tác -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                @if($order->status == 'delivered')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmReceivedModal">
                                    <i class="fas fa-check"></i> Xác nhận đã nhận hàng
                                </button>
                                @endif
                                
                                @if($order->status == 'shipped')
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmReceivedModal">
                                    <i class="fas fa-check"></i> Xác nhận nhận hàng
                                </button>
                                @endif
                                
                                @if(in_array($order->status, ['pending', 'confirmed']))
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                    <i class="fas fa-times"></i> Hủy đơn hàng
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal xác nhận đã nhận hàng -->
@if(in_array($order->status, ['delivered', 'shipped']))
<div class="modal fade" id="confirmReceivedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('customer.orders.confirm-received', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận đã nhận hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn đã nhận được đơn hàng <strong>{{ $order->order_number }}</strong>?</p>
                    <p class="text-muted">Sau khi xác nhận, đơn hàng sẽ được đánh dấu là hoàn thành.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chưa nhận</button>
                    <button type="submit" class="btn btn-success">Đã nhận hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Modal hủy đơn hàng -->
@if(in_array($order->status, ['pending', 'confirmed']))
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Hủy đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cancel_reason" class="form-label">
                            Lý do hủy đơn hàng <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" 
                                  id="cancel_reason" 
                                  name="cancel_reason" 
                                  rows="3" 
                                  required 
                                  placeholder="Vui lòng cho biết lý do hủy đơn hàng..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Form logout ẩn -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline:before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-left: 50px;
}

.timeline-marker {
    position: absolute;
    left: -28px;
    top: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #e9ecef;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #e9ecef;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    box-shadow: 0 0 0 3px #28a745;
}

.timeline-item.active .timeline-marker {
    background: #007bff;
    box-shadow: 0 0 0 3px #007bff;
}

.timeline-item.cancelled .timeline-marker {
    background: #dc3545;
    box-shadow: 0 0 0 3px #dc3545;
}

.timeline-content h6 {
    margin: 0;
    color: #495057;
}

.timeline-item.completed .timeline-content h6 {
    color: #28a745;
}

.timeline-item.active .timeline-content h6 {
    color: #007bff;
}

.timeline-item.cancelled .timeline-content h6 {
    color: #dc3545;
}
</style>
@endsection
