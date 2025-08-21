<?php
class loginController {

    // Đăng nhập admin bằng tài khoản cố định 'ad' / '1'
    public function admin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if ($username === 'ad' && $password === '1') {
                $_SESSION['user'] = [
                    'id'    => 0,
                    'name'  => 'Admin',
                    'email' => 'admin@example.com',
                    'role'  => 'admin'
                ];
                header('Location: ?act=admin_dashboard');
                exit;
            } else {
                $error = 'Sai tên đăng nhập hoặc mật khẩu admin.';
            }
        }
        require_once __DIR__ . '/../views/ad_view.php';
    }

    // Hiển thị form login user
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Cho phép đăng nhập admin trực tiếp từ form chung
            if ($email === 'ad' && $password === '1') {
                $_SESSION['user'] = [
                    'id'    => 0,
                    'name'  => 'Admin',
                    'email' => 'admin@example.com',
                    'role'  => 'admin'
                ];
                header('Location: ?act=admin_dashboard');
                exit;
            }

            require_once './models/UserModel.php';
            $userModel = new UserModel();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'role'  => $user['role']
                ];

                header("Location: ?act=home");
                exit;
            } else {
                $error = "Sai email hoặc mật khẩu.";
            }
        }

        require_once './views/feane/login.php';
    }

    public function register()
{
    $title = "Register - Feane";
    $page = "register";
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name  = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validate server-side
        if (strlen($name) < 2) {
            $error = "Họ tên phải từ 2 ký tự trở lên.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ.";
        } elseif (strlen($password) < 6) {
            $error = "Mật khẩu phải có ít nhất 6 ký tự.";
        } elseif ($password !== $confirmPassword) {
            $error = "Mật khẩu nhập lại không khớp.";
        } else {
            require_once './models/UserModel.php';
            $userModel = new UserModel();
            // Check trùng email
            $existing = $userModel->findByEmail($email);
            if ($existing) {
                $error = "Email đã tồn tại. Vui lòng dùng email khác.";
            } else {
                try {
                    $userModel->create([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => password_hash($password, PASSWORD_BCRYPT),
                        'role' => 'user',
                        'active' => 1
                    ]);
                    header("Location: ?act=login&msg=register_success");
                    exit;
                } catch (\PDOException $e) {
                    // Trường hợp đua tranh hoặc unique khác
                    $error = "Không thể tạo tài khoản: " . ($e->errorInfo[1] == 1062 ? "Email đã tồn tại." : "Lỗi hệ thống.");
                }
            }
        }
    }

    require_once './views/feane/register.php';
}   
    // Logout
    public function logout() {
       
        session_destroy();
        header("Location: ?act=home");
        exit;
    }
}
