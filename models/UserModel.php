<?php
class UserModel 
{
    public $conn;
    
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Đăng nhập
    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = ? AND status = 'active'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Lấy thông tin user theo ID
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Tạo user mới
    public function createUser($data)
    {
        $sql = "INSERT INTO users (username, email, password, full_name, phone, address, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute([
            $data['username'],
            $data['email'],
            $hashedPassword,
            $data['full_name'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['role'] ?? 'user'
        ]);
    }

    // Cập nhật thông tin user
    public function updateUser($id, $data)
    {
        $sql = "UPDATE users SET full_name = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['full_name'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $id
        ]);
    }

    // Kiểm tra username đã tồn tại
    public function checkUsernameExists($username)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchColumn() > 0;
    }

    // Kiểm tra email đã tồn tại
    public function checkEmailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}
