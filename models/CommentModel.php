<?php
class CommentModel 
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả bình luận
    public function all() {
        $sql = "SELECT c.*, u.name as user_name, p.name as product_name 
                FROM Comment c
                JOIN User u ON c.iduser = u.id
                JOIN Product p ON c.idproduct = p.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy bình luận theo ID
    public function getCommentById($id)
    {
        $sql = "SELECT c.*, u.name as user_name, p.name as product_name 
                FROM Comment c 
                JOIN User u ON c.iduser = u.id 
                JOIN Product p ON c.idproduct = p.id 
                WHERE c.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo bình luận mới
    public function createComment($data)
    {
        $sql = "INSERT INTO Comment (idproduct, iduser, content, date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['idproduct'],
            $data['iduser'],
            $data['content'],
            date('Y-m-d H:i:s')
        ]);
    }

    // Xóa bình luận
    public function deleteComment($id)
    {
        $sql = "DELETE FROM Comment WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
