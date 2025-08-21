<?php
require_once __DIR__ . '/../commons/function.php';



class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy tất cả user
    public function all() {
        $sql = "SELECT * FROM user";
        $stmt = $this->conn->prepare($sql);
       $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


   
    public function delete($id){
        // Xóa comment trước
        $sql = "DELETE FROM comment WHERE iduser = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Sau đó mới xóa user
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function create($data)
{
    $sql = "INSERT INTO user (name, email, phone, password, role, active) 
            VALUES (:name, :email, :phone, :password, :role, :active)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':name'     => $data['name'],
        ':email'    => $data['email'],
        ':phone'    => $data['phone'],
        ':password' => $data['password'],
        ':role'     => $data['role'],
        ':active'   => $data['active']
    ]);
}
public function findByEmail($email)
{
    $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
