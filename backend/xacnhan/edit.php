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
<?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    echo '<script>location.href="../../dangnhap.php";</script>';
} else { ?>

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
            <?php
            $sqlLSP = "SELECT * FROM loai_san_pham";
            $resultLSP = mysqli_query($conn, $sqlLSP);
            $dataLSP = [];
            while ($row = mysqli_fetch_array($resultLSP, MYSQLI_ASSOC)) {
                $dataLSP[] = array(
                    'lsp_ma' => $row['lsp_ma'],
                    'lsp_ten' => $row['lsp_ten']
                );
            }
            $sqlLH = "SELECT * FROM lien_he";
            $resultLH = mysqli_query($conn, $sqlLH);
            $dataLH = [];
            while ($row = mysqli_fetch_array($resultLH, MYSQLI_ASSOC)) {
                $dataLH[] = array(
                    'lh_ma' => $row['lh_ma'],
                    'lh_ten' => $row['lh_ten']
                );
            }
            $sqlHTTT = "SELECT * FROM hinh_thuc_thanh_toan";
            $resultHTTT = mysqli_query($conn, $sqlHTTT);
            $dataHTTT = [];
            while ($row = mysqli_fetch_array($resultHTTT, MYSQLI_ASSOC)) {
                $dataHTTT[] = array(
                    'httt_ma' => $row['httt_ma'],
                    'httt_ten' => $row['httt_ten']
                );
            }
            ?>
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
                            <li><a href="#" class="active">Xác nhận</a></li>
                            /
                            <li><a href="#" class="active">Chỉnh sửa</a></li>
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
                $xn_ma = $_GET['xn_ma'];
                $sqlSLXN = "SELECT xn.*,lsp.lsp_ten,lh.lh_ten,httt.httt_ten
    FROM xac_nhan_ban_sp xn JOIN loai_san_pham lsp ON xn.lsp_ma = lsp.lsp_ma
                                            JOIN lien_he lh ON xn.lh_ma = lh.lh_ma
                                            JOIN hinh_thuc_thanh_toan httt  ON xn.httt_ma = httt.httt_ma
                                            WHERE xn_ma = $xn_ma;";
                $resultSLXN = mysqli_query($conn, $sqlSLXN);
                $dataSLXN = [];
                while ($row = mysqli_fetch_array($resultSLXN, MYSQLI_ASSOC)) {
                    $dataSLXN = array(
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
                        'httt_ma' => $row['httt_ma']
                    );
                }
                ?>
                <!-- End of Insights -->
                <div class="bottom-data">
                    <div class="orders">
                        <div class="header">
                            <i class='bx bx-receipt'></i>
                            <h3>Xác nhận</h3>
                            <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                        </div>
                        <?php
                        if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
                            echo '<script>location.href="../../dangnhap.php";</script>';
                        } elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) { ?>
                            <form action="" method="post" name="frmDangSP" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Tên sản phẩm: </label>
                                    <input type="text" name="sp_ten" value="<?= $dataSLXN['sp_ten'] ?>" class="form-control">
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Giá cũ sản phẩm:</label>
                                        <input type="text" name="sp_giacu" class="form-control" value="<?= $dataSLXN['sp_giacu'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Giá mới sản phẩm:</label>
                                        <input type="text" name="sp_gia" class="form-control" value="<?= $dataSLXN['sp_gia'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Số lượng:</label>
                                        <input type="number" name="sp_soluong" class="form-control" value="<?= $dataSLXN['sp_soluong'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Ngày cập nhật:</label>
                                        <input type="date" name="sp_ngaycapnhat" class="form-control" value="<?= $dataSLXN['sp_ngaycapnhat'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả sản phẩm</label>
                                    <textarea name="sp_mota" class="form-control" id="sp_mota"><?= $dataSLXN['sp_mota'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Loại sản phẩm:</label>
                                    <select name="lsp_ma" class="form-control">
                                        <?php foreach ($dataLSP as $lsp) : ?>
                                            <?php if ($lsp['lsp_ma'] == $dataSLXN['sp_ma']) : ?>
                                                <option value="<?= $lsp['lsp_ma'] ?>" selected><?= $lsp['lsp_ten'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $lsp['lsp_ma'] ?>"><?= $lsp['lsp_ten'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hình thức liên hệ:</label>
                                    <select name="lh_ma" class="form-control">
                                        <?php foreach ($dataLH as $lh) : ?>
                                            <?php if ($lh['lh_ma'] == $dataSLXN['lh_ma']) : ?>
                                                <option value="<?= $lh['lh_ma'] ?>" selected><?= $lh['lh_ten'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $lh['lh_ma'] ?>"><?= $lh['lh_ten'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hình thức thanh toán:</label>
                                    <select name="httt_ma" class="form-control">
                                        <?php foreach ($dataHTTT as $httt) : ?>
                                            <?php if ($httt['httt_ma'] == $dataSLXN['htt_ma']) : ?>
                                                <option value="<?= $httt['httt_ma'] ?>" selected><?= $httt['httt_ten'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hình sản phẩm:</label>
                                    <input type="file" name="hsp_tentaptin" id="hsp_tentaptin">
                                    <div>
                                        <img src="/PassdoSV.com/assets/wait/<?= $dataSLXN['hsp_tentaptin'] ?>" id="preview-img" style="width: 150px;">
                                    </div>
                                </div>
                                <button name="btnLuu" class="btn btn-primary">Lưu</button>
                            </form>
                            <?php
                            if (isset($_POST['btnLuu'])) {
                                $sp_ten = $_POST['sp_ten'];
                                $sp_giacu = $_POST['sp_giacu'];
                                $sp_gia = $_POST['sp_gia'];
                                $sp_soluong = $_POST['sp_soluong'];
                                $sp_mota = $_POST['sp_mota'];
                                $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
                                $lsp_ma = $_POST['lsp_ma'];
                                $lh_ma = $_POST['lh_ma'];
                                $httt_ma = $_POST['httt_ma'];
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                if (!empty($_FILES['hsp_tentaptin']['name'])) {
                                    $uploadDir = __DIR__ . '/../../assets/wait/';
                                    $newFile = date('Ymd_His') . '_' . $_FILES['hsp_tentaptin']['name'];
                                    unlink($uploadDir . $dataSLXN['hsp_tentaptin']);
                                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $uploadDir . $newFile);
                                    $sqlISXN = "UPDATE xac_nhan_ban_sp
                                SET
                                    sp_ten='$sp_ten',
                                    sp_giacu=$sp_giacu,
                                    sp_gia=$sp_gia,
                                    sp_soluong=$sp_soluong,
                                    sp_mota='$sp_mota',
                                    sp_ngaycapnhat='$sp_ngaycapnhat',
                                    hsp_tentaptin='$newFile',
                                    lsp_ma=$lsp_ma,
                                    lh_ma=$lh_ma,
                                    httt_ma=$httt_ma
                                WHERE xn_ma = $xn_ma;";
                                    mysqli_query($conn, $sqlISXN);
                                    echo '<script>location.href="/PassdoSV.com/backend/xacnhan/xacnhan.php"</script>';
                                }
                            }
                            ?>
                        <?php } ?>
                    </div>

            </main>

        </div>

        <script src="/PassdoSV.com/backend/Dashboard/index.js"></script>
    </body>
<?php } ?>
<script src="/PassdoSV.com/assets/vendor/jquery/jquery.min.js"></script>
<script src="/PassdoSV.com/assets/vendor/datatable/datatables.min.js"></script>
<script src="/PassdoSv.com/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
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
    $(document).ready(function() {
        $('#frmDangSP').validate({
            rules: {
                sp_ten: {
                    required: true,
                    maxlength: 50,
                },
                sp_giacu: {
                    required: true,
                    number: true
                },
                sp_gia: {
                    required: true,
                    number: true
                },
                sp_soluong: {
                    required: true,
                    number: true
                },
                sp_ngaycapnhat: {
                    date: true,
                    required: true
                },
                sp_mota: {
                    required: true,
                    maxlength: 1024
                },
                hsp_tentaptin: {
                    required: true,
                    maxlength: 10
                }
            },
            messages: {
                sp_ten: {
                    required: "Vui lòng không để trống !",
                    maxlength: "Tên sản phẩm không được vượt quá 50 kí tự !"
                },
                sp_giacu: {
                    required: "Vui lòng không để trống !",
                    number: "Vui lòng nhập giá không chứ kí tự !"
                },
                sp_gia: {
                    required: "Vui lòng không để trống !",
                    number: "Vui lòng nhập giá không chứ kí tự !"
                },
                sp_soluong: {
                    required: "Vui lòng không để trống !",
                    number: "Vui lòng nhập số lượng không chứ kí tự !"
                },
                sp_ngaycapnhat: {
                    date: "Vui lòng nhập ngày!",
                    required: "Vui lòng không để trống !"
                },
                sp_mota: {
                    required: "Vui lòng không dể trống !",
                    maxlength: "Mô tả sản phẩm không được vượt quá 1024 kí tự !"
                },
                hsp_tentaptin: {
                    required: "Vui lòng không để trống hình sản phẩm !",
                    maxlength: "Tên tập tin không được vượt quá 10 kí tự !",
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