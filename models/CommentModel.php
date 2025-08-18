<?php
class CommentModel 
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả bình luận của sản phẩm
    public function getCommentsByProduct($productId, $status = 'approved')
    {
        $sql = "SELECT c.*, u.full_name, u.username 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.product_id = ? AND c.status = ? 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productId, $status]);
        return $stmt->fetchAll();
    }

    // Lấy bình luận theo ID
    public function getCommentById($id)
    {
        $sql = "SELECT c.*, u.full_name, u.username, p.name as product_name 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                JOIN products p ON c.product_id = p.id 
                WHERE c.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Tạo bình luận mới
    public function createComment($data)
    {
        $sql = "INSERT INTO comments (product_id, user_id, content, rating) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['product_id'],
            $data['user_id'],
            $data['content'],
            $data['rating'] ?? null
        ]);
    }

    // Cập nhật trạng thái bình luận
    public function updateCommentStatus($id, $status)
    {
        $sql = "UPDATE comments SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    // Xóa bình luận
    public function deleteComment($id)
    {
        $sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Lấy tất cả bình luận chờ duyệt (cho admin)
    public function getPendingComments()
    {
        $sql = "SELECT c.*, u.full_name, u.username, p.name as product_name 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                JOIN products p ON c.product_id = p.id 
                WHERE c.status = 'pending' 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Đếm số bình luận theo trạng thái
    public function countCommentsByStatus($status)
    {
        $sql = "SELECT COUNT(*) FROM comments WHERE status = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchColumn();
    }

    // Tính điểm đánh giá trung bình của sản phẩm
    public function getAverageRating($productId)
    {
        $sql = "SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings 
                FROM comments 
                WHERE product_id = ? AND status = 'approved' AND rating IS NOT NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$productId]);
        return $stmt->fetch();
    }
}
