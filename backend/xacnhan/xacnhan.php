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
    <!-- <link rel="stylesheet" href="/PassdoSV.com/assets/vendor/Chart.js/Chart.min.css"> -->
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
            <li class="active"><a href="/PassdoSV.com/backend/xacnhan/xacnhan.php"><i class='bx bx-task'></i>Xác nhận</a></li>
            <li><a href="/PassdoSV.com/backend/sanpham/index.php"><i class='bx bx-basket'></i>Sản phẩm</a></li>
            <li><a href="/PassdoSV.com/backend/khachhang/index.php"><i class='bx bx-group'></i>Khách hàng</a></li>
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
            <?php
            $sqlSLXN = "SELECT xn.*,lsp.lsp_ten,lh.lh_ten,httt.httt_ten
    FROM xac_nhan_ban_sp xn JOIN loai_san_pham lsp ON xn.lsp_ma = lsp.lsp_ma
                                            JOIN lien_he lh ON xn.lh_ma = lh.lh_ma
                                            JOIN hinh_thuc_thanh_toan httt  ON xn.httt_ma = httt.httt_ma;";
            $resultSLXN = mysqli_query($conn, $sqlSLXN);
            $dataSLXN = [];
            while ($row = mysqli_fetch_array($resultSLXN, MYSQLI_ASSOC)) {
                $dataSLXN[] = array(
                    'xn_ma' => $row['xn_ma'],
                    'sp_ten' => $row['sp_ten'],
                    'sp_gia' => $row['sp_gia'],
                    'sp_giacu' => $row['sp_giacu'],
                    'sp_soluong' => $row['sp_soluong'],
                    'sp_mota' => $row['sp_mota'],
                    'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
                    'hsp_tentaptin' => $row['hsp_tentaptin'],
                    'lsp_ten' => $row['lsp_ten'],
                    'lh_ten' => $row['lh_ten'],
                    'httt_ten' => $row['httt_ten']
                );
            }
            ?>
            <!-- End of Insights -->
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Xác nhận</h3>
                        <?php if ($_SESSION['kh_quantri'] == false) : ?>
                            <a href="add.php"><i class='bx bx-plus'></i></i></a>
                        <?php endif; ?>
                        <!-- <i class='bx bx-search'></i> -->
                    </div>
                    <?php
                    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
                        echo '<script>location.href="../../dangnhap.php";</script>';
                    } elseif ($_SESSION['kh_quantri'] == true) {
                    ?>
                        <table id="danhsach" class="display">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Mô tả sản phẩm</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Hình sản phẩm</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Phương thức liên hệ</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataSLXN as $xn) : ?>
                                    <tr>
                                        <td><?= $xn['xn_ma'] ?></td>
                                        <td><?= $xn['sp_ten'] ?></td>
                                        <td><?= number_format($xn['sp_gia'], 0, '.', ',') ?>
                                            <small><del><?= number_format($xn['sp_giacu'], 0, '.', ',') ?></del></small>
                                        </td>
                                        <td><?= $xn['sp_soluong'] ?></td>
                                        <td><?= $xn['sp_mota'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($xn['sp_ngaycapnhat'])) ?></td>
                                        <td>
                                            <img src="/PassdoSV.com/assets/wait/<?= $xn['hsp_tentaptin'] ?>" style="width: 50px;">
                                        </td>
                                        <td><?= $xn['lsp_ten'] ?></td>
                                        <td><?= $xn['lh_ten'] ?></td>
                                        <td><?= $xn['httt_ten'] ?></td>
                                        <td><a href="success.php?xn_ma=<?= $xn['xn_ma'] ?>"><i class='bx bx-task'></i></a>
                                            <a href="deletecn.php?xn_ma=<?= $xn['xn_ma'] ?>" class="btnDelete" data-xn_ma="<?= $xn['xn_ma'] ?>"><i class='bx bx-task-x'></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <?php if (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) { ?>
                        <?php
                        $sqlSLXNCN = "SELECT xn.*,lsp.lsp_ten,lh.lh_ten,httt.httt_ten
    FROM xac_nhan_ban_sp xn JOIN loai_san_pham lsp ON xn.lsp_ma = lsp.lsp_ma
                                            JOIN lien_he lh ON xn.lh_ma = lh.lh_ma
                                            JOIN hinh_thuc_thanh_toan httt  ON xn.httt_ma = httt.httt_ma
                                            WHERE kh_ma = $kh_ma;";
                        $resultSLXNCN = mysqli_query($conn, $sqlSLXNCN);
                        $dataSLXNCN = [];
                        while ($row = mysqli_fetch_array($resultSLXNCN, MYSQLI_ASSOC)) {
                            $dataSLXNCN[] = array(
                                'xn_ma' => $row['xn_ma'],
                                'sp_ten' => $row['sp_ten'],
                                'sp_gia' => $row['sp_gia'],
                                'sp_giacu' => $row['sp_giacu'],
                                'sp_soluong' => $row['sp_soluong'],
                                'sp_mota' => $row['sp_mota'],
                                'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
                                'hsp_tentaptin' => $row['hsp_tentaptin'],
                                'lsp_ten' => $row['lsp_ten'],
                                'lh_ten' => $row['lh_ten'],
                                'httt_ten' => $row['httt_ten']
                            );
                        }
                        ?>
                        <table id="danhsach" class="display">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Mô tả sản phẩm</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Hình sản phẩm</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Phương thức liên hệ</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataSLXNCN as $xncn) : ?>
                                    <tr>
                                        <td><?= $xncn['xn_ma'] ?></td>
                                        <td><?= $xncn['sp_ten'] ?></td>
                                        <td><?= number_format($xncn['sp_gia'], 0, '.', ',') ?>
                                            <small><del><?= number_format($xncn['sp_giacu'], 0, '.', ',') ?></del></small>
                                        </td>
                                        <td><?= $xncn['sp_soluong'] ?></td>
                                        <td><?= $xncn['sp_mota'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($xncn['sp_ngaycapnhat'])) ?></td>
                                        <td>
                                            <img src="/PassdoSV.com/assets/wait/<?= $xncn['hsp_tentaptin'] ?>" style="width: 50px;">
                                        </td>
                                        <td><?= $xncn['lsp_ten'] ?></td>
                                        <td><?= $xncn['lh_ten'] ?></td>
                                        <td><?= $xncn['httt_ten'] ?></td>
                                        <td><a href="edit.php?xn_ma=<?= $xncn['xn_ma'] ?>"><i class='bx bx-edit'></i></a>
                                            <a href="deletecn.php?xn_ma=<?= $xncn['xn_ma'] ?>" class="btnDelete" data-xn_ma="<?= $xncn['xn_ma'] ?>"><i class='bx bx-task-x'></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
    $(document).ready(function() {
        const reader = new FileReader();
        const fileInput = document.getElementById("hsp_tentaptin")
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    });
</script>

</html>