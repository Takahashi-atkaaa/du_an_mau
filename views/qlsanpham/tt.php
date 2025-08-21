<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Trang Chủ Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #1e293b;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    .menu {
      margin-top: 10px;
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .menu a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      background: #3b82f6;
      padding: 8px 15px;
      border-radius: 6px;
      transition: background 0.3s;
    }

    .menu a:hover {
      background: #2563eb;
    }

    header {
      background: #0f172a;
      padding: 15px;
      text-align: center;
    }

    h1 {
      margin: 0;
    }

    main {
      padding: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      margin-top: 15px;
      background: #3b82f6;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
    }

    .btn:hover {
      background: #2563eb;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      background: #334155;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #475569;
      padding: 8px;
      text-align: left;
    }

    th {
      background: #0f172a;
    }

    table img {
      width: 80px;
      height: auto;
      border-radius: 4px;
    }

    a {
      color: #3b82f6;
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
    <h2>Danh sách sản phẩm</h2>
    <a href="?act=add_product" class="btn">+ Thêm Sản Phẩm</a>

    <table>
      <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Ảnh</th>
        <th>Giá</th>
        <th>ID Danh mục</th>
        <th>Mô tả</th>
        <th>Hot</th>
        <th>Lượt xem</th>
        <th>Giảm giá (%)</th>
        <th>Hành động</th>
      </tr>
      <?php foreach ($products as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['name'] ?></td>
        <td><img src="public/images/<?= $p['image'] ?>" alt="<?= $p['name'] ?>">    </td>
        <td><?= number_format($p['price'], 0, ',', '.') ?> đ</td>
        <td><?= $p['idcategory'] ?></td>
        <td><?= $p['description'] ?></td>
        <td><?= $p['hot'] ? 'Có' : 'Không' ?></td>
        <td><?= $p['view'] ?></td>
        <td><?= $p['discount'] ?>%</td>
        <td>
          <a href="?act=edit_product&id=<?= $p['id'] ?>">Sửa</a> | 
          <a href="?act=delete_product&id=<?= $p['id'] ?>" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>

    <a href="index.php?act=logout" class="btn">Đăng xuất</a>
  </main>
</body>
</html>
