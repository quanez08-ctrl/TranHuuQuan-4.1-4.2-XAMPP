CREATE DATABASE IF NOT EXISTS baitap4_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE baitap4_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    birth_date DATE NOT NULL,
    course_id INT NOT NULL,
    course_name VARCHAR(120) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    interests VARCHAR(255) NOT NULL DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Demo account: admin / Admin@123
-- Hash is generated for the password "Admin@123".
INSERT INTO users (username, password_hash, full_name)
VALUES ('admin', '$2y$12$oJcrbIblE3Iakb3e27FSqOc15yVwEewIeyCa4s3b/oWc5gkEb5UlS', 'Quản trị viên')
ON DUPLICATE KEY UPDATE username = VALUES(username);
