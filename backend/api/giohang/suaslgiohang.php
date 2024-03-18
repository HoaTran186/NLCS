<?php
if (session_id() === '') {
    session_start();
}

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../../dbconnect.php');

// 2. Lấy thông tin người dùng gởi đến
$sp_ma = $_POST['sp_ma'];
$sp_dh_soluong = $_POST['sp_dh_soluong'];
// 3. Lưu trữ giỏ hàng trong session
// Nếu khách hàng đặt hàng cùng sản phẩm đã có trong giỏ hàng => cập nhật lại Số lượng, Thành tiền
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];
    $sanphamcu = $data[$sp_ma];
    $data[$sp_ma] = array(
        'kh_ma' =>$data['kh_ma'],
        'sp_ma' => $sanphamcu['sp_ma'],
        'sp_ten' => $sanphamcu['sp_ten'],
        'sp_dh_soluong' => $sp_dh_soluong,
        'sp_gia' => $sanphamcu['sp_gia'],
        'thanhtien' => ($sp_dh_soluong * $sanphamcu['sp_gia']),
        'hsp_tentaptin' => $sanphamcu['hsp_tentaptin']
    );
    $_SESSION['giohangdata'] = $data;
}

echo json_encode($_SESSION['giohangdata']);