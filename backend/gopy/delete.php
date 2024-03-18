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
    include_once __DIR__.'/../../dbconnect.php';
    $gy_ma = $_GET['gy_ma'];
    $sql = "DELETE FROM gop_y WHERE gy_ma = $gy_ma;";
    mysqli_query($conn,$sql);
    echo '<script>location.href ="index.php";</script>';
?>
<?php } ?>