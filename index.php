<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers

require_once './controllers/FeaneController.php';
require_once './controllers/loginController.php';
require_once './controllers/adminController.php';



// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/CommentModel.php';
require_once './models/UserModel.php';
// Route

$act = $_GET['act'] ?? '/';

match ($act) {
    '/' => (new FeaneController())->Home(),
 
    'menu' => (new FeaneController())->Menu(),
    'about' => (new FeaneController())->About(),

    'login' => (new loginController())->login(),
    'register' => (new loginController())->register(),
    'admin' => (new loginController())->admin(),
    'admin_dashboard' => (new adminController())->dashboard(),
    
  
    "Admin_login"       => (new loginController())->admin(),

    "home"       => (new FeaneController())->Home(),
    'logout' => (new loginController())->logout(),

    "quanly_user"       => (new adminController())->quanly_user(),
    "delete" => (new adminController())->delete($_GET['id'] ?? null),
    "quanly_Product" => (new adminController())->quanly_Product(),
    "quanly_Category"       => (new adminController())->quanly_Category(),
    "quanly_Comment"       => (new adminController())->quanly_Comment(),
    
"add_product"    => (new adminController())->add_product(),
"edit_product"   => (new adminController())->edit_product($_GET['id'] ?? null),
"delete_product" => (new adminController())->delete_product($_GET['id'] ?? null),



"add_category"     => (new adminController())->add_category(),
"edit_category"    => (new adminController())->edit_category($_GET['id'] ?? null),
"delete_category"  => (new adminController())->delete_category($_GET['id'] ?? null),

    default => (new FeaneController())->Home(),

    

};