<?php
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';
require_once 'models/CommentModel.php';

class FeaneController
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

// Controller cho website Feane Restaurant


   
    

    // Trang chủ
    public function Home()
    {
        $title = "Feane - Restaurant";
        $page = "home";
        require_once './views/feane/home.php';


    }

    // Trang Menu
    public function Menu()
    {
        $title = "Menu - Feane";
        $page = "menu";
    
        $category = $this->category_model->getAllCategories(); // ['id','name','slug']
        $products = $this->product_model->all(); // ['id','name','category_slug','image','description','price','old_price']
    
        require_once './views/feane/menu.php';
    }

    // Trang About
    public function About()
    {
        $title = "About - Feane";
        $page = "about";
        require_once './views/feane/about.php';
    }

    // Trang Book Table



    
}

    // Trang chủ
 
    
