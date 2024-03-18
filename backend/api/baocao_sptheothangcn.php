<?php
    session_start();
?>
<?php if(isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])){
        echo '<script>location.href="../../dangnhap.php";</script>'; 
    } elseif ($_SESSION['kh_quantri'] == false) {?>
<?php
$kh_ma = $_SESSION['kh_ma'];
include_once __DIR__ . '/../../dbconnect.php';
$sql =<<<EOT
SELECT
    YEAR(sp_ngayxacnhan) AS year,
     MONTH(sp_ngayxacnhan) AS month_number,
    CASE
        WHEN MONTH(sp_ngayxacnhan) = 1 THEN 'Tháng 1'
        WHEN MONTH(sp_ngayxacnhan) = 2 THEN 'Tháng 2'
        WHEN MONTH(sp_ngayxacnhan) = 3 THEN 'Tháng 3'
        WHEN MONTH(sp_ngayxacnhan) = 4 THEN 'Tháng 4'
        WHEN MONTH(sp_ngayxacnhan) = 5 THEN 'Tháng 5'
        WHEN MONTH(sp_ngayxacnhan) = 6 THEN 'Tháng 6'
        WHEN MONTH(sp_ngayxacnhan) = 7 THEN 'Tháng 7'
        WHEN MONTH(sp_ngayxacnhan) = 8 THEN 'Tháng 8'
        WHEN MONTH(sp_ngayxacnhan) = 9 THEN 'Tháng 9'
        WHEN MONTH(sp_ngayxacnhan) = 10 THEN 'Tháng 10'
        WHEN MONTH(sp_ngayxacnhan) = 11 THEN 'Tháng 11'
        WHEN MONTH(sp_ngayxacnhan) = 12 THEN 'Tháng 12'
    END AS month_name,
    COUNT(*) AS ngay
FROM
    san_pham
WHERE kh_ma = $kh_ma
GROUP BY
    YEAR(sp_ngayxacnhan),
    MONTH(sp_ngayxacnhan)
ORDER BY YEAR,month_number;
EOT;
        $result = mysqli_query($conn,$sql);
        $data =[];
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $data[] = array(
                'month_name'=> $row['month_name'],
                'ngay' => $row['ngay']
            );
        }
echo json_encode($data);
?>
<?php } ?>