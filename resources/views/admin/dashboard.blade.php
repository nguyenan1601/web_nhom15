@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Chào mừng Admin!</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h5 class="card-title">Quản lý người dùng</h5>
                    <p class="card-text">Xem, sửa, xóa tài khoản người dùng.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-mobile-alt fa-2x text-success mb-2"></i>
                    <h5 class="card-title">Quản lý sản phẩm</h5>
                    <p class="card-text">Thêm, sửa, xóa sản phẩm điện thoại.</p>
                    <a href="{{ route('admin.phones.index') }}" class="btn btn-outline-success btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-2x text-danger mb-2"></i>
                    <h5 class="card-title">Quản lý đơn hàng</h5>
                    <p class="card-text">Xem và xử lý các đơn hàng của khách.</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-danger btn-sm">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Thống kê nhanh</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tổng số người dùng: <strong>{{ $userCount ?? '--' }}</strong></li>
                        <li class="list-group-item">Tổng số sản phẩm: <strong>{{ $phoneCount ?? '--' }}</strong></li>
                        <li class="list-group-item">Tổng số đơn hàng: <strong>{{ $orderCount ?? '--' }}</strong></li>
                        <li class="list-group-item">Doanh thu hôm nay: <strong>{{ isset($todayRevenue) ? number_format($todayRevenue) . 'đ' : '--' }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">Thông báo hệ thống</div>
                <div class="card-body">
                    <ul>
                        <li>Chào mừng bạn đến với trang quản trị!</li>
                        <li>Hãy kiểm tra các đơn hàng mới nhất.</li>
                        <li>Đảm bảo dữ liệu luôn được sao lưu định kỳ.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
