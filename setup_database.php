<?php
// Script tạo database cho LaptopCu-shop
// Chạy file này để tạo database và các bảng

// Kết nối MySQL không chọn database
try {
    $pdo = new PDO("mysql:host=localhost;port=3306", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối MySQL thành công!\n";
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

// Tạo database
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `duanmau` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Tạo database 'duanmau' thành công!\n";
} catch (PDOException $e) {
    die("Lỗi tạo database: " . $e->getMessage());
}

// Chọn database
$pdo->exec("USE `laptopcu_shop`");

// Đọc và thực thi file SQL
$sqlFile = 'database_schema.sql';
if (file_exists($sqlFile)) {
    $sql = file_get_contents($sqlFile);
    
    // Tách các câu lệnh SQL
    $statements = explode(';', $sql);
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            try {
                $pdo->exec($statement);
                echo "Thực thi câu lệnh SQL thành công!\n";
            } catch (PDOException $e) {
                echo "Lỗi thực thi SQL: " . $e->getMessage() . "\n";
            }
        }
    }
    
    echo "\n=== HOÀN THÀNH TẠO DATABASE ===\n";
    echo "Database: duanmau\n";
    echo "Các bảng đã được tạo:\n";
    echo "- users (Người dùng)\n";
    echo "- product_categories (Loại hàng hoá)\n";
    echo "- products (Hàng hoá)\n";
    echo "- customers (Khách hàng)\n";
    echo "- comments (Bình luận)\n";
    echo "- orders (Đơn hàng)\n";
    echo "- order_items (Chi tiết đơn hàng)\n";
    echo "- search_logs (Nhật ký tìm kiếm)\n";
    echo "\nDữ liệu mẫu đã được thêm vào!\n";
    echo "Tài khoản admin: admin / password\n";
    
} else {
    echo "Không tìm thấy file database_schema.sql\n";
}
?>
