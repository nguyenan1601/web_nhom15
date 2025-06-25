@extends('layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Quản lý sản phẩm</h2>
    <a href="{{ route('admin.phones.create') }}" class="btn btn-success mb-3">+ Thêm sản phẩm mới</a>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Thương hiệu</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Kho</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($phones as $phone)
            <tr>
                <td>{{ $phone->id }}</td>
                <td>{{ $phone->name }}</td>
                <td>{{ $phone->brand->name ?? $phone->brand }}</td>
                <td>{{ $phone->category->name ?? $phone->category }}</td>
                <td>{{ number_format($phone->price) }}đ</td>
                <td>{{ $phone->stock_quantity }}</td>
                <td>{{ $phone->status }}</td>
                <td>{{ $phone->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.phones.edit', $phone->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.phones.destroy', $phone->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xoá sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $phones->links() }}
    </div>
</div>
@endsection
