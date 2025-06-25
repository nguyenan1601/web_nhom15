@extends('layouts.app')

@section('title', 'Giới Thiệu | PhoneShop')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="bg-white p-5 rounded shadow-sm">
                <h1 class="mb-4 text-primary"><i class="fas fa-store me-2"></i>Về PhoneShop</h1>

                <p class="fs-5">
                    <strong>PhoneShop</strong> là cửa hàng chuyên cung cấp các dòng điện thoại <span class="text-primary">chính hãng</span> như 
                    <strong>iPhone</strong>, <strong>Samsung</strong>, <strong>Xiaomi</strong>, <strong>Oppo</strong>, <strong>Vivo</strong>, <strong>Realme</strong>... 
                    với mức giá cạnh tranh cùng chất lượng dịch vụ vượt trội.
                </p>

                <p class="fs-5">
                    Với phương châm <span class="fw-bold text-danger">“Uy tín tạo nên thương hiệu”</span>, chúng tôi cam kết đem đến trải nghiệm mua sắm đáng tin cậy, 
                    bảo hành minh bạch và hỗ trợ khách hàng tận tình nhất.
                </p>

                <h3 class="mt-5 text-success"><i class="fas fa-check-circle me-2"></i>Tại sao chọn chúng tôi?</h3>
                <ul class="list-group list-group-flush my-3">
                    <li class="list-group-item"><i class="fas fa-star text-warning me-2"></i>Sản phẩm 100% chính hãng, nguyên seal</li>
                    <li class="list-group-item"><i class="fas fa-tags text-primary me-2"></i>Giá cả hợp lý, ưu đãi thường xuyên</li>
                    <li class="list-group-item"><i class="fas fa-shield-alt text-success me-2"></i>Bảo hành rõ ràng và minh bạch</li>
                    <li class="list-group-item"><i class="fas fa-headset text-info me-2"></i>Hỗ trợ khách hàng tận tâm 24/7</li>
                    <li class="list-group-item"><i class="fas fa-truck text-danger me-2"></i>Giao hàng nhanh chóng toàn quốc</li>
                </ul>

                <h3 class="mt-5 text-info"><i class="fas fa-address-book me-2"></i>Thông Tin Liên Hệ</h3>
                <div class="mt-3">
                    <p><i class="fas fa-map-marker-alt text-danger me-2"></i>123 Đường ABC, Quận Hà Đông, Hà Nội</p>
                    <p><i class="fas fa-phone-alt text-success me-2"></i>0123 456 789</p>
                    <p><i class="fas fa-envelope text-warning me-2"></i>info@phoneshop.vn</p>
                    <p><i class="fas fa-clock text-primary me-2"></i>Thời gian mở cửa: Thứ 2 - Chủ nhật, 8:00 - 22:00</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
