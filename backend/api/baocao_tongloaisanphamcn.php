<?php
    session_start();
?>
<?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    echo '<script>location.href="../../dangnhap.php";</script>';
} elseif ($_SESSION['kh_quantri'] == false) {
?> 
<?php
include_once __DIR__ . '/../../dbconnect.php';
$kh_ma = $_SESSION['kh_ma'];
$sqlTKSPLSP = <<<EOT
        SELECT lsp.lsp_ten,COUNT(sp.sp_ma) AS tongsp
        FROM san_pham  sp JOIN loai_san_pham lsp ON sp.lsp_ma = lsp.lsp_ma
        WHERE kh_ma = $kh_ma 
        GROUP BY sp.lsp_ma; 
EOT;
$resultTKLSP = mysqli_query($conn, $sqlTKSPLSP);
$dataTKLSP = [];
while ($row = mysqli_fetch_array($resultTKLSP, MYSQLI_ASSOC)) {
    $dataTKLSP[]= array(
        'lsp_ten'=>$row['lsp_ten'],
        'tongsp' => $row['tongsp']
    );
}
echo json_encode($dataTKLSP);
?>
<?php } ?>