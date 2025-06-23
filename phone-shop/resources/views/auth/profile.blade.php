@extends('layouts.app')

@section('title', 'Thông Tin Cá Nhân - PhoneShop')

@section('content')
<div class="container py-5">
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
                    <a href="{{ route('profile') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-user me-2"></i>Thông tin cá nhân
                    </a>
                    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">
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
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Cập Nhật Thông Tin Cá Nhân
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Có lỗi xảy ra:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-1"></i>Họ và tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', Auth::user()->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', Auth::user()->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone me-1"></i>Số điện thoại
                            </label>
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', Auth::user()->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">
                            <i class="fas fa-key me-2"></i>Đổi Mật Khẩu (Tùy chọn)
                        </h5>
                        <p class="text-muted">Để trống nếu không muốn thay đổi mật khẩu</p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Mật khẩu mới
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Nhập mật khẩu mới (ít nhất 6 ký tự)">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Xác nhận mật khẩu mới
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Nhập lại mật khẩu mới">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-save me-2"></i>Cập Nhật Thông Tin
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg w-100">
                                    <i class="fas fa-arrow-left me-2"></i>Quay lại trang chủ
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Info Card -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Thông Tin Tài Khoản
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Số điện thoại:</strong> {{ Auth::user()->phone ?: 'Chưa cập nhật' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ngày tạo tài khoản:</strong> {{ Auth::user()->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Cập nhật lần cuối:</strong> {{ Auth::user()->updated_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Trạng thái:</strong> <span class="badge bg-success">Hoạt động</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }

    if (togglePasswordConfirm && passwordConfirmInput) {
        togglePasswordConfirm.addEventListener('click', function() {
            const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmInput.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    }

    // Password confirmation validation
    passwordConfirmInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirmPassword = this.value;
        
        if (password && confirmPassword && password !== confirmPassword) {
            this.setCustomValidity('Mật khẩu xác nhận không khớp');
            this.classList.add('is-invalid');
        } else {
            this.setCustomValidity('');
            this.classList.remove('is-invalid');
        }
    });

    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const passwordConfirm = passwordConfirmInput.value;

            if (password && password.length < 6) {
                e.preventDefault();
                alert('Mật khẩu mới phải có ít nhất 6 ký tự!');
                return false;
            }

            if (password && password !== passwordConfirm) {
                e.preventDefault();
                alert('Mật khẩu xác nhận không khớp!');
                return false;
            }
        });
    }
});
</script>
@endpush

@push('styles')
<style>
.card {
    border-radius: 10px;
}

.list-group-item.active {
    background-color: #007bff;
    border-color: #007bff;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.btn-primary {
    transition: transform 0.2s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
}

.alert {
    border-radius: 8px;
}

.input-group .btn {
    border-left: none;
}

.badge {
    font-size: 0.8rem;
}

.text-danger {
    color: #dc3545 !important;
}
</style>
@endpush
@endsection
