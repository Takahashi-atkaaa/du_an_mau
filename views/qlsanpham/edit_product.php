<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sửa Sản Phẩm - Admin</title>
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
    header h1 { margin: 0; }
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
    .menu a:hover { background: #2563eb; }
    main {
      padding: 20px;
      max-width: 700px;
      margin: auto;
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
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    form input[type="text"],
    form input[type="number"],
    form input[type="file"],
    form textarea,
    form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #475569;
      background: #1e293b;
      color: #fff;
    }
    form textarea { height: 100px; resize: vertical; }
    form input[type="checkbox"] { margin-top: 5px; }
    form button {
      padding: 10px 20px;
      background: #3b82f6;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s;
    }
    form button:hover { background: #2563eb; }
    img {
      max-width: 150px;
      margin-bottom: 15px;
      border-radius: 4px;
      border: 1px solid #475569;
      display: block;
    }
    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 20px;
      background: #3b82f6;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      text-align: center;
    }
    .btn:hover { background: #2563eb; }
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
  <h2>Sửa sản phẩm</h2>

  <form method="post" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label>Ảnh hiện tại:</label>
    <?php if (!empty($product['image']) && file_exists(PATH_ROOT . 'public/images/' . $product['image'])): ?>
        <img src="public/images/<?= htmlspecialchars($product['image']) ?>" alt="Ảnh sản phẩm">
    <?php else: ?>
        <p>Chưa có ảnh</p>
    <?php endif; ?>
    <input type="file" name="image">

    <label>Giá:</label>
    <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <label>Danh mục:</label>
    <select name="idcategory" required>
        <?php 
        $categories = (new CategoryModel())->getAllCategories(); 
        foreach ($categories as $category): 
        ?>
            <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['idcategory'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Mô tả:</label>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

    <label>Hot:</label>
    <input type="checkbox" name="hot" <?= $product['hot'] ? 'checked' : '' ?>>

    <label>Giảm giá (%):</label>
    <input type="number" name="discount" value="<?= htmlspecialchars($product['discount']) ?>">

    <button type="submit">Cập nhật</button>
  </form>

  <a href="index.php?act=logout" class="btn">Đăng xuất</a>
</main>
</body>
</html>
