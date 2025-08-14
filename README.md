# Dự Án MVC - Website Feane Restaurant

## 📋 Mô Tả
Dự án MVC (Model-View-Controller) tích hợp website Feane Restaurant với giao diện đẹp và hiện đại.

## 🏗️ Cấu Trúc Dự Án

```
mvc/
├── commons/           # File cấu hình và hàm hỗ trợ
│   ├── env.php       # Cấu hình môi trường
│   └── function.php  # Các hàm tiện ích
├── controllers/       # Controllers xử lý logic
│   ├── ProductController.php
│   └── FeaneController.php
├── models/           # Models tương tác database
│   └── ProductModel.php
├── views/            # Views hiển thị giao diện
│   ├── trangchu.php
│   └── feane/
│       ├── header.php
│       ├── footer.php
│       ├── home.php
│       ├── about.php
│       ├── menu.php
│       └── book.php
├── public/           # Tài nguyên tĩnh
│   ├── css/         # File CSS
│   ├── js/          # File JavaScript
│   ├── images/      # Hình ảnh
│   └── fonts/       # Font chữ
├── uploads/         # Thư mục upload file
└── index.php        # File điều hướng chính
```

## 🚀 Tính Năng

### Website Feane Restaurant
- **Trang Chủ**: Hiển thị slider, menu nổi bật, ưu đãi
- **Menu**: Danh sách đầy đủ các món ăn với bộ lọc
- **About**: Thông tin về nhà hàng
- **Book Table**: Form đặt bàn trực tuyến

### Mô Hình MVC
- **Model**: Xử lý dữ liệu và tương tác database
- **View**: Hiển thị giao diện người dùng
- **Controller**: Xử lý logic nghiệp vụ

## 🛠️ Cài Đặt

1. **Clone repository:**
```bash
git clone https://github.com/Takahashi-atkaaa/du_an_mau.git
cd du_an_mau/mvc
```

2. **Cấu hình web server:**
- Đặt thư mục dự án vào thư mục web server (htdocs, www, etc.)
- Đảm bảo PHP được cài đặt và bật

3. **Truy cập website:**
```
http://localhost/du_an_mau/mvc/
```

## 📱 Các Trang Chính

- **Trang chủ**: `index.php?act=/`
- **Menu**: `index.php?act=menu`
- **About**: `index.php?act=about`
- **Book Table**: `index.php?act=book`

## 🎨 Giao Diện

Website sử dụng:
- **Bootstrap 4** cho responsive design
- **Font Awesome** cho icons
- **Owl Carousel** cho slider
- **Isotope** cho filter menu
- **Google Maps** cho bản đồ

## 📁 Tài Nguyên

- **CSS**: Bootstrap, Custom styles, Responsive
- **JavaScript**: jQuery, Bootstrap, Custom scripts
- **Images**: 16 file ảnh chất lượng cao
- **Fonts**: Font Awesome webfonts

## 👨‍💻 Tác Giả

Dự án được phát triển bởi [Takahashi-atkaaa](https://github.com/Takahashi-atkaaa)

## 📄 License

Dự án này được phân phối dưới giấy phép MIT.

---

⭐ Nếu dự án này hữu ích, hãy cho một star nhé!
