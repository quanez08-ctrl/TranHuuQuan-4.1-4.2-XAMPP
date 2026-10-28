<?php
require_once __DIR__ . '/../config.php';

$error = '';
$success = '';
$courses = [
    101 => 'Lập trình C#',
    102 => 'Lập trình Python',
    103 => 'Cơ sở dữ liệu SQL',
    104 => 'Lập trình Web',
    105 => 'Lập trình Java',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $birthDate = $_POST['birth_date'] ?? '';
    $courseId = (int)($_POST['course_id'] ?? 0);
    $gender = $_POST['gender'] ?? '';
    $interests = $_POST['interests'] ?? [];

    if ($fullName === '' || $phone === '' || $birthDate === '' || !isset($courses[$courseId]) || !in_array($gender, ['Nam', 'Nữ'], true)) {
        $error = 'Vui lòng điền đầy đủ và kiểm tra lại thông tin.';
    } elseif (!preg_match('/^\(\d{3}\) \d{3}-\d{4}$/', $phone)) {
        $error = 'Số điện thoại cần đúng mẫu (000) 000-0000.';
    } else {
        $interestText = implode(', ', array_intersect(['C#', 'Python', 'SQL'], $interests));
        $stmt = $pdo->prepare('INSERT INTO registrations (full_name, phone, birth_date, course_id, course_name, gender, interests) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$fullName, $phone, $birthDate, $courseId, $courses[$courseId], $gender, $interestText]);
        $success = 'Đăng ký thành công! Thông tin đã được lưu vào cơ sở dữ liệu.';
    }
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bài 4.2 - Đăng ký khóa học</title><link rel="stylesheet" href="../style.css"></head><body>
<main class="container"><section class="card"><h1>Phiếu đăng ký khóa học</h1>
<p class="small">Bài tập 4.2 · Dữ liệu được lưu vào MySQL</p>
<?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if ($success): ?><p class="success"><?= htmlspecialchars($success) ?></p><?php endif; ?>
<form method="post">
<label for="full_name">Họ và tên</label><input id="full_name" name="full_name" maxlength="120" required>
<label for="phone">Số điện thoại</label><input id="phone" name="phone" placeholder="(012) 345-6789" pattern="\(\d{3}\) \d{3}-\d{4}" required>
<label for="birth_date">Ngày sinh</label><input id="birth_date" name="birth_date" type="date" max="<?= date('Y-m-d') ?>" required>
<label for="course_id">Khóa học</label><select id="course_id" name="course_id" required>
<option value="">-- Chọn khóa học --</option>
<?php foreach ($courses as $id => $name): ?><option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option><?php endforeach; ?>
</select>
<label>Giới tính</label><div class="inline">
<label><input type="radio" name="gender" value="Nam" required> Nam</label>
<label><input type="radio" name="gender" value="Nữ" required> Nữ</label>
</div>
<label>Nội dung quan tâm</label><div class="inline">
<label><input type="checkbox" name="interests[]" value="C#"> C#</label>
<label><input type="checkbox" name="interests[]" value="Python"> Python</label>
<label><input type="checkbox" name="interests[]" value="SQL"> SQL</label>
</div>
<button type="submit">Đăng ký và lưu CSDL</button>
</form>
<div class="links"><a href="list.php">Xem danh sách đăng ký</a><a href="../bai4_1/login.php">Bài 4.1 - Đăng nhập</a></div>
</section></main></body></html>
