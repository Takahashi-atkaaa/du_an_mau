<?php
require_once 'models/UserModel.php';
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';
require_once 'models/CommentModel.php';

class adminController
{
    public $user_model;
    public $product_model;
    public $comment_model;
    public $category_model;
    
    public function __construct()
    {
        $this->user_model     = new UserModel();
        $this->product_model  = new ProductModel();
        $this->comment_model  = new CommentModel();
        $this->category_model = new CategoryModel();
    }

    // Trang dashboard admin (yêu cầu role admin)
    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user']) || (($_SESSION['user']['role'] ?? '') !== 'admin')) {
            header('Location: ?act=login&error=not_admin');
            exit;
        }
        require_once 'views/ad_view.php';
    }

    // Hiển thị danh sách nguoi dung
    public function quanly_user()
    {
        $user = $this->user_model->all();
        require_once 'views/qlnguoidung/user_view.php';
    }

    public function delete($id) {
        if ($this->user_model->delete($id)) {
            header("Location: ?act=quanly_user");
            exit;
        } else {
            $err = "Không thể xóa";
            $user = $this->user_model->all();
            require_once "views/qlnguoidung/user_view.php";
        }
    }
    
    
    /////////////
    public function quanly_Product() {
        $products = $this->product_model->all();
        require_once 'views/qlsanpham/tt.php';
    }
    public function add_product() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'        => $_POST['name'],
                'image'       => $_FILES['image']['name'] ?? null,
                'price'       => $_POST['price'],
                'idcategory'  => $_POST['idcategory'],
                'description' => $_POST['description'],
                'hot'         => isset($_POST['hot']) ? 1 : 0,
                'view'        => $_POST['view'] ?? 0,
                'discount'    => $_POST['discount'] ?? 0
            ];
    
            // Upload ảnh
            if (!empty($_FILES['image']['name'])) {
                move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $_FILES['image']['name']);
            }
    
            $this->product_model->insert($data);
            header("Location: ?act=quanly_Product");
            exit;
        }
        require_once 'views/qlsanpham/add_product.php';
    }
    
    public function edit_product($id) {
        $product = $this->product_model->find($id);
        if (!$product) {
            header("Location: ?act=quanly_Product&error=notfound");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $idcategory = $_POST['idcategory'];
            $description = $_POST['description'];
            $hot = isset($_POST['hot']) ? 1 : 0;
            $discount = $_POST['discount'];
        
            // Xử lý ảnh
            if (!empty($_FILES['image']['name'])) {
                $newImage = uploadFile($_FILES['image'], 'uploads/');
                if ($newImage) {
                    if (!empty($product['image'])) {
                        deleteFile('uploads/' . $product['image']);
                    }
                    $product['image'] = basename($newImage);
                }
            }
        
            // Cập nhật sản phẩm
            $this->product_model->updateProduct($product['id'], [
                'name' => $name,
                'image' => $product['image'],
                'price' => $price,
                'idcategory' => $idcategory,
                'description' => $description,
                'hot' => $hot,
                'view' => $product['view'],
                'discount' => $discount
            ]);
        
            header('Location: ?act=quanly_Product');
            exit;
        }
        
        
        require_once 'views/qlsanpham/edit_product.php';
    }
    
    public function delete_product($id) {
        if ($id) {
            $this->product_model->delete($id);
        }
        header("Location: ?act=quanly_Product");
        exit;
    }
    



/////////////



    public function     quanly_Category() {
        $category = $this->category_model->getAllCategories();
        require_once 'views/qldanhmuc/category.php';
    }


// Thêm danh mục
public function add_category() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'] ?? null
        ];
        $this->category_model->createCategory($data);
        header("Location: ?act=quanly_Category");
        exit;
    }
    require_once 'views/qldanhmuc/add.php';
}

// Sửa danh mục
public function edit_category($id) {
    $category = $this->category_model->getCategoryById($id);
    if (!$category) {
        header("Location: ?act=quanly_Category&error=notfound");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'] ?? null
        ];
        $this->category_model->updateCategory($id, $data);
        header("Location: ?act=quanly_Category");
        exit;
    }
    require_once 'views/qldanhmuc/edit.php';
}

// Xóa danh mục
public function delete_category($id) {
    if ($id) {
        $this->category_model->deleteCategory($id);
    }
    header("Location: ?act=quanly_Category");
    exit;
}






  //////////////////
    public function       quanly_Comment() {
        $comment = $this->comment_model->all();
        require_once 'views/qlcomment/comment.php';
    }
  
}
