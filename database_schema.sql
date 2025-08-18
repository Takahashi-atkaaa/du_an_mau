-- Database Schema for LaptopCu-shop System
-- Based on Use Case Diagram

-- Create database
CREATE DATABASE IF NOT EXISTS `duanmau` 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `duanmau`;

-- Table: users (Người dùng)
CREATE TABLE `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(50) UNIQUE NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(15),
    `address` TEXT,
    `role` ENUM('user', 'admin') DEFAULT 'user',
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: product_categories (Loại hàng hoá)
CREATE TABLE `product_categories` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: products (Hàng hoá)
CREATE TABLE `products` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10,2) NOT NULL,
    `original_price` DECIMAL(10,2),
    `category_id` INT NOT NULL,
    `image` VARCHAR(255),
    `stock_quantity` INT DEFAULT 0,
    `status` ENUM('active', 'inactive', 'out_of_stock') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`category_id`) REFERENCES `product_categories`(`id`) ON DELETE CASCADE
);

-- Table: customers (Khách hàng)
CREATE TABLE `customers` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT,
    `full_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `phone` VARCHAR(15),
    `address` TEXT,
    `total_orders` INT DEFAULT 0,
    `total_spent` DECIMAL(10,2) DEFAULT 0.00,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
);

-- Table: comments (Bình luận)
CREATE TABLE `comments` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `content` TEXT NOT NULL,
    `rating` INT CHECK (rating >= 1 AND rating <= 5),
    `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

-- Table: orders (Đơn hàng)
CREATE TABLE `orders` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `customer_id` INT NOT NULL,
    `order_number` VARCHAR(50) UNIQUE NOT NULL,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `status` ENUM('pending', 'confirmed', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    `shipping_address` TEXT,
    `shipping_phone` VARCHAR(15),
    `notes` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE
);

-- Table: order_items (Chi tiết đơn hàng)
CREATE TABLE `order_items` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
);

-- Table: search_logs (Nhật ký tìm kiếm)
CREATE TABLE `search_logs` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT,
    `search_term` VARCHAR(200) NOT NULL,
    `search_type` ENUM('by_name', 'by_category') NOT NULL,
    `results_count` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
);

-- Insert sample data

-- Insert admin user
INSERT INTO `users` (`username`, `email`, `password`, `full_name`, `role`) VALUES
('admin', 'admin@laptopcu.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin');

-- Insert product categories
INSERT INTO `product_categories` (`name`, `description`) VALUES
('Laptop Gaming', 'Laptop chuyên dụng cho game thủ'),
('Laptop Văn phòng', 'Laptop phù hợp cho công việc văn phòng'),
('Laptop Đồ họa', 'Laptop chuyên dụng cho thiết kế đồ họa'),
('Laptop Sinh viên', 'Laptop giá rẻ phù hợp cho sinh viên');

-- Insert sample products
INSERT INTO `products` (`name`, `description`, `price`, `original_price`, `category_id`, `stock_quantity`) VALUES
('Laptop Gaming ASUS ROG', 'Laptop gaming hiệu năng cao với card đồ họa RTX 4060', 25000000, 28000000, 1, 10),
('Laptop Dell Inspiron', 'Laptop văn phòng bền bỉ, pin trâu', 15000000, 17000000, 2, 15),
('Laptop MacBook Pro', 'Laptop đồ họa chuyên nghiệp', 35000000, 38000000, 3, 5),
('Laptop HP Pavilion', 'Laptop sinh viên giá rẻ', 12000000, 14000000, 4, 20);

-- Insert sample customer
INSERT INTO `customers` (`full_name`, `email`, `phone`, `address`) VALUES
('Nguyễn Văn A', 'nguyenvana@email.com', '0123456789', 'Hà Nội, Việt Nam');

-- Create indexes for better performance
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_products_status ON products(status);
CREATE INDEX idx_comments_product ON comments(product_id);
CREATE INDEX idx_comments_user ON comments(user_id);
CREATE INDEX idx_orders_customer ON orders(customer_id);
CREATE INDEX idx_search_logs_user ON search_logs(user_id);
