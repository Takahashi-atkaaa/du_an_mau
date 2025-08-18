<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả sản phẩm
    public function getAllProduct()
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                JOIN product_categories c ON p.category_id = c.id 
                WHERE p.status = 'active' 
                ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy sản phẩm theo ID
    public function getProductById($id)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                JOIN product_categories c ON p.category_id = c.id 
                WHERE p.id = ? AND p.status = 'active'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Tìm sản phẩm theo tên
    public function searchProductsByName($keyword)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                JOIN product_categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? AND p.status = 'active' 
                ORDER BY p.name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll();
    }

    // Tìm sản phẩm theo danh mục
    public function getProductsByCategory($categoryId)
    {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                JOIN product_categories c ON p.category_id = c.id 
                WHERE p.category_id = ? AND p.status = 'active' 
                ORDER BY p.name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll();
    }

    // Tạo sản phẩm mới
    public function createProduct($data)
    {
        $sql = "INSERT INTO products (name, description, price, original_price, category_id, image, stock_quantity) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['description'] ?? null,
            $data['price'],
            $data['original_price'] ?? null,
            $data['category_id'],
            $data['image'] ?? null,
            $data['stock_quantity'] ?? 0
        ]);
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $data)
    {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, original_price = ?, 
                category_id = ?, image = ?, stock_quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['description'] ?? null,
            $data['price'],
            $data['original_price'] ?? null,
            $data['category_id'],
            $data['image'] ?? null,
            $data['stock_quantity'] ?? 0,
            $id
        ]);
    }

    // Xóa sản phẩm (soft delete)
    public function deleteProduct($id)
    {
        $sql = "UPDATE products SET status = 'inactive' WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Cập nhật số lượng tồn kho
    public function updateStock($id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$quantity, $id]);
    }
}
