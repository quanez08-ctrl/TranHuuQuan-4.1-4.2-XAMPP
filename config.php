<?php
declare(strict_types=1);

$host = '127.0.0.1';
$dbname = 'baitap4_db';
$username = 'root';
$password = ''; // Mặc định XAMPP thường để trống mật khẩu MySQL

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Không kết nối được CSDL. Hãy bật MySQL trong XAMPP và import database.sql.');
}
