<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>

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
<style>
    .wrapper {
        width: 400px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        /* color: #fff; */
        border-radius: 10px;
        padding: 30px 40px;
    }

    .wrapper-dmsp {
        width: 300px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        /* color: #fff; */
        border-radius: 10px;
        padding: 30px 40px;
    }
</style>
<?php
include_once __DIR__ . '/dbconnect.php';
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
            <li><a href="/PassdoSV.com/giohang.php"><span class="icon_bag_alt"></span>
                    <?php
                    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) : ?>
                        <div class="tip">0</div>
                    <?php else : ?>
                        <div class="tip"><?= $numberOfProducts ?></div>
                    <?php endif; ?>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="/PassdoSv.com/index.php"><img src="img/logo.png" alt=""></a>
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
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="/PassdoSV.com/index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/PassdoSV.com/index.php">Trang chủ</a></li>
                            <li><a href="/PassdoSV.com/gioithieu.php">Giới thiệu</a></li>
                            <li><a href="/PassdoSV.com/sanpham.php">Sản phẩm</a></li>
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
                                    <?php
                                    if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) : ?>
                                        <div class="tip">0</div>
                                    <?php else : ?>
                                        <div class="tip"><?= $numberOfProducts ?></div>
                                    <?php endif; ?>
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
    <?php
    $sqlHT = "SELECT COUNT(*) as tlht FROM san_pham WHERE lsp_ma = 1;";
    $resultHT = mysqli_query($conn, $sqlHT);
    $dataHT = [];
    while ($row = mysqli_fetch_array($resultHT, MYSQLI_ASSOC)) {
        $dataHT = array(
            'tlht' => $row['tlht']
        );
    }
    if (empty($dataHT)) {
        $dataHT = 0;
    }
    $sqlDD = "SELECT COUNT(*) as ddht FROM san_pham WHERE lsp_ma = 2;";
    $resultDD = mysqli_query($conn, $sqlDD);
    $dataDD = [];
    while ($row = mysqli_fetch_array($resultDD, MYSQLI_ASSOC)) {
        $dataDD = array(
            'ddht' => $row['ddht']
        );
    }
    if (empty($dataDD)) {
        $dataDD = 0;
    }
    $sqlGD = "SELECT COUNT(*) as dgd FROM san_pham WHERE lsp_ma = 3;";
    $resultGD = mysqli_query($conn, $sqlGD);
    $dataGD = [];
    while ($row = mysqli_fetch_array($resultGD, MYSQLI_ASSOC)) {
        $dataGD = array(
            'dgd' => $row['dgd']
        );
    }
    if (empty($dataGD)) {
        $dataGD = 0;
    }
    $sqlK = "SELECT COUNT(*) as k FROM san_pham WHERE lsp_ma = 4;";
    $resultK = mysqli_query($conn, $sqlK);
    $dataK = [];
    while ($row = mysqli_fetch_array($resultK, MYSQLI_ASSOC)) {
        $dataK = array(
            'k' => $row['k']
        );
    }
    if (empty($dataK)) {
        $dataK = 0;
    }
    ?>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg" data-setbg="img/categories/category-1.jpg">
                        <div class="categories__text wrapper">
                            <h1>PassdoSV.com</h1>
                            <p>Mua mọi lúc bán mọi nơi hộ trợ sinh viên Đại học Cần Thơ.</p>
                            <a href="/PassdoSV.com/danhmucsp.php?lsp_ma=<?= $sp1['lsp_ma'] ?>">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-2.jpg">
                                <div class="categories__text wrapper-dmsp">
                                    <h4>Tài liệu học tập</h4>
                                    <p><?= $dataHT['tlht'] ?> sản phẩm</p>
                                    <a href="/PassdoSV.com/danhmucsp.php?lsp_ma=1&page=1">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-3.jpg">
                                <div class="categories__text wrapper-dmsp">
                                    <h4>Đồ dùng học tập</h4>
                                    <p><?= $dataDD['ddht'] ?> sản phẩm</p>
                                    <a href="/PassdoSV.com/danhmucsp.php?lsp_ma=2&page=1">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-4.jpg">
                                <div class="categories__text wrapper-dmsp">
                                    <h4>Đồ gia dụng cho sinh viên</h4>
                                    <p><?= $dataGD['dgd'] ?> sản phẩm</p>
                                    <a href="/PassdoSV.com/danhmucsp.php?lsp_ma=3&page=1">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-5.jpg">
                                <div class="categories__text wrapper-dmsp">
                                    <h4>Khác</h4>
                                    <p><?= $dataK['k'] ?> sản phẩm</p>
                                    <a href="/PassdoSV.com/danhmucsp.php?lsp_ma=4&page=1">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
    <?php
    $sqlSP1 = "SELECT * FROM san_pham
    ORDER BY sp_ngaycapnhat DESC
    LIMIT 8;";
    $resultSP1 = mysqli_query($conn, $sqlSP1);
    $dataSP1 = [];
    while ($row = mysqli_fetch_array($resultSP1, MYSQLI_ASSOC)) {
        $dataSP1[] = array(
            'sp_soluong' => $row['sp_soluong'],
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'sp_giacu' => $row['sp_giacu'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
            'lsp_ma' => $row['lsp_ma']
        );
    }
    ?>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Sản phẩm mới</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Tất cả</li>
                        <li data-filter=".tlht">Tài liệu học tập</li>
                        <li data-filter=".ddht">Đồ dùng học tập</li>
                        <li data-filter=".dgdsv">Đồ gia dụng cho sinh viên</li>
                        <li data-filter=".khac">Khác</li>
                    </ul>
                </div>
            </div>
            <div class="row property__gallery">
                <?php foreach ($dataSP1 as $sp1) : ?>
                    <?php if ($sp1['sp_soluong'] == 0) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix tlht">
                            <div class="product__item">
                                <form action="/PassdoSv.com/giohang.php" method="post">
                                    <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>">
                                        <div class="label stockout">Đã bán hết</div>
                                        <ul class="product__hover">
                                            <li><a href="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <input type="hidden" name="sp_ma" value="<?= $sp1['sp_ma'] ?>" class="sp_ma">
                                            <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                        </ul>
                                    </div>
                                </form>
                                <div class="product__item__text">
                                    <h6><a href="#"><?= $sp1['sp_ten'] ?></a></h6>
                                    <div class="product__price"><?= number_format($sp1['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($sp1['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if ($sp1['lsp_ma'] == 1) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix tlht">
                                <div class="product__item">
                                    <form action="/PassdoSv.com/giohang.php" method="post">
                                        <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>">
                                            <div class="label new">Mới</div>
                                            <ul class="product__hover">
                                                <li><a href="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                <input type="hidden" name="sp_ma" value="<?= $sp1['sp_ma'] ?>" class="sp_ma">
                                                <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?= $sp1['sp_ten'] ?></a></h6>
                                        <div class="product__price"><?= number_format($sp1['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($sp1['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($sp1['lsp_ma'] == 2) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix ddht">
                                <div class="product__item">
                                    <form action="" method="post">
                                        <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>">
                                            <div class="label new">Mới</div>
                                            <ul class="product__hover">
                                                <li><a href="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                <input type="hidden" name="sp_ma" value="<?= $sp1['sp_ma'] ?>" class="sp_ma">
                                                <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?= $sp1['sp_ten'] ?></a></h6>
                                        <div class="product__price"><?= number_format($sp1['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($sp1['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($sp1['lsp_ma'] == 3) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix dgdsv">
                                <div class="product__item">
                                    <form action="/PassdoSv.com/giohang.php" method="post">
                                        <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>">
                                            <div class="label new">Mới</div>
                                            <ul class="product__hover">
                                                <li><a href="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                <input type="hidden" name="sp_ma" value="<?= $sp1['sp_ma'] ?>" class="sp_ma">
                                                <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?= $sp1['sp_ten'] ?></a></h6>
                                        <div class="product__price"><?= number_format($sp1['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($sp1['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($sp1['lsp_ma'] == 4) : ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix khac">
                                <div class="product__item">
                                    <form action="/PassdoSv.com/giohang.php" method="post">
                                        <div class="product__item__pic set-bg" data-setbg="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>">
                                            <div class="label new">Mới</div>
                                            <ul class="product__hover">
                                                <li><a href="/PassdoSV.com/assets/upload/<?= $sp1['hsp_tentaptin'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                                <input type="hidden" name="sp_ma" value="<?= $sp1['sp_ma'] ?>" class="sp_ma">
                                                <li><a class="btnThemVaoGioHang"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                    </form>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?= $sp1['sp_ten'] ?></a></h6>
                                        <div class="product__price"><?= number_format($sp1['sp_gia'], 0, ',', '.') ?> VNĐ<span><?= number_format($sp1['sp_giacu'], 0, ',', '.') ?> VNĐ</span></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    $sqlM = "SELECT * 
    FROM san_pham
    ORDER BY sp_ngayxacnhan ASC
    LIMIT 10;";
    $resultM = mysqli_query($conn, $sqlM);
    $dataM = [];
    while ($row = mysqli_fetch_array($resultM, MYSQLI_ASSOC)) {
        $dataM[] =  array(
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
            'hsp_tentaptin' => $row['hsp_tentaptin'],
        );
    }
    ?>
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Sản phẩm mới</h4>
                        </div>
                        <?php foreach ($dataM as $sp) : ?>
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="/PassdoSV.com/assets/upload/<?= $sp['hsp_tentaptin'] ?>" style="width: 50px; height: 50px;">
                                </div>
                                <div class="trend__item__text">
                                    <h6><?= $sp['sp_ten'] ?></h6>
                                    <div class="product__price"><?= $sp['sp_gia'] ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                $sqlO = "SELECT * FROM san_pham LIMIT 10;";
                $resultO = mysqli_query($conn, $sqlO);
                $dataO = [];
                while ($row = mysqli_fetch_array($resultO, MYSQLI_ASSOC)) {
                    $dataO[] = array(
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => $row['sp_gia'],
                        'hsp_tentaptin' => $row['hsp_tentaptin'],
                    );
                }
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Sản phẩm</h4>
                        </div>
                        <div class="trend__item">
                            <?php foreach ($dataO as $spo) : ?>
                                <div class="trend__item">
                                    <div class="trend__item__pic">
                                        <img src="/PassdoSV.com/assets/upload/<?= $spo['hsp_tentaptin'] ?>" style="width: 50px; height: 50px;">
                                    </div>
                                    <div class="trend__item__text">
                                        <h6><?= $spo['sp_ten'] ?></h6>
                                        <div class="product__price"><?= $spo['sp_gia'] ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
                $sqlH = "SELECT * FROM san_pham
                    WHERE sp_soluong = 0
                    LIMIT 10;";
                $resultH = mysqli_query($conn, $sqlH);
                $dataH = [];
                while ($row = mysqli_fetch_array($resultH, MYSQLI_ASSOC)) {
                    $dataH[] = array(
                        'sp_ten' => $row['sp_ten'],
                        'sp_gia' => $row['sp_gia'],
                        'hsp_tentaptin' => $row['hsp_tentaptin'],
                    );
                }
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Sản phẩm đã hết</h4>
                        </div>
                        <div class="trend__item">
                            <?php foreach ($dataH as $sph) : ?>
                                <div class="trend__item">
                                    <div class="trend__item__pic">
                                        <img src="/PassdoSV.com/assets/upload/<?= $sph['hsp_tentaptin'] ?>" style="width: 50px; height: 50px;">
                                    </div>
                                    <div class="trend__item__text">
                                        <h6><?= $sph['sp_ten'] ?></h6>
                                        <div class="product__price"><?= $sph['sp_gia'] ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Chào mừng bạn đã đến với</span>
                                <h1>PassdoSV.com</h1>
                                <a href="#">Mua ngay</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Chào mừng bạn đã đến với</span>
                                <h1>PassdoSV.com</h1>
                                <a href="#">Mua ngay</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Chào mừng bạn đã đến với</span>
                                <h1>PassdoSV.com</h1>
                                <a href="#">Mua ngay</a>
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