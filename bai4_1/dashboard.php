<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bài 4.1 - Trang chủ</title><link rel="stylesheet" href="../style.css"></head><body>
<main class="container"><section class="card">
<h1>Đăng nhập thành công</h1>
<p>Xin chào, <strong><?= htmlspecialchars($_SESSION['full_name']) ?></strong>!</p>
<p>Tên đăng nhập: <?= htmlspecialchars($_SESSION['username']) ?></p>
<p>Thông tin tài khoản được xác thực từ cơ sở dữ liệu MySQL.</p>
<div class="links"><a class="button" href="../bai4_2/">Mở bài 4.2 - Đăng ký khóa học</a><a class="button secondary" href="../bai4_2/list.php">Xem danh sách đăng ký</a><a class="button secondary" href="logout.php">Đăng xuất</a></div>
</section></main></body></html>
