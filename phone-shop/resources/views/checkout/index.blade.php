@extends('layouts.app')

@section('title', 'Thanh Toán - PhoneShop')

@section('content')
<style>
    .checkout-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .checkout-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        background: white;
    }
    
    .checkout-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .form-control {
        border-radius: 15px;
        border: 2px solid #e9ecef;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }
    
    .order-summary {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        border: 1px solid #e9ecef;
    }
    
    .order-item {
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .payment-method {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .payment-method:hover {
        border-color: #667eea;
        background: #f8f9ff;
    }
    
    .payment-method.selected {
        border-color: #667eea;
        background: #f8f9ff;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }
    
    .btn-checkout {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        border-radius: 25px;
        padding: 15px 40px;
        font-weight: bold;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }
    
    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6);
        background: linear-gradient(45deg, #20c997, #28a745);
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding: 5px 0;
    }
    
    .price-row.total {
        border-top: 2px solid #dee2e6;
        padding-top: 15px;
        margin-top: 15px;
        font-weight: bold;
        font-size: 1.2rem;
        color: #28a745;
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 30px;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .checkout-container {
            padding: 10px 0;
        }
        
        .checkout-header {
            padding: 20px;
        }
        
        .order-summary {
            margin-top: 30px;
        }
    }
</style>

<div class="checkout-container">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                <li class="breadcrumb-item active">Thanh toán</li>
            </ol>
        </nav>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-card">
                        <div class="checkout-header">
                            <h2 class="mb-0">
                                <i class="fas fa-credit-card me-3"></i>
                                Thông Tin Thanh Toán
                            </h2>
                        </div>
                        
                        <div class="card-body p-4">
                            <!-- Thông tin giao hàng -->
                            <h4 class="mb-4">
                                <i class="fas fa-truck me-2 text-primary"></i>
                                Thông Tin Giao Hàng
                            </h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_first_name" class="form-label">Họ *</label>
                                    <input type="text" class="form-control @error('shipping_first_name') is-invalid @enderror" 
                                           id="shipping_first_name" name="shipping_first_name" 
                                           value="{{ old('shipping_first_name') }}" required>
                                    @error('shipping_first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_last_name" class="form-label">Tên *</label>
                                    <input type="text" class="form-control @error('shipping_last_name') is-invalid @enderror" 
                                           id="shipping_last_name" name="shipping_last_name" 
                                           value="{{ old('shipping_last_name') }}" required>
                                    @error('shipping_last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_phone" class="form-label">Số điện thoại *</label>
                                    <input type="tel" class="form-control @error('shipping_phone') is-invalid @enderror" 
                                           id="shipping_phone" name="shipping_phone" 
                                           value="{{ old('shipping_phone') }}" required>
                                    @error('shipping_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_email" class="form-label">Email *</label>
                                    <input type="email" class="form-control @error('shipping_email') is-invalid @enderror" 
                                           id="shipping_email" name="shipping_email" 
                                           value="{{ old('shipping_email') }}" required>
                                    @error('shipping_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label">Địa chỉ *</label>
                                <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                          id="shipping_address" name="shipping_address" rows="3" 
                                          required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_city" class="form-label">Thành phố *</label>
                                    <select class="form-control @error('shipping_city') is-invalid @enderror" 
                                            id="shipping_city" name="shipping_city" required>
                                        <option value="">Chọn thành phố</option>
                                        <option value="Hà Nội" {{ old('shipping_city') == 'Hà Nội' ? 'selected' : '' }}>Hà Nội</option>
                                        <option value="TP.HCM" {{ old('shipping_city') == 'TP.HCM' ? 'selected' : '' }}>TP.HCM</option>
                                        <option value="Đà Nẵng" {{ old('shipping_city') == 'Đà Nẵng' ? 'selected' : '' }}>Đà Nẵng</option>
                                        <option value="Hải Phòng" {{ old('shipping_city') == 'Hải Phòng' ? 'selected' : '' }}>Hải Phòng</option>
                                        <option value="Cần Thơ" {{ old('shipping_city') == 'Cần Thơ' ? 'selected' : '' }}>Cần Thơ</option>
                                    </select>
                                    @error('shipping_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_postal_code" class="form-label">Mã bưu điện</label>
                                    <input type="text" class="form-control" 
                                           id="shipping_postal_code" name="shipping_postal_code" 
                                           value="{{ old('shipping_postal_code') }}">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="notes" class="form-label">Ghi chú đơn hàng</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" 
                                          placeholder="Ghi chú về đơn hàng, ví dụ: giao hàng giờ hành chính...">{{ old('notes') }}</textarea>
                            </div>
                            
                            <!-- Phương thức thanh toán -->
                            <h4 class="mb-4">
                                <i class="fas fa-wallet me-2 text-primary"></i>
                                Phương Thức Thanh Toán
                            </h4>
                            
                            <div class="payment-methods">
                                <div class="payment-method" data-method="cod">
                                    <input type="radio" name="payment_method" value="cod" id="cod" class="me-2" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                                    <label for="cod" class="mb-0">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <strong>Thanh toán khi nhận hàng (COD)</strong>
                                        <div class="text-muted small mt-1">Thanh toán bằng tiền mặt khi nhận hàng</div>
                                    </label>
                                </div>
                                
                                <div class="payment-method" data-method="bank_transfer">
                                    <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer" class="me-2" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                    <label for="bank_transfer" class="mb-0">
                                        <i class="fas fa-university text-primary me-2"></i>
                                        <strong>Chuyển khoản ngân hàng</strong>
                                        <div class="text-muted small mt-1">Chuyển khoản qua tài khoản ngân hàng</div>
                                    </label>
                                </div>
                                
                                <div class="payment-method" data-method="momo">
                                    <input type="radio" name="payment_method" value="momo" id="momo" class="me-2" {{ old('payment_method') == 'momo' ? 'checked' : '' }}>
                                    <label for="momo" class="mb-0">
                                        <i class="fas fa-mobile-alt text-danger me-2"></i>
                                        <strong>Ví MoMo</strong>
                                        <div class="text-muted small mt-1">Thanh toán qua ví điện tử MoMo</div>
                                    </label>
                                </div>
                                
                                <div class="payment-method" data-method="vnpay">
                                    <input type="radio" name="payment_method" value="vnpay" id="vnpay" class="me-2" {{ old('payment_method') == 'vnpay' ? 'checked' : '' }}>
                                    <label for="vnpay" class="mb-0">
                                        <i class="fas fa-credit-card text-info me-2"></i>
                                        <strong>VNPay</strong>
                                        <div class="text-muted small mt-1">Thanh toán qua thẻ ATM/Visa/MasterCard</div>
                                    </label>
                                </div>
                            </div>
                            @error('payment_method')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h4 class="mb-4">
                            <i class="fas fa-receipt me-2 text-primary"></i>
                            Tóm Tắt Đơn Hàng
                        </h4>
                        
                        <!-- Danh sách sản phẩm -->
                        @foreach($items as $item)
                        <div class="order-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $item['name'] }}</h6>
                                    <small class="text-muted">
                                        Màu: {{ $item['color'] }} | SL: {{ $item['quantity'] }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">{{ number_format($item['total']) }}₫</div>
                                    <small class="text-muted">{{ number_format($item['price']) }}₫/sp</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Tính toán tổng tiền -->
                        <div class="mt-4">
                            <div class="price-row">
                                <span>Tạm tính:</span>
                                <span>{{ number_format($subtotal) }}₫</span>
                            </div>
                            <div class="price-row">
                                <span>Phí vận chuyển:</span>
                                <span>{{ $shippingFee > 0 ? number_format($shippingFee) . '₫' : 'Miễn phí' }}</span>
                            </div>
                            <div class="price-row">
                                <span>VAT (10%):</span>
                                <span>{{ number_format($taxAmount) }}₫</span>
                            </div>
                            <div class="price-row total">
                                <span>Tổng cộng:</span>
                                <span>{{ number_format($total) }}₫</span>
                            </div>
                        </div>
                        
                        <!-- Nút đặt hàng -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-checkout text-white">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Đặt Hàng Ngay
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Quay lại giỏ hàng
                            </a>
                        </div>
                        
                        <!-- Thông tin hỗ trợ -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <h6 class="mb-2">
                                <i class="fas fa-shield-alt text-success me-2"></i>
                                Cam kết của chúng tôi
                            </h6>
                            <ul class="list-unstyled small mb-0">
                                <li><i class="fas fa-check text-success me-1"></i> Bảo hành chính hãng</li>
                                <li><i class="fas fa-check text-success me-1"></i> Đổi trả trong 7 ngày</li>
                                <li><i class="fas fa-check text-success me-1"></i> Giao hàng toàn quốc</li>
                                <li><i class="fas fa-check text-success me-1"></i> Hỗ trợ 24/7</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle payment method selection
    const paymentMethods = document.querySelectorAll('.payment-method');
    const radioButtons = document.querySelectorAll('input[name="payment_method"]');
    
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            
            // Update visual state
            paymentMethods.forEach(m => m.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
    
    // Initialize selected state
    radioButtons.forEach(radio => {
        if (radio.checked) {
            radio.closest('.payment-method').classList.add('selected');
        }
    });
    
    // Form validation
    const form = document.getElementById('checkoutForm');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Vui lòng điền đầy đủ thông tin bắt buộc!');
        }
    });
    
    // Phone number formatting
    const phoneInput = document.getElementById('shipping_phone');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 10) {
            value = value.substring(0, 10);
        }
        this.value = value;
    });
});
</script>
@endsection
