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
                        <li><a href="/PassdoSV.com/backend/xacnhan/xacnhan.php" class="active">Khách hàng</a></li>
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
                        $sqlKH = "SELECT *
                            FROM khach_hang
                            WHERE kh_tendangnhap <> 'admin';";
                        $resultKH = mysqli_query($conn, $sqlKH);
                        $dataKH = [];
                        while ($row = mysqli_fetch_array($resultKH, MYSQLI_ASSOC)) {
                            $dataKH[] = array(
                                'kh_ma' => $row['kh_ma'],
                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                'kh_ten' => $row['kh_ten'],
                                'kh_mssv' => $row['kh_mssv'],
                                'kh_diachi' => $row['kh_diachi'],
                                'kh_dienthoai' => $row['kh_dienthoai'],
                                'kh_email' => $row['kh_email'],
                            );
                        }
                        ?>
                        <table id="danhsach" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Tên khách hàng</th>
                                    <th>MSSV</th>
                                    <th>Địa chỉ</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataKH as $kh) : ?>
                                    <tr>
                                        <td><?= $kh['kh_ma'] ?></td>
                                        <td><?= $kh['kh_tendangnhap'] ?></td>
                                        <td><?= $kh['kh_ten'] ?></td>
                                        <td><?= $kh['kh_mssv'] ?></td>
                                        <td><?= $kh['kh_diachi'] ?></td>
                                        <td><?= $kh['kh_dienthoai'] ?></td>
                                        <td><?= $kh['kh_email'] ?></td>
                                        <td>
                                            <a href="delete.php?kh_ma=<?= $kh['kh_ma'] ?>"><i class='bx bx-user-x'></i></a>
                                            <a href="pass.php?kh_ma=<?= $kh['kh_ma'] ?>"><i class='bx bx-lock-open-alt'></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <?php if (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) { ?>
                        <?php
                        $kh_ma = $_SESSION['kh_ma'];
                        $sqlKHC = "SELECT * FROM khach_hang WHERE kh_ma = $kh_ma;";
                        $resultKHC = mysqli_query($conn, $sqlKHC);
                        $dataKHC = [];
                        while ($row = mysqli_fetch_array($resultKHC, MYSQLI_ASSOC)) {
                            $dataKHC = array(
                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                'kh_ten' => $row['kh_ten'],
                                'kh_mssv' => $row['kh_mssv'],
                                'kh_diachi' => $row['kh_diachi'],
                                'kh_dienthoai' => $row['kh_dienthoai'],
                                'kh_email' => $row['kh_email'],
                                'kh_gioitinh' => $row['kh_gioitinh'],
                                'kh_ngaythangnamsinh' => $row['kh_ngaythangnamsinh']
                            );
                        }
                        ?>
                        <form action="" method="post" name="frmSuatt" id="frmSuatt">
                            <div class="form-group">
                                <label>Tên đăng nhập:</label>
                                <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" class="form-control" value="<?= $dataKHC['kh_tendangnhap'] ?>">
                            </div>
                            <!-- <div class="form-group">
                            <label>Mật khẩu:</label>
                            <input type="password" name="kh_matkhau" class="form-control" >
                        </div> -->
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Tên hiển thị:</label>
                                    <input type="text" name="kh_ten" id="kh_ten" class="form-control" value="<?= $dataKHC['kh_ten'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Mã số sinh viên:</label>
                                    <input type="text" name="kh_mssv" id="kh_mssv" class="form-control" value="<?= $dataKHC['kh_mssv'] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Giới tính:</label>
                                    <select name="kh_gioitinh" class="form-control" id="kh_gioitinh">
                                        <?php if ($dataKHC['kh_gioitinh'] == 0) : ?>
                                            <option value="0" selected>Nam</option>
                                            <option value="1">Nữ</option>
                                        <?php else : ?>
                                            <option value="0">Nam</option>
                                            <option value="1" selected>Nữ</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Ngày tháng năm sinh:</label>
                                    <input type="date" name="kh_ngaythangnamsinh" id="kh_ngaythangnamsinh" class="form-control" value="<?= $dataKHC['kh_ngaythangnamsinh'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input type="text" name="kh_diachi" class="form-control" id="kh_diachi" value="<?= $dataKHC['kh_diachi'] ?>">
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Số điện thoại:</label>
                                    <input type="tel" name="kh_dienthoai" id="kh_dienthoai" class="form-control" value="<?= $dataKHC['kh_dienthoai'] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label>Email sinh viên:</label>
                                    <input type="email" name="kh_email" id="kh_email" class="form-control" value="<?= $dataKHC['kh_email'] ?>">
                                </div>
                            </div>
                            <br>
                            <button class="btn btn-primary" name="btnLuu">Lưu</button>
                        </form>
                        <?php
                        if (isset($_POST['btnLuu'])) {
                            $kh_tendangnhap = $_POST['kh_tendangnhap'];
                            $kh_ten = $_POST['kh_ten'];
                            $kh_mssv = $_POST['kh_mssv'];
                            $kh_goitinh = $_POST['kh_gioitinh'];
                            $kh_ngaythangnamsinh = $_POST['kh_ngaythangnamsinh'];
                            $kh_diachi = $_POST['kh_diachi'];
                            $kh_dienthoai = $_POST['kh_dienthoai'];
                            $kh_email = $_POST['kh_email'];
                            $sqlUDKH = "UPDATE khach_hang
            SET
                kh_tendangnhap='$kh_tendangnhap',
                kh_ten='$kh_ten',
                kh_mssv='$kh_mssv',
                kh_gioitinh=$kh_goitinh,
                kh_diachi='$kh_diachi',
                kh_dienthoai='$kh_dienthoai',
                kh_email='$kh_email',
                kh_ngaythangnamsinh='$kh_ngaythangnamsinh'
            WHERE kh_ma = $kh_ma;";
                            mysqli_query($conn, $sqlUDKH);
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
        $('#frmSuatt').validate({
            rules: {
                kh_tendanhnhap: {
                    required: true,
                },
                kh_ten: {
                    required: true,
                },
                kh_mssv: {
                    required: true,
                    minlength: 8,
                    maxlength: 8
                },
                kh_ngaythangnamsinh: {
                    required: true,
                    date: true
                },
                kh_diachi: {
                    required: true,
                    minlength: 5
                },
                kh_dienthoai: {
                    required: true,
                    number: true
                },
                kh_email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                kh_tendangnhap: {
                    required: "Vui lòng không để trống !",
                },
                kh_ten: {
                    rerequired: "Vui lòng không để trống !",
                },
                kh_mssv: {
                    required: "Vui lòng không để trống !",
                    minlength: "Vui lòng nhập mã số sinh viên gồm 8 kí tự !",
                    maxlength: "Vui lòng nhập mã số sinh viên gồm 8 kí tự !"
                },
                kh_ngaythangnamsinh: {
                    required: "Vui lòng không để trống !",
                    date: "Vui lòng nhập ngày tháng năm sinh !"
                },
                kh_diachi: {
                    required: "Vui lòng không để trống !",
                    minlength: "Vui lòng nhập dia chỉ dài hơn 5 kí tự !"
                },
                kh_dienthoai: {
                    required: "Vui lòng không để trống !",
                    number: "Vui lòng nhập số không chứa kí tự !"
                },
                kh_email: {
                    required: "Vui lòng không để trống !",
                    email: "Vui lòng nhập email đúng !"
                },

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