<?php
class CustomerModel 
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả khách hàng
    public function getAllCustomers()
    {
        $sql = "SELECT c.*, u.username, u.role 
                FROM customers c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE c.status = 'active' 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy khách hàng theo ID
    public function getCustomerById($id)
    {
        $sql = "SELECT c.*, u.username, u.role 
                FROM customers c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE c.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Lấy khách hàng theo user_id
    public function getCustomerByUserId($userId)
    {
        $sql = "SELECT * FROM customers WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    // Tạo khách hàng mới
    public function createCustomer($data)
    {
        $sql = "INSERT INTO customers (user_id, full_name, email, phone, address) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['user_id'] ?? null,
            $data['full_name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['address'] ?? null
        ]);
    }

    // Cập nhật thông tin khách hàng
    public function updateCustomer($id, $data)
    {
        $sql = "UPDATE customers SET full_name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['full_name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $id
        ]);
    }

    // Xóa khách hàng (soft delete)
    public function deleteCustomer($id)
    {
        $sql = "UPDATE customers SET status = 'inactive' WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Cập nhật thống kê khách hàng
    public function updateCustomerStats($id, $totalOrders, $totalSpent)
    {
        $sql = "UPDATE customers SET total_orders = ?, total_spent = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$totalOrders, $totalSpent, $id]);
    }

    // Tìm kiếm khách hàng
    public function searchCustomers($keyword)
    {
        $sql = "SELECT c.*, u.username, u.role 
                FROM customers c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE (c.full_name LIKE ? OR c.email LIKE ? OR c.phone LIKE ?) 
                AND c.status = 'active' 
                ORDER BY c.full_name";
        $stmt = $this->conn->prepare($sql);
        $searchTerm = '%' . $keyword . '%';
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }

    // Đếm tổng số khách hàng
    public function countCustomers()
    {
        $sql = "SELECT COUNT(*) FROM customers WHERE status = 'active'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Lấy top khách hàng theo tổng chi tiêu
    public function getTopCustomers($limit = 10)
    {
        $sql = "SELECT c.*, u.username 
                FROM customers c 
                LEFT JOIN users u ON c.user_id = u.id 
                WHERE c.status = 'active' 
                ORDER BY c.total_spent DESC 
                LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
