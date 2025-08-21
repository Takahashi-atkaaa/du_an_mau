<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Trang Chủ Admin</title>
  <style>
    body {
      .menu {
        margin-top: 10px;
        display: flex;
        /* hiển thị ngang */
        justify-content: center;
        /* căn giữa */
        gap: 20px;
        /* khoảng cách giữa các link */
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

      font-family: Arial,
      sans-serif;
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







    <h2>Danh sách Bình luận</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nội dung</th>
            <th>Sản phẩm</th>
            <th>Người dùng</th>
            <th>Ngày</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($comment as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['content'] ?></td>
            <td><?= $c['product_name'] ?></td>
<td><?= $c['user_name'] ?></td>

            <td><?= $c['date'] ?></td>
            <td>
                <a href="?act=delete_comment&id=<?= $c['id'] ?>" onclick="return confirm('Xóa bình luận này?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php?act=logout" class="btn">Đăng xuất</a>
</body>
</html>
