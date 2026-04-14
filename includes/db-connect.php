<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'project_ct214h';

// Tên biến BẮT BUỘC phải là $conn
$conn = mysqli_connect($host, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
