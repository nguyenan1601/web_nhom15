@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

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
                <div class="card-header">
                    <h3 class="card-title">Đơn hàng của tôi</h3>
                </div>
                <div class="card-body">
                    @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('customer.orders.show', $order->id) }}" 
                                           class="text-decoration-none">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>{{ number_format($order->total_amount) }}₫</td>
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
                                        <span class="badge bg-{{ $statusClasses[$order->status] ?? 'secondary' }}">
                                            {{ $statusTexts[$order->status] ?? $order->status }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('customer.orders.show', $order->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Xem chi tiết
                                        </a>
                                        
                                        @if($order->status == 'delivered')
                                        <button type="button" class="btn btn-sm btn-success ms-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmReceivedModal{{ $order->id }}">
                                            <i class="fas fa-check"></i> Đã nhận hàng
                                        </button>
                                        @endif
                                        
                                        @if($order->status == 'shipped')
                                        <button type="button" class="btn btn-sm btn-warning ms-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmReceivedModal{{ $order->id }}">
                                            <i class="fas fa-check"></i> Xác nhận nhận hàng
                                        </button>
                                        @endif
                                        
                                        @if(in_array($order->status, ['pending', 'confirmed']))
                                        <button type="button" class="btn btn-sm btn-danger ms-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#cancelModal{{ $order->id }}">
                                            <i class="fas fa-times"></i> Hủy đơn
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Phân trang -->
                    <div class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Bạn chưa có đơn hàng nào</h5>
                        <a href="{{ route('phones.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag"></i> Mua sắm ngay
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals cho từng đơn hàng -->
@foreach($orders as $order)
    <!-- Modal xác nhận đã nhận hàng -->
    <div class="modal fade" id="confirmReceivedModal{{ $order->id }}" tabindex="-1">
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

    <!-- Modal hủy đơn hàng -->
    @if(in_array($order->status, ['pending', 'confirmed']))
    <div class="modal fade" id="cancelModal{{ $order->id }}" tabindex="-1">
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
                            <label for="cancel_reason{{ $order->id }}" class="form-label">
                                Lý do hủy đơn hàng <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="cancel_reason{{ $order->id }}" 
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
@endforeach

<!-- Form logout ẩn -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</div>

@endsection
