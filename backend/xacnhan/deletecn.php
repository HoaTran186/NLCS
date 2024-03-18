<?php
session_start();
?>
<?php
if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    echo '<script>location.href="../../dangnhap.php";</script>';
} elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
    
?>
<?php
    include_once __DIR__ . '/../../dbconnect.php';
    $xn_ma  = $_GET['xn_ma'];
    $sqlSLXN = "SELECT * FROM xac_nhan_ban_sp WHERE xn_ma = $xn_ma;";
    $resultSLXN = mysqli_query($conn, $sqlSLXN);
    $dataXN = [];
    while ($row = mysqli_fetch_array($resultSLXN, MYSQLI_ASSOC)) {
        $dataXN = array(
            'xn_ma' => $row['xn_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'sp_giacu' => $row['sp_giacu'],
            'sp_soluong' => $row['sp_soluong'],
            'sp_mota' => $row['sp_mota'],
            'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
            'lsp_ma' => $row['lsp_ma'],
            'lh_ma' => $row['lh_ma'],
            'httt_ma' => $row['httt_ma'],
            'kh_ma' =>$row['kh_ma']
        );
    }
    $uploadDir = __DIR__ . '/../../assets/wait/';
    unlink($uploadDir . $dataXN['hsp_tentaptin']);
    $sqlDLXN = "DELETE FROM xac_nhan_ban_sp WHERE xn_ma=$xn_ma;";
    mysqli_query($conn, $sqlDLXN);
    echo '<script>location.href ="xacnhan.php";</script>';
?>
<?php } ?>