<?php
require_once __DIR__ . '/../config.php';
$rows = $pdo->query('SELECT id, full_name, phone, birth_date, course_name, gender, interests, created_at FROM registrations ORDER BY id DESC')->fetchAll();
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Danh sách đăng ký</title><link rel="stylesheet" href="../style.css"></head><body>
<main class="container"><section class="card"><h1>Danh sách đăng ký khóa học</h1>
<div class="links"><a class="button" href="index.php">Thêm đăng ký</a><a class="button secondary" href="../bai4_1/login.php">Bài 4.1 - Đăng nhập</a></div>
<?php if (!$rows): ?><p>Chưa có dữ liệu đăng ký.</p><?php else: ?>
<div class="table-wrap"><table><thead><tr><th>ID</th><th>Họ tên</th><th>SĐT</th><th>Ngày sinh</th><th>Khóa học</th><th>Giới tính</th><th>Nội dung quan tâm</th><th>Thời gian tạo</th></tr></thead><tbody>
<?php foreach ($rows as $row): ?><tr>
<td><?= (int)$row['id'] ?></td><td><?= htmlspecialchars($row['full_name']) ?></td>
<td><?= htmlspecialchars($row['phone']) ?></td><td><?= date('d/m/Y', strtotime($row['birth_date'])) ?></td>
<td><?= htmlspecialchars($row['course_name']) ?></td><td><?= htmlspecialchars($row['gender']) ?></td>
<td><?= htmlspecialchars($row['interests'] ?: 'Chưa chọn') ?></td><td><?= htmlspecialchars($row['created_at']) ?></td>
</tr><?php endforeach; ?>
</tbody></table></div><?php endif; ?>
</section></main></body></html>
