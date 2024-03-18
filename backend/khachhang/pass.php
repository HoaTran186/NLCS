<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/PassdoSV.com/assets/vendor/datatable/datatables.min.css">
    <link rel="stylesheet" href="/PassdoSV.com/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/PassdoSV.com/backend/Dashboard/style.css">
    <title>Dashboard</title>
</head>
<?php
include_once __DIR__ . '/../../dbconnect.php';
$sqlXN = "SELECT count(*) AS tongxn
    FROM xac_nhan_ban_sp;";
$resultXN = mysqli_query($conn, $sqlXN);
$dataXN = [];
while ($row = mysqli_fetch_array($resultXN, MYSQLI_ASSOC)) {
    $dataXN = array(
        'tongxn' => $row['tongxn']
    );
}
if (empty($dataXN['tongxn'])) {
    $dataXN['tongxn'] = 0;
}
$sqlTKTSP = "SELECT count(sp_ma) AS tongsp
    FROM san_pham;";
$resultTKTSP = mysqli_query($conn, $sqlTKTSP);
$dataTSP = [];
while ($row = mysqli_fetch_array($resultTKTSP, MYSQLI_ASSOC)) {
    $dataTSP = array(
        'tongsp' => $row['tongsp']
    );
}
if (empty($dataTSP['tongsp'])) {
    $dataTSP['tongsp'] = 0;
}
$sqlTKH = "SELECT COUNT(*) AS tongkh
    FROM khach_hang;";
$resultTKH = mysqli_query($conn, $sqlTKH);
$dataTKH = [];
while ($row = mysqli_fetch_array($resultTKH, MYSQLI_ASSOC)) {
    $dataTKH = array(
        'tongkh' => $row['tongkh']
    );
}
if (empty($dataTKH['tongkh'])) {
    $dataTKH['tongkh'] = 0;
}
$sqlDDH = "SELECT COUNT(*) AS tongddh
    FROM don_dat_hang;";
$resultDDH = mysqli_query($conn, $sqlDDH);
$dataDDH = [];
while ($row = mysqli_fetch_array($resultDDH, MYSQLI_ASSOC)) {
    $dataDDH = array(
        'tongddh' => $row['tongddh'],
    );
}
if (empty($dataDDH['tongddh'])) {
    $dataDDH['tongddh'] = 0;
}

$kh_ma =  $_SESSION['kh_ma'];
$sqlXNCN = "SELECT count(*) AS tongxncn
    FROM xac_nhan_ban_sp
    WHERE kh_ma = $kh_ma;";
$resultXNCN = mysqli_query($conn, $sqlXNCN);
$dataXNCN = [];
while ($row = mysqli_fetch_array($resultXNCN, MYSQLI_ASSOC)) {
    $dataXNCN = array(
        'tongxncn' => $row['tongxncn']
    );
}
if (empty($dataXNCN['tongxncn'])) {
    $dataXNCN['tongxncn'] = 0;
}
$sqlSPCN = "SELECT count(sp_ma) AS tongspcn
    FROM san_pham
    WHERE kh_ma = $kh_ma;";
$resultSPCN = mysqli_query($conn, $sqlSPCN);
$dataSPCN = [];
while ($row = mysqli_fetch_array($resultSPCN, MYSQLI_ASSOC)) {
    $dataSPCN = array(
        'tongspcn' => $row['tongspcn']
    );
}
if (empty($dataSPCN['tongspcn'])) {
    $dataSPCN['tongspcn'] = 0;
}
$sqlDHCN = "SELECT COUNT(*) AS tongdhcn
    FROM don_dat_hang
    WHERE kh_ma = $kh_ma;";
$resultDHCN = mysqli_query($conn, $sqlDHCN);
$dataDHCN = [];
while ($row = mysqli_fetch_array($resultDHCN, MYSQLI_ASSOC)) {
    $dataDHCN = array(
        'tongdhcn' => $row['tongdhcn'],
    );
}
if (empty($dataDHCN['tongdhcn'])) {
    $dataDHCN['tongdhcn'] = 0;
}
?>

