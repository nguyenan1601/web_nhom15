@extends('layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Quản lý đơn hàng</h2>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->name ?? '-' }}</td>
                <td>{{ $order->customer->email ?? $order->shipping_email }}</td>
                <td>{{ number_format($order->total_amount) }}đ</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $orders->links() }}
    </div>
</div>
@endsection
