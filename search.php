<?php
session_start();
?>
<?php
function sanitizeAndValidate($value)
{
    return filter_var($value, FILTER_VALIDATE_INT, array('options' => array('default' => 10000000)));
}
$sp_ten = isset($_GET['sp_ten']) ? $_GET['sp_ten'] : ' ';
$lsp_ma1 = isset($_GET['lsp_ma1']) ? $_GET['lsp_ma1'] : 'NULL';
$lsp_ma2 = isset($_GET['lsp_ma2']) ? $_GET['lsp_ma2'] : 'NULL';
$lsp_ma3 = isset($_GET['lsp_ma3']) ? $_GET['lsp_ma3'] : 'NULL';
$lsp_ma4 = isset($_GET['lsp_ma4']) ? $_GET['lsp_ma4'] : 'NULL';
$sp_giamin = isset($_GET['sp_giamin']) ? (int)$_GET['sp_giamin'] : 0;
$sp_giamax = isset($_GET['sp_giamax']) ? sanitizeAndValidate($_GET['sp_giamax']) : 10000000;
if ($lsp_ma1 == 'NULL' && $lsp_ma2 == 'NULL' && $lsp_ma3 == 'NULL' && $lsp_ma4 == 'NULL') {
    $lsp_ma1 = '1';
    $lsp_ma2 = '2';
    $lsp_ma3 = '3';
    $lsp_ma4 = '4';
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sản phẩm</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php
include_once __DIR__ . '/dbconnect.php';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 9;
$startFrom = ($page - 1) * $itemsPerPage;
//echo "Debug: lsp_ma1=$lsp_ma1, lsp_ma2=$lsp_ma2, lsp_ma3=$lsp_ma3, lsp_ma4=$lsp_ma4, sp_ten=$sp_ten, sp_giamin=$sp_giamin, sp_giamax=$sp_giamax";
$sqlLSP = "SELECT * 
FROM san_pham
WHERE (lsp_ma = $lsp_ma1 || lsp_ma = $lsp_ma2 || lsp_ma = $lsp_ma3 || lsp_ma = $lsp_ma4) 
AND (sp_ten LIKE '%$sp_ten%')
AND (sp_gia BETWEEN $sp_giamin AND $sp_giamax)
ORDER BY sp_ngaycapnhat
LIMIT $itemsPerPage OFFSET $startFrom ;";
$resultLSP = mysqli_query($conn, $sqlLSP);
$dataLSP = [];
while ($row = mysqli_fetch_array($resultLSP, MYSQLI_ASSOC)) {
    $dataLSP[] = array(
        'sp_soluong' => $row['sp_soluong'],
        'sp_ma' => $row['sp_ma'],
        'sp_ten' => $row['sp_ten'],
        'sp_gia' => $row['sp_gia'],
        'sp_giacu' => $row['sp_giacu'],
        'hsp_tentaptin' => $row['hsp_tentaptin'],
    );
}
?>
<?php
if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
} else {
    if (empty($_SESSION['giohangdata'])) {
        $numberOfProducts = 0;
    } else {
        $numberOfProducts = count($_SESSION['giohangdata']);
    }
}
?>


