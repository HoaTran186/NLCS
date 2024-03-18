<?php
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
include_once(__DIR__ . '/../../../dbconnect.php');

$sp_ma = $_POST['sp_ma'];

if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    
    if(isset($data[$sp_ma])) {
        unset($data[$sp_ma]);
    }

    // lưu dữ liệu giỏ hàng vào session
    $_SESSION['giohangdata'] = $data;
}

echo json_encode($_SESSION['giohangdata']);