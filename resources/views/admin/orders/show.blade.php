@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->order_number)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Chi tiết đơn hàng #{{ $order->order_number }}</h3>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
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
                                                'shipped' => 'Đã giao',
                                                'delivered' => 'Đã nhận',
                                                'completed' => 'Hoàn thành',
                                                'cancelled' => 'Đã hủy'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusClasses[$order->status] ?? 'secondary' }}">
                                            {{ $statusTexts[$order->status] ?? $order->status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Phương thức thanh toán:</strong></td>
                                    <td>{{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : $order->payment_method }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày tạo:</strong></td>
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
                                    <td>{{ $order->tracking_info['tracking_number'] ?? 'N/A' }}</td>
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

                    <!-- Ghi chú admin -->
                    @if($order->admin_notes)
                    <div class="mb-4">
                        <h5>Ghi chú admin</h5>
                        <div class="alert alert-info">
                            {{ $order->admin_notes }}
                        </div>
                    </div>
                    @endif

                    <!-- Ghi chú khách hàng -->
                    @if($order->notes)
                    <div class="mb-4">
                        <h5>Ghi chú khách hàng</h5>
                        <div class="alert alert-light">
                            {{ $order->notes }}
                        </div>
                    </div>
                    @endif

                    <!-- Thao tác -->
                    <div class="row">
                        <div class="col-12">
                            <h5>Thao tác đơn hàng</h5>
                            <div class="btn-group-vertical w-100" role="group">
                                @if($order->status == 'pending')
                                <!-- Xác nhận đơn hàng -->
                                <button type="button" class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    <i class="fas fa-check"></i> Xác nhận đơn hàng
                                </button>
                                @endif

                                @if(in_array($order->status, ['confirmed', 'pending']))
                                <!-- Chuyển sang xử lý -->
                                <form action="{{ route('admin.orders.process', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary mb-2 w-100">
                                        <i class="fas fa-cogs"></i> Chuyển sang xử lý
                                    </button>
                                </form>
                                @endif

                                @if($order->status == 'processing')
                                <!-- Giao hàng -->
                                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#shipModal">
                                    <i class="fas fa-shipping-fast"></i> Giao hàng
                                </button>
                                @endif

                                @if($order->status == 'shipped')
                                <!-- Xác nhận đã giao -->
                                <form action="{{ route('admin.orders.mark-delivered', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success mb-2 w-100">
                                        <i class="fas fa-check-circle"></i> Xác nhận đã giao
                                    </button>
                                </form>
                                @endif

                                @if(!in_array($order->status, ['delivered', 'completed', 'cancelled']))
                                <!-- Hủy đơn hàng -->
                                <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#cancelModal">
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

<!-- Modal xác nhận đơn hàng -->
<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Ghi chú (tùy chọn)</label>
                        <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-info">Xác nhận đơn hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal giao hàng -->
<div class="modal fade" id="shipModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.orders.ship', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Giao hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Mã vận đơn</label>
                        <input type="text" class="form-control" id="tracking_number" name="tracking_number">
                    </div>
                    <div class="mb-3">
                        <label for="shipping_company" class="form-label">Đơn vị vận chuyển</label>
                        <input type="text" class="form-control" id="shipping_company" name="shipping_company">
                    </div>
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-secondary">Giao hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal hủy đơn hàng -->
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Hủy đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cancel_reason" class="form-label">Lý do hủy <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="cancel_reason" name="cancel_reason" rows="3" required></textarea>
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
@endsection
