@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quản lý đơn hàng</h3>
                </div>
                <div class="card-body">
                    <!-- Bộ lọc -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.orders.index') }}" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" 
                                       placeholder="Tìm kiếm theo mã đơn hàng..." 
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Tabs trạng thái -->
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link {{ !request('status') ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index') }}">
                                Tất cả ({{ $statusCounts['all'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'pending']) }}">
                                Chờ xử lý ({{ $statusCounts['pending'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'confirmed' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}">
                                Đã xác nhận ({{ $statusCounts['confirmed'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'processing']) }}">
                                Đang xử lý ({{ $statusCounts['processing'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'shipped' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'shipped']) }}">
                                Đã giao ({{ $statusCounts['shipped'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'delivered' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'delivered']) }}">
                                Đã nhận ({{ $statusCounts['delivered'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'completed']) }}">
                                Hoàn thành ({{ $statusCounts['completed'] ?? 0 }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request('status') == 'cancelled' ? 'active' : '' }}" 
                               href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}">
                                Đã hủy ({{ $statusCounts['cancelled'] ?? 0 }})
                            </a>
                        </li>
                    </ul>

                    <!-- Bảng đơn hàng -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                                           class="text-decoration-none">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                                        <small class="text-muted">{{ $order->shipping_email }}</small>
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
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có đơn hàng nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Phân trang -->
                    <div class="d-flex justify-content-center">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
