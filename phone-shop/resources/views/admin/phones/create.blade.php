@extends('layouts.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Thêm sản phẩm mới</h2>
    <form action="{{ route('admin.phones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Thương hiệu</label>
            <select class="form-select" id="brand_id" name="brand_id" required>
                <option value="">-- Chọn thương hiệu --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Số lượng kho</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" id="status" name="status" required>
                <option value="active">Hiển thị</option>
                <option value="inactive">Ẩn</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image_path" class="form-label">Đường dẫn ảnh (image_path)</label>
            <input type="text" class="form-control" id="image_path" name="image_path" value="{{ old('image_path') }}">
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        <a href="{{ route('admin.phones.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