<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="/PassdoSV.com/backend/Dashboard/dashboard.php"><span class="icon_id-2"></span>
                    <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) : ?>
                        <div class="tip">0</div>
                    <?php else : ?>
                        <?php
                        $kh_ma = $_SESSION['kh_ma'];
                        $sql = "SELECT COUNT(*) soluong
    FROM don_dat_hang dh
    JOIN khach_hang kh ON kh.kh_ma = dh.kh_ma
    JOIN sanpham_dondathang spdh ON dh.dh_ma = spdh.dh_ma
    JOIN san_pham sp ON sp.sp_ma = spdh.sp_ma
    JOIN trang_thai_don_hang ttdh ON ttdh.ttdh_ma = dh.ttdh_ma
    WHERE sp.kh_ma = $kh_ma AND dh.dh_ma NOT IN (SELECT dh_ma FROM xn_donhang);";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $data = array(
                                'soluong' => $row['soluong']
                            );
                        }
                        ?>
                        <div class="tip"><?= $data['soluong'] ?></div>
                    <?php endif; ?>
                </a></li>
            <li><a href="/PassdoSv.com/giohang.php"><span class="icon_bag_alt"></span>
                    <div class="tip"><?= $numberOfProducts ?></div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="/PassdoSv.con/index.php"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) : ?>
                <a href="/PassdoSV.com/dangnhap.php">Đăng nhập</a>
                <a href="/PassdoSV.com/dangki.php">Đăng kí</a>
            <?php else : ?>
                <a href="/PassdoSV.com/dangxuat.php">Đăng xuất</a>
            <?php endif; ?>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="/PassdoSv.com/index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="/PassdoSV.com/index.php">Trang chủ</a></li>
                            <li><a href="/PassdoSV.com/gioithieu.php">Giới thiệu</a></li>
                            <li class="active"><a href="/PassdoSV.com/sanpham.php">Sản phẩm</a></li>
                            <li><a href="#">Danh mục sản phẩm</a>
                                <ul class="dropdown">
                                    <li><a href="/PassdoSV.com/danhmucsp.php?lsp_ma=1&page=1">Tài liệu học tập</a></li>
                                    <li><a href="/PassdoSV.com/danhmucsp.php?lsp_ma=2&page=1">Đồ dùng học tập</a></li>
                                    <li><a href="/PassdoSV.com/danhmucsp.php?lsp_ma=3&page=1">Đồ gia dụng cho sinh viên</a></li>
                                    <li><a href="/PassdoSV.com/danhmucsp.php?lsp_ma=4&page=1">Khác</a></li>
                                </ul>
                            </li>
                            <li><a href="/PassdoSV.com/gopy.php">Góp ý</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) : ?>
                                <a href="/PassdoSV.com/dangnhap.php">Đăng nhập</a>
                                <a href="/PassdoSV.com/dangki.php">Đăng kí</a>
                            <?php else : ?>
                                <a href="/PassdoSV.com/dangxuat.php">Đăng xuất</a>
                            <?php endif; ?>
                        </div>
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                            <li><a href="/PassdoSV.com/backend/Dashboard/dashboard.php"><span class="icon_id-2"></span>
                                    <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) : ?>
                                        <div class="tip">0</div>
                                    <?php else : ?>
                                        <div class="tip"><?= $data['soluong'] ?></div>
                                    <?php endif; ?>
                                </a></li>
                            <li><a href="/PassdoSV.com/giohang.php"><span class="icon_bag_alt"></span>
                                    <div class="tip"><?= $numberOfProducts ?></div>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/PassdoSV.com/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <form action="/PassdoSv.com/search.php" method="get">
                        <div class="shop__sidebar">
                            <div class="sidebar__categories">
                                <div class="section-title">
                                    <h4>Tìm kiếm sản phẩm</h4>
                                </div>
                                <input type="text" name="sp_ten" class="form-control" placeholder="Tìm kiếm sản phẩm">
                            </div>
                            <div class="sidebar__color">
                                <div class="section-title">
                                    <h4>Danh mục sản phẩm</h4>
                                </div>
                                <div class="size__list color__list">
                                    <label>
                                        Tài liệu học tập
                                        <?php if ($lsp_ma1 == 1) : ?>
                                            <input type="checkbox" id="lsp_ma1" name="lsp_ma1" value="1" checked>
                                            <span class="checkmark"></span>
                                        <?php else : ?>
                                            <input type="checkbox" id="lsp_ma1" name="lsp_ma1" value="1" checked>
                                            <span class="checkmark"></span>
                                        <?php endif; ?>
                                    </label>
                                    <label>
                                        Đồ dùng học tập
                                        <?php if ($lsp_ma2 == 2) : ?>
                                            <input type="checkbox" id="lsp_ma2" name="lsp_ma2" value="2" checked>
                                            <span class="checkmark"></span>
                                        <?php else : ?>
                                            <input type="checkbox" id="lsp_ma2" name="lsp_ma2" value="2">
                                            <span class="checkmark"></span>
                                        <?php endif; ?>
                                    </label>
                                    <label>
                                        Đồ gia dụng cho sinh viên
                                        <?php if ($lsp_ma3 == 3) : ?>
                                            <input type="checkbox" id="lsp_ma3" name="lsp_ma3" value="3" checked>
                                            <span class="checkmark"></span>
                                        <?php else : ?>
                                            <input type="checkbox" id="lsp_ma3" name="lsp_ma3" value="3">
                                            <span class="checkmark"></span>
                                        <?php endif; ?>
                                    </label>
                                    <label>
                                        Khác
                                        <?php if ($lsp_ma4 == 4) : ?>
                                            <input type="checkbox" id="lsp_ma4" name="lsp_ma4" value="4" checked>
                                            <span class="checkmark"></span>
                                        <?php else : ?>
                                            <input type="checkbox" id="lsp_ma4" name="lsp_ma4" value="4">
                                            <span class="checkmark"></span>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>
                            <div class="sidebar__filter">
                                <div class="section-title" style="margin-bottom: 30px;">
                                    <h4>Giá mong muốn</h4>
                                </div>
                                <div class="filter-range-wrap">
                                    <!-- <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="0" data-max="2000000"></div> -->
                                    <!-- <div class="range-slider"> -->
                                    <!-- <div class="price-input">
                                            <p>Giá:</p>
                                            <input type="text" id="minamount" name="sp_giamin">
                                            <input type="text" id="maxamount" name="sp_giamax">
                                        </div> -->
                                    <label>Giá từ:</label><br>
                                    <input type="number" name="sp_giamin" class="form-cotrol">
                                    <label>Giá đến:</label>
                                    <input type="number" name="sp_giamax" class="form-cotrol">
                                    <!-- </div> -->
                                </div>
                                <button class="btn btn-primary" style="margin-top: 10px;">Tìm kiếm</button class="btn btn-priamry">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <?php foreach ($dataLSP as $lsp) : ?>
                            <?php if ($lsp['sp_soluong'] == 0) : ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 mix tlht">
                                    <div class="product__item">
                                        <form action="/PassdoSv.com/giohang.php" method="post">
                                            <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $lsp['hsp_tentaptin'] ?>">
                                                <div class="label stockout">Đã bán hết</div>
                                                <ul class="product__hover">
                                                    <li><a href="/PassdoSV.com/assets/upload/<?= $lsp['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                    <input type="hidden" name="sp_ma" value="<?= $lsp['sp_ma'] ?>" class="sp_ma">
                                                    <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                                </ul>
                                            </div>
                                        </form>
                                        <div class="product__item__text">
                                            <h6><a href="#"><?= $lsp['sp_ten'] ?></a></h6>
                                            <div class="product__price"><?= number_format($lsp['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($lsp['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <?php if ($lsp['sp_gia'] < $lsp['sp_giacu']) : ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="product__item sale">
                                            <form action="" method="post">
                                                <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $lsp['hsp_tentaptin'] ?>">
                                                    <div class="label">Sale</div>
                                                    <ul class="product__hover">
                                                        <li><a href="/PassdoSV.com/assets/upload/<?= $lsp['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                        <input type="hidden" name="sp_ma" value="<?= $lsp['sp_ma'] ?>" class="sp_ma">
                                                        <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                                    </ul>
                                                </div>
                                            </form>
                                            <div class="product__item__text">
                                                <h6><a href="#"><?= $lsp['sp_ten'] ?></a></h6>
                                                <div class="product__price"><?= number_format($lsp['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($lsp['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="product__item">
                                            <form action="" method="post">
                                                <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $lsp['hsp_tentaptin'] ?>">
                                                    <ul class="product__hover">
                                                        <li><a href="/PassdoSV.com/assets/upload/<?= $lsp['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                        <input type="hidden" name="sp_ma" value="<?= $lsp['sp_ma'] ?>" class="sp_ma">
                                                        <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                                    </ul>
                                                </div>
                                            </form>
                                            <div class="product__item__text">
                                                <h6><a href="#"><?= $lsp['sp_ten'] ?></a></h6>
                                                <div class="product__price"><?= number_format($lsp['sp_gia'], 0, ',', '.') ?> VNĐ</div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php
                        $sqlPa = "SELECT (ROUND(COUNT(*) / 9) + 1) AS soluong_page
                            FROM san_pham
                            WHERE (lsp_ma = $lsp_ma1 || lsp_ma = $lsp_ma2 || lsp_ma = $lsp_ma3 || lsp_ma = $lsp_ma4) 
                            AND (sp_ten LIKE '%$sp_ten%')
                            AND (sp_gia BETWEEN $sp_giamin AND $sp_giamax);";
                        $resultPa = mysqli_query($conn, $sqlPa);
                        $dataPa = [];
                        while ($row = mysqli_fetch_array($resultPa, MYSQLI_ASSOC)) {
                            $dataPa = array(
                                'soluong_page' => $row['soluong_page']
                            );
                        }
                        ?>
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <?php for ($i = 1; $i <= $dataPa['soluong_page']; $i++) : ?>
                                    <a href="/PassdoSV.com/danhmucsp.php?lsp_ma=1&page=<?= $i ?>"><?= $i ?></a>
                                <?php endfor; ?>
                                <a href="#"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form" action="/PassdoSV.com/search.php">
                <input type="text" id="search-input" name="sp_ten" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
</body>
<script>
    function addSanPhamVaoGioHang(sp_ma) {
        var dulieugoi = {
            sp_ma: sp_ma,
        };

        $.ajax({
            url: '/PassdoSV.com/backend/api/giohang/themgiohang.php',
            method: "post",
            dataType: 'json',
            data: dulieugoi,
            success: function(data) {
                location.href = "/PassdoSV.com/giohang.php";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    };

    // Đăng ký sự kiện cho tất cả các nút Thêm vào giỏ hàng
    $('.btnThemVaoGioHang').click(function(event) {
        event.preventDefault();
        var sp_ma = $(this).closest('.product__item').find('.sp_ma').val();
        addSanPhamVaoGioHang(sp_ma);
    });
</script>


</html>