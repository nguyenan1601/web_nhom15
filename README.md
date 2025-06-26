# PhoneShop Laravel Project

## Mô tả
Đây là dự án website bán điện thoại được xây dựng bằng Laravel. Hệ thống hỗ trợ quản lý sản phẩm, thương hiệu, danh mục, người dùng, đơn hàng và có phân quyền admin.

## Tính năng chính
- Đăng ký, đăng nhập, đăng xuất (Laravel Breeze, custom route)
- Quản lý sản phẩm, thương hiệu, danh mục
- Quản lý người dùng (admin có thể xoá user)
- Quản lý đơn hàng
- Trang chủ, tìm kiếm, chi tiết sản phẩm, giỏ hàng, thanh toán
- Dashboard admin với thống kê nhanh
- Phân quyền: chỉ admin mới truy cập được trang quản trị

## Tài khoản mẫu
- **Admin:**
  - Email: `admin@gmail.com`
  - Mật khẩu: `admin123`
- **User:**
  - Email: `user1@gmail.com` / `user2@gmail.com` / `user3@gmail.com`
  - Mật khẩu: `user123`

## Cài đặt & chạy dự án
1. Clone project về máy
2. Cài đặt các package:
   ```bash
   composer install
   npm install
   npm run build
   ```
3. Tạo file `.env` và cấu hình database
4. Tạo database, sau đó chạy:
   ```bash
   php artisan migrate --seed
   ```
5. Khởi động server:
   ```bash
   php artisan serve
   ```
6. Truy cập: http://127.0.0.1:8000

## Một số lệnh hữu ích
- Seed lại dữ liệu:
  ```bash
  php artisan migrate:fresh --seed
  ```
- Seed lại user:
  ```bash
  php artisan db:seed --class=UserSeeder
  ```

## Thư mục chính
- `app/Http/Controllers`: Controller cho web & admin
- `app/Models`: Model Eloquent
- `database/migrations`: Các file migration
- `database/seeders`: Các file seeder dữ liệu mẫu
- `resources/views`: Giao diện Blade
- `routes/web.php`: Định nghĩa route

## Đóng góp & phát triển
- Fork, tạo branch mới và gửi pull request nếu muốn đóng góp thêm tính năng.

---

> Dự án phục vụ mục đích học tập và demo!
