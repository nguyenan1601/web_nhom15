# Hướng dẫn Setup Database cho Cửa hàng Điện thoại

## 1. Chuẩn bị môi trường

### Yêu cầu hệ thống:

-   XAMPP (hoặc WAMP/LAMP)
-   PHP >= 8.1
-   MySQL >= 8.0
-   Composer

## 2. Cấu hình Database

### Bước 1: Khởi động XAMPP

1. Mở XAMPP Control Panel
2. Start Apache và MySQL

### Bước 2: Tạo Database

1. Mở phpMyAdmin (http://localhost/phpmyadmin)
2. Tạo database mới tên `phone_shop_db`
3. Hoặc chạy SQL script trong file `create_database.sql`

### Bước 3: Cấu hình .env

Cập nhật file `.env` với thông tin database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=phone_shop_db
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Chạy Migration

### Cài đặt dependencies:

```bash
composer install
```

### Tạo APP_KEY:

```bash
php artisan key:generate
```

### Chạy migration:

```bash
php artisan migrate
```

## 4. Cấu trúc Database

### Các bảng chính:

#### 1. **phones** - Sản phẩm điện thoại

-   Thông tin cơ bản: tên, model, thương hiệu
-   Giá cả: giá bán, giá gốc, giảm giá
-   Thông số: RAM, storage, camera, pin, v.v.
-   Quản lý: tồn kho, trạng thái, SKU

#### 2. **brands** - Thương hiệu

-   Tên thương hiệu, slug, logo
-   Thông tin: quốc gia, website
-   Trạng thái và sắp xếp

#### 3. **categories** - Danh mục sản phẩm

-   Tên danh mục, trạng thái
-   Thứ tự sắp xếp

#### 4. **customers** - Khách hàng

-   Thông tin cá nhân: họ tên, email, SĐT
-   Địa chỉ: địa chỉ, thành phố, quốc gia
-   Bảo mật: mật khẩu, xác thực
-   Trạng thái tài khoản

#### 5. **orders** - Đơn hàng

-   Thông tin đơn hàng: mã số, trạng thái
-   Thanh toán: tổng tiền, phương thức, trạng thái
-   Giao hàng: địa chỉ, thông tin người nhận
-   Theo dõi: thời gian giao, nhận

#### 6. **order_items** - Chi tiết đơn hàng

-   Sản phẩm trong đơn: tên, SKU, màu sắc
-   Giá và số lượng tại thời điểm mua
-   Thông tin bảo hành

#### 7. **phone_images** - Hình ảnh sản phẩm

-   Đường dẫn ảnh, loại ảnh
-   Ảnh chính, gallery, thumbnail
-   Biến thể theo màu sắc

#### 8. **reviews** - Đánh giá sản phẩm

-   Điểm đánh giá (1-5 sao)
-   Nội dung, ưu/nhược điểm
-   Xác thực mua hàng
-   Phản hồi admin

#### 9. **coupons** - Mã giảm giá

-   Mã coupon, tên chương trình
-   Loại giảm: cố định hoặc %
-   Điều kiện: đơn tối thiểu, giới hạn sử dụng
-   Phạm vi áp dụng: danh mục, thương hiệu

#### 10. **wishlists** - Danh sách yêu thích

-   Sản phẩm yêu thích của khách hàng
-   Thông báo giảm giá
-   Giá mong muốn

## 5. Các tính năng nâng cao

### Foreign Keys được thiết lập:

-   `phones.category_id` → `categories.id`
-   `phones.brand_id` → `brands.id`
-   `orders.customer_id` → `customers.id`
-   `order_items.order_id` → `orders.id`
-   `order_items.phone_id` → `phones.id`
-   `phone_images.phone_id` → `phones.id`
-   `reviews.phone_id` → `phones.id`
-   `reviews.customer_id` → `customers.id`
-   `wishlists.customer_id` → `customers.id`
-   `wishlists.phone_id` → `phones.id`

### Unique constraints:

-   Email khách hàng
-   SKU sản phẩm
-   Mã đơn hàng
-   Mã coupon
-   1 khách hàng chỉ đánh giá 1 lần/sản phẩm
-   1 khách hàng chỉ thêm 1 lần/sản phẩm vào wishlist

## 6. Seeder (Tùy chọn)

Có thể tạo dữ liệu mẫu bằng cách chạy:

```bash
php artisan db:seed
```

## 7. Troubleshooting

### Lỗi kết nối database:

1. Kiểm tra XAMPP đã start MySQL chưa
2. Kiểm tra thông tin trong file `.env`
3. Đảm bảo database `phone_shop_db` đã được tạo

### Lỗi foreign key:

1. Chạy migration theo đúng thứ tự
2. Đảm bảo bảng cha đã được tạo trước bảng con

### Lỗi permission:

1. Đảm bảo MySQL user có quyền tạo database
2. Kiểm tra quyền ghi thư mục storage/

---

**Lưu ý**: Đây là cấu trúc cơ bản cho một cửa hàng điện thoại. Có thể mở rộng thêm các tính năng như:

-   Quản lý kho (inventory tracking)
-   Khuyến mãi phức tạp
-   Tích hợp thanh toán
-   Báo cáo và thống kê
-   API cho mobile app
