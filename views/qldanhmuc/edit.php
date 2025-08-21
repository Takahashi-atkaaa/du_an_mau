<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Sửa danh mục - Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #1e293b;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    header {
      background: #0f172a;
      padding: 15px;
      text-align: center;
    }

    header h1 {
      margin: 0;
    }

    .menu {
      margin-top: 10px;
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .menu a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      background: #3b82f6;
      padding: 8px 15px;
      border-radius: 6px;
      transition: 0.3s;
    }

    .menu a:hover {
      background: #2563eb;
    }

    main {
      max-width: 500px;
      margin: auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #e2e8f0;
    }

    form {
      background: #334155;
      padding: 20px;
      border-radius: 8px;
    }

    form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    form input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #475569;
      background: #1e293b;
      color: #fff;
    }

    form button {
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
      margin-right: 10px;
    }

    .btn-primary {
      background: #3b82f6;
      color: #fff;
    }

    .btn-primary:hover {
      background: #2563eb;
    }

    .btn-secondary {
      background: #64748b;
      color: #fff;
    }

    .btn-secondary:hover {
      background: #475569;
    }

    .logout-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #ef4444;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }

    .logout-btn:hover {
      background: #b91c1c;
    }
  </style>
</head>

<body>
  <header>
    <h1>Xin chào Admin</h1>
    <div class="menu">
      <a href="?act=quanly_user">Quản lý User</a>
      <a href="?act=quanly_Product">Quản lý Product</a>
      <a href="?act=quanly_Category">Quản lý Category</a>
      <a href="?act=quanly_Comment">Quản lý Comment</a>
    </div>
  </header>

  <main>
    <h2>Sửa danh mục</h2>
    <form action="" method="POST">
      <input type="hidden" name="id" value="<?= $category['id'] ?>">
      <label for="name">Tên danh mục:</label>
      <input type="text" name="name" id="name" value="<?= $category['name'] ?>" required>

      <button type="submit" class="btn-primary">Cập nhật</button>
      <a href="?act=quanly_Category" class="btn-secondary">Hủy</a>
    </form>

    <a href="index.php?act=logout" class="logout-btn">Đăng xuất</a>
  </main>
</body>
</html>
