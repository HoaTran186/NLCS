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
            <li><a href="/PassdoSV.com/backend/khachhang/index.php"><i class='bx bx-group'></i>Khách hàng</a></li>
            <li class="active"><a href="/PassdoSV.com/backend/dondathang/index.php"><i class='bx bx-package'></i>Đơn đặt hàng</a></li>
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
            <form action="/PassdoSV.com/index.php">
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
                        <li><a href="/PassdoSV.com/backend/xacnhan/xacnhan.php" class="active">Đơn đặt hàng</a></li>
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
                        <h3>Đơn đặt hàng</h3>
                        <?php if ($_SESSION['kh_quantri'] == false) : ?>
                            <a href="xacnhan.php"><i class='bx bx-bell'>
                                </i></a>
                        <?php endif; ?>
                        <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                    </div>
                    <?php
                    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
                        echo '<script>location.href="../../dangnhap.php";</script>';
                    } elseif ($_SESSION['kh_quantri'] == true) {
                    ?>
                        <?php
                        $sqlDHKH1 = "SELECT dh.*,spdh.sp_dh_soluong,spdh.sp_dh_dongia,sp.sp_ten,kh.kh_ten,ttdh.ttdh_ten
                        FROM don_dat_hang dh
                        JOIN khach_hang kh ON kh.kh_ma = dh.kh_ma
                        JOIN sanpham_dondathang spdh ON dh.dh_ma = spdh.dh_ma
                        JOIN san_pham sp ON sp.sp_ma = spdh.sp_ma
                        JOIN trang_thai_don_hang ttdh ON ttdh.ttdh_ma = dh.ttdh_ma;";
                        $resultDHKH1 = mysqli_query($conn, $sqlDHKH1);
                        $dataDHKH1 = [];
                        while ($row = mysqli_fetch_array($resultDHKH1, MYSQLI_ASSOC)) {
                            $dataDHKH1[] = array(
                                'ttdh_ma' => $row['ttdh_ma'],
                                'dh_ma' => $row['dh_ma'],
                                'kh_ten' => $row['kh_ten'],
                                'dh_ngaydat' => $row['dh_ngaydat'],
                                'ttdh_ten' => $row['ttdh_ten'],
                                'sp_ten' => $row['sp_ten'],
                                'kh_diachi' => $row['kh_diachi'],
                                'sp_dh_soluong' => $row['sp_dh_soluong'],
                                'sp_dh_dongia' => $row['sp_dh_dongia']
                            );
                        }
                        ?>
                        <table id="danhsach" class="display">
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Ngày đặt</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataDHKH1 as $dh1) : ?>
                                    <tr>
                                        <td>
                                            <?= $dh1['kh_ten'] ?>
                                        </td>
                                        <td><?= $dh1['sp_ten'] ?></td>
                                        <td><?= $dh1['sp_dh_soluong'] ?></td>
                                        <td><?= $dh1['sp_dh_dongia'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($dh1['dh_ngaydat'])) ?></td>
                                        <td><?= $dh1['kh_diachi'] ?></td>
                                        <td>
                                            <?php if ($dh1['ttdh_ma'] == 1) : ?>
                                                <span class="status completed"><?= $dh1['ttdh_ten'] ?></span>
                                            <?php elseif ($dh1['ttdh_ma'] == 2) : ?>
                                                <span class="status process"><?= $dh1['ttdh_ten'] ?></span>
                                            <?php elseif ($dh1['ttdh_ma'] == 3) : ?>
                                                <span class="status pending"><?= $dh1['ttdh_ten'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="delete.php?dh_ma=<?= $dh1['dh_ma'] ?>"><i class='bx bx-x-circle'></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <?php if (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) { ?>
                        <?php
                        $kh_ma = $_SESSION['kh_ma'];
                        $sqlDH = "SELECT dh.*,spdh.sp_dh_soluong,spdh.sp_dh_dongia,sp.sp_ten,kh.kh_ten,ttdh.ttdh_ten
                        FROM don_dat_hang dh
                        JOIN khach_hang kh ON kh.kh_ma = dh.kh_ma
                        JOIN sanpham_dondathang spdh ON dh.dh_ma = spdh.dh_ma
                        JOIN san_pham sp ON sp.sp_ma = spdh.sp_ma
                        JOIN trang_thai_don_hang ttdh ON ttdh.ttdh_ma = dh.ttdh_ma
                        WHERE dh.kh_ma = $kh_ma;";
                        $resultDH = mysqli_query($conn, $sqlDH);
                        $dataDH = [];
                        while ($row = mysqli_fetch_array($resultDH, MYSQLI_ASSOC)) {
                            $dataDH[] = array(
                                'ttdh_ma' => $row['ttdh_ma'],
                                'dh_ma' => $row['dh_ma'],
                                'kh_ten' => $row['kh_ten'],
                                'dh_ngaydat' => $row['dh_ngaydat'],
                                'ttdh_ten' => $row['ttdh_ten'],
                                'sp_ten' => $row['sp_ten'],
                                'kh_diachi' => $row['kh_diachi'],
                                'sp_dh_soluong' => $row['sp_dh_soluong'],
                                'sp_dh_dongia' => $row['sp_dh_dongia']
                            );
                        }
                        ?>
                        <table id="danhsach" class="display">
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Ngày đặt</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataDH as $dh) : ?>
                                    <tr>
                                        <td>
                                            <?= $dh['kh_ten'] ?>
                                        </td>
                                        <td><?= $dh['sp_ten'] ?></td>
                                        <td><?= $dh['sp_dh_soluong'] ?></td>
                                        <td><?= $dh['sp_dh_dongia'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($dh['dh_ngaydat'])) ?></td>
                                        <td><?= $dh['kh_diachi'] ?></td>
                                        <?php if ($dh['ttdh_ma'] == 1) : ?>
                                            <td><span class="status completed"><?= $dh['ttdh_ten'] ?></span></td>
                                        <?php elseif ($dh['ttdh_ma'] == 2) : ?>
                                            <td><span class="status process"><?= $dh['ttdh_ten'] ?></span></td>
                                        <?php elseif ($dh['ttdh_ma'] == 3) : ?>
                                            <td><span class="status pending"><?= $dh['ttdh_ten'] ?></span></td>
                                        <?php endif; ?>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="dh_ma" value="<?= $dh['dh_ma'] ?>">
                                                <?php if ($dh['ttdh_ma'] == 3) : ?>
                                                    <button class="link-button" name="btnXNGH"><i class='bx bx-check-circle'></i></button>
                                                <?php endif; ?>
                                                <button class="link-button" name="btnDLDH"><i class='bx bx-x-circle'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <?php
                            if (isset($_POST['btnXNGH'])) {
                                $dh_ma = $_POST['dh_ma'];
                                $sqlUDGH = "UPDATE don_dat_hang
                                    SET
                                        ttdh_ma=1
                                    WHERE dh_ma = $dh_ma;";
                                mysqli_query($conn, $sqlUDGH);
                                echo '<script>location.href ="index.php";</script>';
                            }
                            ?>
                            <?php
                            if (isset($_POST['btnDLDH'])) {
                                $dh_ma = $_POST['dh_ma'];
                                $sqlSPDH = "DELETE FROM sanpham_dondathang WHERE dh_ma = $dh_ma;";
                                $sqlDH = "DELETE FROM don_dat_hang WHERE dh_ma=$dh_ma;";
                                $sql = "DELETE FROM xn_donhang WHERE dh_ma = $dh_ma;";
                                mysqli_query($conn, $sqlSPDH);
                                mysqli_query($conn, $sql);
                                mysqli_query($conn, $sqlDH);
                                echo '<script>location.href ="index.php";</script>';
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
<script>
    $(document).ready(function() {
        $('#danhsach').DataTable();
    });
</script>

</html>