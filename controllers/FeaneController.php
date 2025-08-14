<?php
// Controller cho website Feane Restaurant
class FeaneController
{
    public function __construct()
    {
        // Khởi tạo controller
    }

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
    public function BookTable()
    {
        $title = "Book Table - Feane";
        $page = "book";
        require_once './views/feane/book.php';
    }
}
