# HƯỚNG DẪN KIỂM TRA WEBSITE BÁN ĐIỆN THOẠI

## 1. KHỞI ĐỘNG WEBSITE

1. Mở Terminal/Command Prompt
2. Chạy lệnh:
   ```
   cd c:\xampp\htdocs\web_nhom15\phone-shop
   php artisan serve
   ```
3. Truy cập: http://localhost:8000

## 2. KIỂM TRA CHỨC NĂNG CHÍNH 

### A. TRANG CHỦ
- [✓] Hiển thị sản phẩm nổi bật
- [✓] Hiển thị categories
- [✓] Hiển thị sản phẩm mới
- [✓] Bấm vào ảnh sản phẩm chuyển đến trang chi tiết

### B. TRANG DANH SÁCH SẢN PHẨM
- [✓] Hiển thị tất cả sản phẩm
- [✓] Filter theo thương hiệu, giá
- [✓] Sort theo giá, tên
- [✓] Bấm vào ảnh sản phẩm chuyển đến trang chi tiết

### C. TRANG CHI TIẾT SẢN PHẨM
#### Khi CHƯA đăng nhập:
- [✓] Hiển thị thông tin sản phẩm
- [✓] Hiển thị thông báo yêu cầu đăng nhập
- [✓] Nút "ĐĂNG NHẬP ĐỂ MUA NGAY" chuyển đến trang login

#### Khi ĐÃ đăng nhập:
- [✓] Hiển thị form chọn màu sắc và số lượng
- [✓] Validate màu sắc (bắt buộc chọn)
- [✓] Validate số lượng (1 <= số lượng <= tồn kho)
- [✓] Nút "MUA NGAY" - thêm vào giỏ và chuyển đến checkout
- [✓] Nút "Thêm vào giỏ hàng" - chỉ thêm vào giỏ

### D. ĐĂNG KÝ / ĐĂNG NHẬP
#### Đăng ký:
- [✓] Validate họ tên (bắt buộc)
- [✓] Validate email (bắt buộc, unique)
- [✓] Validate mật khẩu (min 6 ký tự, xác nhận khớp)
- [✓] Tự động đăng nhập sau khi đăng ký thành công

#### Đăng nhập:
- [✓] Validate email và mật khẩu
- [✓] Chuyển hướng về trang trước đó hoặc trang chủ
- [✓] Merge giỏ hàng session vào user

### E. GIỎ HÀNG
- [✓] Hiển thị sản phẩm trong giỏ (từ database)
- [✓] Hiển thị màu sắc, số lượng, tổng tiền
- [✓] Link tên sản phẩm về trang chi tiết
- [✓] Nút xóa sản phẩm khỏi giỏ
- [✓] Nút "Thanh toán" chuyển đến checkout

### F. THANH TOÁN
- [✓] Hiển thị danh sách sản phẩm từ giỏ hàng
- [✓] Tính toán phí ship, thuế, tổng cộng
- [✓] Form thông tin giao hàng (validate đầy đủ)
- [✓] Chọn phương thức thanh toán
- [✓] Đặt hàng thành công tạo Order + OrderItems
- [✓] Xóa giỏ hàng sau khi đặt hàng
- [✓] Chuyển đến trang success

### G. QUẢN LÝ ĐỒN HÀNG
- [✓] Hiển thị danh sách đơn hàng của user
- [✓] Chi tiết đơn hàng
- [✓] Trạng thái các đơn hàng

## 3. KIỂM TRA TÍNH NĂNG NÂNG CAO

### A. Responsive Design
- [✓] Mobile-friendly
- [✓] Tablet view
- [✓] Desktop view

### B. User Experience
- [✓] Loading states
- [✓] Error messages
- [✓] Success notifications
- [✓] Form validation

### C. Security
- [✓] CSRF protection
- [✓] Authentication middleware
- [✓] Input validation
- [✓] SQL injection prevention

## 4. TEST CASES CỤ THỂ

### Test Case 1: Đăng ký tài khoản mới
1. Truy cập /register
2. Nhập thông tin hợp lệ
3. Bấm "Đăng ký"
4. Kiểm tra: tự động đăng nhập, chuyển về trang chủ

### Test Case 2: Mua hàng (user chưa đăng nhập)
1. Vào trang chi tiết sản phẩm
2. Kiểm tra: hiển thị thông báo cần đăng nhập
3. Bấm "ĐĂNG NHẬP ĐỂ MUA NGAY"
4. Đăng nhập thành công
5. Kiểm tra: chuyển về trang sản phẩm ban đầu

### Test Case 3: Thêm vào giỏ hàng
1. Đăng nhập
2. Vào trang chi tiết sản phẩm
3. Chọn màu sắc và số lượng
4. Bấm "Thêm vào giỏ hàng"
5. Kiểm tra: thông báo thành công
6. Vào giỏ hàng kiểm tra sản phẩm

### Test Case 4: Mua ngay
1. Đăng nhập
2. Vào trang chi tiết sản phẩm
3. Chọn màu sắc và số lượng
4. Bấm "MUA NGAY"
5. Kiểm tra: chuyển thẳng đến trang thanh toán

### Test Case 5: Thanh toán
1. Có sản phẩm trong giỏ hàng
2. Vào trang thanh toán
3. Điền thông tin giao hàng
4. Chọn phương thức thanh toán
5. Bấm "Đặt hàng"
6. Kiểm tra: tạo đơn hàng, xóa giỏ hàng, chuyển đến success

### Test Case 6: Validate form
1. Thử submit form trống
2. Thử nhập email không hợp lệ
3. Thử nhập số lượng vượt quá tồn kho
4. Thử không chọn màu sắc
5. Kiểm tra: hiển thị lỗi phù hợp

## 5. KHẮC PHỤC SỰ CỐ

### Nếu gặp lỗi 500:
1. Kiểm tra log: `storage/logs/laravel.log`
2. Kiểm tra database connection
3. Chạy: `php artisan cache:clear`

### Nếu không thêm được vào giỏ hàng:
1. Kiểm tra JS console có lỗi không
2. Kiểm tra network tab trong browser
3. Kiểm tra CartController logs

### Nếu không đăng nhập được:
1. Kiểm tra AuthController
2. Kiểm tra session driver trong .env
3. Kiểm tra database users table

## 6. KẾT LUẬN

Website đã hoàn thiện các tính năng chính:
- ✅ Giao diện responsive, hiện đại
- ✅ Chức năng đăng ký/đăng nhập
- ✅ Giỏ hàng lưu trữ database
- ✅ Thanh toán đầy đủ
- ✅ Quản lý đơn hàng
- ✅ Validation form đầy đủ
- ✅ Security measures
- ✅ Error handling

Hệ thống sẵn sàng để demo và sử dụng!
