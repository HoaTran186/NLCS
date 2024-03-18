<?php  
    session_start();
?>
<?php
    if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])){
        echo '<script>location.href="../../dangnhap.php";</script>';
    }
    elseif(isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false){
        echo 'Bạn không có quyền sử dụng chức năng này!';
        echo '<a href="../../index.php">Quay lại trang chủ</a>';
    }
    else {
?>
<?php
    include_once __DIR__ . '/../../dbconnect.php';
    $kh_ma = $_GET['kh_ma'];
    $sql = "DELETE FROM xn_donhang WHERE dh_ma = $kh_ma;";
    mysqli_query($conn,$sql);
    $sqlDH = "DELETE FROM don_dat_hang WHERE_ma=$kh_ma;";
    mysqli_query($conn,$sqlDH);
    $sqlDLSP = "DELETE FROM san_pham WHERE kh_ma = $kh_ma;";
    mysqli_query($conn,$sqlDLSP);
    $sqlDLKH = "DELETE FROM khach_hang WHERE kh_ma=$kh_ma;";
    mysqli_query($conn,$sqlDLKH);
    echo '<script>location.href ="index.php";</script>';
?>
<?php } ?>