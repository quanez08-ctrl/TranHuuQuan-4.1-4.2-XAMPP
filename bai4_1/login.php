<?php
session_start();
require_once __DIR__ . '/../config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, username, password_hash, full_name FROM users WHERE username = ?');
    $stmt->execute([$user]);
    $account = $stmt->fetch();

    if ($account && password_verify($pass, $account['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$account['id'];
        $_SESSION['username'] = $account['username'];
        $_SESSION['full_name'] = $account['full_name'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Tên đăng nhập hoặc mật khẩu không đúng.';
}
?>
<!doctype html>
<html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bài 4.1 - Đăng nhập</title><link rel="stylesheet" href="../style.css"></head>
<body><main class="container"><section class="card" style="max-width:470px;margin:45px auto">
<h1>Đăng nhập hệ thống</h1><p class="small">Bài tập 4.1 · Xác thực tài khoản từ MySQL</p>
<?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<form method="post">
<label for="username">Tên đăng nhập</label><input id="username" name="username" required autocomplete="username">
<label for="password">Mật khẩu</label><input id="password" name="password" type="password" required autocomplete="current-password">
<button type="submit">Đăng nhập</button>
</form>
<div class="links"><a href="register.php">Tạo tài khoản mới</a><a href="../bai4_2/">Bài 4.2 - Đăng ký khóa học</a></div>
<p class="small">Demo: admin / Admin@123</p>
</section></main></body></html>