<body>
    <div class="sidebar">
        <a href="/PassdoSV.com/index.php" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Passdo</span>SV</div>
        </a>
        <ul class="side-menu">
            <li><a href="/PassdoSV.com/backend/Dashboard/dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="/PassdoSV.com/backend/chart/chart.php"><i class='bx bx-line-chart'></i>Thống kê</a></li>
            <li><a href="/PassdoSV.com/backend/xacnhan/xacnhan.php"><i class='bx bx-task'></i>Xác nhận</a></li>
            <li><a href="/PassdoSV.com/backend/sanpham/index.php"><i class='bx bx-basket'></i>Sản phẩm</a></li>
            <li class="active"><a href="/PassdoSV.com/backend/khachhang/index.php"><i class='bx bx-group'></i>Khách hàng</a></li>
            <li><a href="/PassdoSV.com/backend/dondathang/index.php"><i class='bx bx-package'></i>Đơn đặt hàng</a></li>
            <?php if ($_SESSION['kh_quantri'] == true) { ?>
                <li><a href="/PassdoSV.com/backend/gopy/index.php"><i class='bx bx-message-dots'></i>Góp ý</a></li>
            <?php } ?>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/PassdoSV.com/dangxuat.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count"><?= $dataXN['tongxn'] ?></span>
            </a>
            <a href="#" class="profile">
                <?php if ($_SESSION['kh_quantri'] == true) : ?>
                    <img src="/PassdoSV.com/backend/Dashboard/images/logo.jpg">
                <?php else : ?>
                    <img src="/PassdoSV.com/backend/Dashboard/images/logo_user.png">
                <?php endif; ?>
             </a>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="/PassdoSV.com/backend/Dashboard/dashboard.php">
                                Dashboard
                            </a></li>
                        /
                        <li><a href="/PassdoSV.com/backend/xacnhan/xacnhan.php" class="active">Xác nhận</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a>
            </div>

            <!-- Insights -->
            <ul class="insights">
                <?php if ($_SESSION['kh_quantri'] == 1) : ?>
                    <li>
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?= $dataXN['tongxn'] ?>
                            </h3>
                            <p>Xác nhận</p>
                        </span>
                    </li>
                    <li><i class='bx bx-cart'></i>
                        <span class="info">
                            <h3>
                                <?= $dataTSP['tongsp'] ?>
                            </h3>
                            <p>Sản phẩm</p>
                        </span>
                    </li>
                    <li><i class='bx bx-user'></i>
                        <span class="info">
                            <h3>
                                <?= $dataTKH['tongkh'] ?>
                            </h3>
                            <p>Khách hàng</p>
                        </span>
                    </li>
                    <li><i class='bx bx-package'></i>
                        <span class="info">
                            <h3>
                                <?= $dataDDH['tongddh'] ?>
                            </h3>
                            <p>Đơn đặt hàng</p>
                        </span>
                    </li>
                <?php else : ?>
                    <li>
                        <i class='bx bx-calendar-check'></i>
                        <span class="info">
                            <h3>
                                <?= $dataXNCN['tongxncn'] ?>
                            </h3>
                            <p>Xác nhận</p>
                        </span>
                    </li>
                    <li><i class='bx bx-cart'></i>
                        <span class="info">
                            <h3>
                                <?= $dataSPCN['tongspcn'] ?>
                            </h3>
                            <p>Sản phẩm</p>
                        </span>
                    </li>
                    <li><i class='bx bx-package'></i>
                        <span class="info">
                            <h3>
                                <?= $dataDHCN['tongdhcn'] ?>
                            </h3>
                            <p>Đơn đặt hàng</p>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- End of Insights -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Khách hàng</h3>
                        <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                    </div>
                    <?php
                    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
                        echo '<script>location.href="../../dangnhap.php";</script>';
                    } elseif ($_SESSION['kh_quantri'] == true) {
                    ?>
                        <?php
                        $kh_ma = $_GET['kh_ma'];
                        $sqlKH = "SELECT * FROM khach_hang WHERE kh_ma = $kh_ma;";
                        $resultKH = mysqli_query($conn, $sqlKH);
                        $dataKH = [];
                        while ($row = mysqli_fetch_array($resultKH, MYSQLI_ASSOC)) {
                            $dataKH = array(
                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                'kh_ten' => $row['kh_ten']
                            );
                        }
                        ?>
                        <form action="" method="post" id="doiPass">
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label>Tên đăng nhập:</label>
                                    <input type="text" name="kh_tendangnhap" value="<?= $dataKH['kh_tendangnhap'] ?>" class="form-control" disabled>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label>Tên khách hàng:</label>
                                    <input type="text" name="kh_ten" value="<?= $dataKH['kh_ten'] ?>" class="form-control" disabled>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label>Mật khẩu mới:</label>
                                    <input type="password" name="kh_matkhau" id="kh_matkhau" placeholder="Mật khẩu mới" class="form-control">
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label>Tên khách hàng:</label>
                                    <input type="password" name="kh_matkhau1" id="kh_matkhau1" placeholder="Nhập lại mật khẩu" class="form-control">
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <button name="btnLay" class="btn btn-primary">Lấy lại mật khẩu</button>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['btnLay'])) {
                            $kh_matkhau = sha1($_POST['kh_matkhau']);
                            $sqlUD = "UPDATE khach_hang
                                SET
                                    kh_matkhau='$kh_matkhau'
                                WHERE kh_ma = $kh_ma;";
                            mysqli_query($conn, $sqlUD);
                            echo '<script>location.href="index.php"</script>';
                        }
                        ?>
                    <?php } ?>
                </div>
        </main>

    </div>

    <script src="/PassdoSV.com/backend/Dashboard/index.js"></script>
</body>
<script src="/PassdoSV.com/assets/vendor/jquery/jquery.min.js"></script>
<script src="/PassdoSV.com/assets/vendor/datatable/datatables.min.js"></script>
<script src="/PassdoSv.com/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('#danhsach').DataTable();
    });
    $(document).ready(function() {
        $('#doiPass').validate({
            rules: {
                kh_matkhau: {
                    required: true,
                    equalTo: "#kh_matkhau1",
                },
                kh_matkhau1: {
                    required: true,
                    equalTo: "#kh_matkhau"
                }
            },
            messages: {
                kh_matkhau: {
                    required: "Vui lòng nhập mật khẩu mới",
                    equalTo: "Mật khẩu không trùng khớp vui lòng nhập lại",
                },
                kh_matkhau1: {
                    required: "Vui lòng nhập mật khẩu mới",
                    equalTo: "Mật khẩu không trùng khớp vui lòng nhập lại",
                }
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Thêm class `invalid-feedback` cho field đang có lỗi
                error.addClass("invalid-feedback");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            success: function(label, element) {},
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        })
    });
</script>

</html>