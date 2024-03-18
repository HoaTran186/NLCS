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
    $sp_ma = $_GET['sp_ma'];
    $sqlSLSP = "SELECT * FROM san_pham WHERE sp_ma = $sp_ma;";
    $resultSP =mysqli_query($conn,$sqlSLSP);
    $dataSP = [];
    while($row = mysqli_fetch_array($resultSP,MYSQLI_ASSOC)){
        $dataSP= array(
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'sp_giacu' => $row['sp_giacu'],
            'sp_soluong' => $row['sp_soluong'],
            'sp_mota' => $row['sp_mota'],
            'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
            'lsp_ma' => $row['lsp_ma'],
            'lh_ma' => $row['lh_ma'],
            'httt_ma' => $row['httt_ma'],
            'hsp_tentaptin' => $row['hsp_tentaptin']
        );
    }
    $deleteDir = __DIR__ . '/../../assets/upload/';
    unlink($deleteDir.$dataSP['hsp_tentaptin']);
    $sqlDLDSSP = "DELETE FROM san_pham WHERE sp_ma=$sp_ma;";
    mysqli_query($conn,$sqlDLDSSP);
    echo '<script>location.href ="index.php";</script>';
?>
<?php } ?>