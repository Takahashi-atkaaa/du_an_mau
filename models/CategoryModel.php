<?php
class CategoryModel 
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $sql = "SELECT * FROM product_categories WHERE status = 'active' ORDER BY name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM product_categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Tạo danh mục mới
    public function createCategory($data)
    {
        $sql = "INSERT INTO product_categories (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['description'] ?? null
        ]);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $data)
    {
        $sql = "UPDATE product_categories SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['description'] ?? null,
            $id
        ]);
    }

    // Xóa danh mục (soft delete)
    public function deleteCategory($id)
    {
        $sql = "UPDATE product_categories SET status = 'inactive' WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Đếm số sản phẩm trong danh mục
    public function countProductsInCategory($categoryId)
    {
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = ? AND status = 'active'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }
}
