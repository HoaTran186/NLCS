<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}

include_once(__DIR__ . '/../../../dbconnect.php');

// 2. Lấy thông tin người dùng gởi đến
$sp_ma = $_POST['sp_ma'];
$sp_dh_soluong = isset($_POST['sp_dh_soluong']) ? (int)$_POST['sp_dh_soluong'] : 1;
$sqlSP = "SELECT * FROM san_pham WHERE sp_ma = $sp_ma; ";
$resultSP = mysqli_query($conn, $sqlSP);
$dataSP = [];
while ($row = mysqli_fetch_array($resultSP, MYSQLI_ASSOC)) {
    $dataSP = array(
        'sp_ma' => $row['sp_ma'],
        'sp_ten' => $row['sp_ten'],
        'hsp_tentaptin' => $row['hsp_tentaptin'],
        'sp_gia' => $row['sp_gia'],
        'kh_ma' =>$row['kh_ma']
    );
}
if (isset($_SESSION['giohangdata'])) {
    $data = $_SESSION['giohangdata'];

    if (isset($data[$sp_ma])) {
        // If the product already exists in the cart, increase the quantity by 1
        $data[$sp_ma]['sp_dh_soluong'] += 1;
        $data[$sp_ma]['thanhtien'] = $data[$sp_ma]['sp_dh_soluong']*$data[$sp_ma]['sp_gia'];
    } else {
        // If the product is not in the cart, add it with quantity 1
        $data[$sp_ma] = array(
            'kh_ma'=>$dataSP['kh_ma'] ,
            'sp_ma' => $sp_ma,
            'sp_ten' => $dataSP['sp_ten'],
            'sp_dh_soluong' => $sp_dh_soluong,
            'sp_gia' => $dataSP['sp_gia'],
            'thanhtien' => ($sp_dh_soluong * $dataSP['sp_gia']),
            'hsp_tentaptin' => $dataSP['hsp_tentaptin']
        );
    }

    $_SESSION['giohangdata'] = $data;
} else {
    $data[$sp_ma] = array(
        'kh_ma' =>$dataSP['kh_ma'],
        'sp_ma' => $sp_ma,
        'sp_ten' => $dataSP['sp_ten'],
        'sp_dh_soluong' => $sp_dh_soluong,
        'sp_gia' => $dataSP['sp_gia'],
        'thanhtien' => ($sp_dh_soluong * $dataSP['sp_gia']),
        'hsp_tentaptin' => $dataSP['hsp_tentaptin']
    );

    $_SESSION['giohangdata'] = $data;
}

echo json_encode($_SESSION['giohangdata']);
