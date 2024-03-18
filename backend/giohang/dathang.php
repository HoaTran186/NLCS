<?php
session_start();
?>
<script src="/PassdoSV.com/assets/vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="/PassdoSV.com/assets/vendor/sweetalert2/sweetalert2.min.css">
<script src="/PassdoSV.com/assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<?php
include_once __DIR__ . '/../../dbconnect.php';
if (isset($_POST['btnDatHang'])) {
    if (isset($_POST['sp_ma']) && is_array($_POST['sp_ma'])) {
        foreach ($_POST['sp_ma'] as $key => $sp_ma) {
            $sp_dh_soluong = $_POST['sp_dh_soluong'][$key];
            $sp_dh_dongia = $_POST['sp_dh_dongia'][$key];
            $sql = "SELECT * FROM san_pham WHERE sp_ma = $sp_ma;";
            $result = mysqli_query($conn, $sql);
            $data = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $data = array(
                    'sp_ten' => $row['sp_ten'],
                    'sp_soluong' => $row['sp_soluong'],
                );
            }
            if ($data['sp_soluong'] == 0) {
                echo '<script>
                $(document).ready(function() {
                    Swal.fire({
                icon: "error",
                title: "Xin lỗi....",
                text: "Sản phẩm của bạn đặt đã hết hàng!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                            location.href = "/PassdoSV.com/giohang.php";

                }
            })
        })
            </script>';
                unset($_SESSION['giohangdata'][$sp_ma]);
                die;
            } elseif (($data['sp_soluong'] - $sp_dh_soluong) < 0) {
                echo '<script>
                $(document).ready(function() {
                    Swal.fire({
                icon: "error",
                title: "Xin lỗi....",
                text: "Sản phẩm của bạn đặt không đủ số lượng!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                            location.href = "/PassdoSV.com/giohang.php";

                }
            })
        })
            </script>';
                die;
            } else {
                $sp_soluong=$data['sp_soluong'];
                $sqlSP = "UPDATE san_pham
                SET
                    sp_soluong=($sp_soluong- $sp_dh_soluong)
                WHERE sp_ma = $sp_ma;";
                mysqli_query($conn, $sqlSP);
                $kh_ma = $_POST['kh_ma'][$key];
                $kh_diachi = $_POST['kh_diachi'];
                $kh_ma_g = $_SESSION['kh_ma'];

                $sqlDonDatHang = "INSERT INTO don_dat_hang (dh_ngaydat, kh_diachi, ttdh_ma, kh_ma) 
                              VALUES (NOW(), '$kh_diachi', 2, $kh_ma_g)";
                $conn->query($sqlDonDatHang);

                $lastInsertedId = $conn->insert_id;

                // $sp_dh_soluong = $_POST['sp_dh_soluong'][$key];
                // $sp_dh_dongia = $_POST['sp_dh_dongia'][$key];
                $sqlSanPhamDonDatHang = "INSERT INTO sanpham_dondathang (dh_ma, sp_ma, sp_dh_soluong, sp_dh_dongia) 
                                     VALUES ($lastInsertedId, $sp_ma, $sp_dh_soluong, $sp_dh_dongia)";
                $conn->query($sqlSanPhamDonDatHang);
                echo '<script>
                $(document).ready(function() {
                        Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Đặt hàng thành công",
                                showConfirmButton: false,
                                timer: 1500
                                 }).then((result) => {           
                                                location.href = "/PassdoSV.com/giohang.php";
                    
                                })
                })
            </script>';
                unset($_SESSION['giohangdata']);
            }
        }
    }
}
?>