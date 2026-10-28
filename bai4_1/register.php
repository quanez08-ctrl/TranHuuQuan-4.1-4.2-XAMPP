<?php
session_start();
require_once __DIR__ . '/../config.php';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($fullName === '' || $user === '' || $pass === '') {
        $error = 'Vui lòng nhập đầy đủ thông tin.';
    } elseif (strlen($pass) < 8) {
        $error = 'Mật khẩu cần ít nhất 8 ký tự.';
    } elseif ($pass !== $confirm) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, full_name) VALUES (?, ?, ?)');
            $stmt->execute([$user, password_hash($pass, PASSWORD_DEFAULT), $fullName]);
            $success = 'Tạo tài khoản thành công. Bạn có thể đăng nhập.';
        } catch (PDOException $e) {
            $error = 'Tên đăng nhập đã tồn tại hoặc không thể tạo tài khoản.';
        }
    }
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tạo tài khoản</title><link rel="stylesheet" href="../style.css"></head><body>
<main class="container"><section class="card" style="max-width:520px;margin:35px auto"><h1>Tạo tài khoản</h1>
<?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if ($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>
<form method="post">
<label>Họ và tên</label><input name="full_name" required>
<label>Tên đăng nhập</label><input name="username" required>
<label>Mật khẩu (ít nhất 8 ký tự)</label><input type="password" name="password" minlength="8" required>
<label>Nhập lại mật khẩu</label><input type="password" name="confirm_password" minlength="8" required>
<button type="submit">Tạo tài khoản</button>
</form><div class="links"><a href="login.php">Quay lại đăng nhập</a></div>
</section></main></body></html>
