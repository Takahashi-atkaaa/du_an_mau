# Database Schema - LaptopCu-shop

## Tổng quan

Database được thiết kế dựa trên Use Case Diagram của hệ thống LaptopCu-shop, hỗ trợ đầy đủ các chức năng cho cả người dùng và quản trị viên.

## Cấu trúc Database

### 1. Bảng `users` (Người dùng)

- **Mục đích**: Lưu trữ thông tin người dùng và quản trị viên
- **Các trường chính**:
  - `id`: Khóa chính
  - `username`: Tên đăng nhập (unique)
  - `email`: Email (unique)
  - `password`: Mật khẩu (đã mã hóa)
  - `full_name`: Họ tên đầy đủ
  - `role`: Vai trò (user/admin)
  - `status`: Trạng thái (active/inactive)

### 2. Bảng `product_categories` (Loại hàng hoá)

- **Mục đích**: Quản lý danh mục sản phẩm
- **Các trường chính**:
  - `id`: Khóa chính
  - `name`: Tên danh mục
  - `description`: Mô tả danh mục
  - `status`: Trạng thái (active/inactive)

### 3. Bảng `products` (Hàng hoá)

- **Mục đích**: Lưu trữ thông tin sản phẩm
- **Các trường chính**:
  - `id`: Khóa chính
  - `name`: Tên sản phẩm
  - `description`: Mô tả sản phẩm
  - `price`: Giá hiện tại
  - `original_price`: Giá gốc
  - `category_id`: Khóa ngoại đến bảng categories
  - `image`: Đường dẫn hình ảnh
  - `stock_quantity`: Số lượng tồn kho
  - `status`: Trạng thái (active/inactive/out_of_stock)

### 4. Bảng `customers` (Khách hàng)

- **Mục đích**: Quản lý thông tin khách hàng
- **Các trường chính**:
  - `id`: Khóa chính
  - `user_id`: Khóa ngoại đến bảng users (có thể null)
  - `full_name`: Họ tên khách hàng
  - `email`: Email (unique)
  - `phone`: Số điện thoại
  - `address`: Địa chỉ
  - `total_orders`: Tổng số đơn hàng
  - `total_spent`: Tổng chi tiêu

### 5. Bảng `comments` (Bình luận)

- **Mục đích**: Lưu trữ bình luận và đánh giá sản phẩm
- **Các trường chính**:
  - `id`: Khóa chính
  - `product_id`: Khóa ngoại đến bảng products
  - `user_id`: Khóa ngoại đến bảng users
  - `content`: Nội dung bình luận
  - `rating`: Điểm đánh giá (1-5)
  - `status`: Trạng thái (pending/approved/rejected)

### 6. Bảng `orders` (Đơn hàng)

- **Mục đích**: Quản lý đơn hàng
- **Các trường chính**:
  - `id`: Khóa chính
  - `customer_id`: Khóa ngoại đến bảng customers
  - `order_number`: Mã đơn hàng (unique)
  - `total_amount`: Tổng tiền
  - `status`: Trạng thái đơn hàng
  - `shipping_address`: Địa chỉ giao hàng
  - `shipping_phone`: SĐT giao hàng

### 7. Bảng `order_items` (Chi tiết đơn hàng)

- **Mục đích**: Lưu trữ chi tiết từng sản phẩm trong đơn hàng
- **Các trường chính**:
  - `id`: Khóa chính
  - `order_id`: Khóa ngoại đến bảng orders
  - `product_id`: Khóa ngoại đến bảng products
  - `quantity`: Số lượng
  - `price`: Giá tại thời điểm mua

### 8. Bảng `search_logs` (Nhật ký tìm kiếm)

- **Mục đích**: Theo dõi hoạt động tìm kiếm của người dùng
- **Các trường chính**:
  - `id`: Khóa chính
  - `user_id`: Khóa ngoại đến bảng users (có thể null)
  - `search_term`: Từ khóa tìm kiếm
  - `search_type`: Loại tìm kiếm (by_name/by_category)
  - `results_count`: Số kết quả tìm được

## Cài đặt Database

### Cách 1: Sử dụng script tự động

```bash
php setup_database.php
```

### Cách 2: Thực thi thủ công

1. Tạo database `duanmau` trong MySQL
2. Import file `database_schema.sql`
3. Cập nhật thông tin kết nối trong `commons/env.php`

## Dữ liệu mẫu

### Tài khoản Admin

- **Username**: admin
- **Password**: password
- **Email**: admin@laptopcu.com

### Danh mục sản phẩm

- Laptop Gaming
- Laptop Văn phòng
- Laptop Đồ họa
- Laptop Sinh viên

### Sản phẩm mẫu

- Laptop Gaming ASUS ROG (25,000,000 VNĐ)
- Laptop Dell Inspiron (15,000,000 VNĐ)
- Laptop MacBook Pro (35,000,000 VNĐ)
- Laptop HP Pavilion (12,000,000 VNĐ)

## Mối quan hệ giữa các bảng

```
users (1) ←→ (1) customers
users (1) ←→ (N) comments
users (1) ←→ (N) search_logs

product_categories (1) ←→ (N) products
products (1) ←→ (N) comments
products (1) ←→ (N) order_items

customers (1) ←→ (N) orders
orders (1) ←→ (N) order_items
```

## Các Model Classes

1. **UserModel**: Quản lý người dùng và xác thực
2. **CategoryModel**: Quản lý danh mục sản phẩm
3. **ProductModel**: Quản lý sản phẩm và tìm kiếm
4. **CommentModel**: Quản lý bình luận và đánh giá
5. **CustomerModel**: Quản lý khách hàng

## Lưu ý bảo mật

- Mật khẩu được mã hóa bằng `password_hash()`
- Sử dụng prepared statements để tránh SQL injection
- Có các ràng buộc khóa ngoại để đảm bảo tính toàn vẹn dữ liệu
- Soft delete cho các bảng quan trọng
