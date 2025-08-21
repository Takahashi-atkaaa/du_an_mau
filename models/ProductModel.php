<?php 
class ProductModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả sản phẩm
    public function all() {
        $sql = "SELECT * FROM product";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 sản phẩm theo ID
    public function find($id) {
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm
    public function insert($data) {
        $sql = "INSERT INTO product (name, image, price, idcategory, description, hot, view, discount) 
                VALUES (:name, :image, :price, :idcategory, :description, :hot, :view, :discount)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $data) {
        $sql = "UPDATE product 
                SET name=:name, image=:image, price=:price, idcategory=:idcategory, 
                    description=:description, hot=:hot, view=:view, discount=:discount
                WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Xóa sản phẩm
    public function delete($id) {
        // Xóa comment liên quan trước
        $sql = "DELETE FROM comment WHERE idproduct = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    
        // Sau đó mới xóa sản phẩm
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
