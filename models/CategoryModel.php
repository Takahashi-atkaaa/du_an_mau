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
        $sql = "SELECT id, name FROM Category ORDER BY name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục theo ID
    public function getCategoryById($id)
    {
        $sql = "SELECT id, name FROM Category WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo danh mục mới
    public function createCategory($data)
    {
        $sql = "INSERT INTO Category (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name']
        ]);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $data)
    {
        $sql = "UPDATE Category SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $id
        ]);
    }


    public function deleteCategory($id)
    {
        // Xóa sản phẩm thuộc category trước (hoặc soft delete)
        $sql1 = "DELETE FROM Product WHERE idcategory = ?";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute([$id]);
    
        // Sau đó mới xóa category
        $sql2 = "DELETE FROM Category WHERE id = ?";
        $stmt2 = $this->conn->prepare($sql2);
        return $stmt2->execute([$id]);
    }

}
