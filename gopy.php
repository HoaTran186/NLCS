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
    <title>Góp ý</title>

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
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/PassdoSV.com/assets/vendor/sweetalert2/sweetalert2.min.css">
    <script src="/PassdoSV.com/assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
</head>
<?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    echo '<script>location.href="/PassdoSV.com/dangnhap.php";</script>';
} else { ?>
    <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    } else {
        if (empty($_SESSION['giohangdata'])) {
            $numberOfProducts = 0;
        } else {
            $numberOfProducts = count($_SESSION['giohangdata']);
        }
    } ?>

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
                            include_once __DIR__.'/dbconnect.php';
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
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <nav class="header__menu">
                            <ul>
                                <li><a href="/PassdoSV.com/index.php">Trang chủ</a></li>
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
                                <li class="active"><a href="/PassdoSV.com/gopy.php">Góp ý</a></li>
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

        <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <a href="/PassdoSV.com/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                            <span>Góp ý</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Contact Section Begin -->
        <section class="contact spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="contact__content">
                            <div class="contact__address">
                                <h5>Thông tin liên hệ</h5>
                                <ul>
                                    <li>
                                        <h6><i class="fa fa-map-marker"></i> Địa chỉ</h6>
                                        <p>Khu II, Đ. 3 Tháng 2, Xuân Khánh, Ninh Kiều, Cần Thơ</p>
                                    </li>
                                    <li>
                                        <h6><i class="fa fa-phone"></i> Phone</h6>
                                        <p><span>123-456-789</span><span>910-111-121</span></p>
                                    </li>
                                    <li>
                                        <h6><i class="fa fa-headphones"></i> Hỗ trợ</h6>
                                        <p>passdosv@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact__form">
                                <h5>Gởi góp ý</h5>
                                <form action="" method="post">
                                    <input type="text" name="gy_tenkh" value="<?= $_SESSION['kh_ten'] ?>">
                                    <input type="text" value="<?= $_SESSION['kh_email'] ?>" name="gy_email">
                                    <textarea placeholder="Nội dung" name="gy_noidung"></textarea>
                                    <button name="btnSend" class="site-btn">Gửi góp ý</button>
                                </form>
                                <?php
                                include_once __DIR__ . '/dbconnect.php';
                                if (isset($_POST['btnSend'])) {
                                    $gy_tenkh = $_POST['gy_tenkh'];
                                    $gy_email = $_POST['gy_email'];
                                    $gy_noidung = $_POST['gy_noidung'];
                                    if (!empty($gy_noidung)) {
                                        $sqlIS = "INSERT INTO gop_y
                                        (gy_tenkh, gy_email, gy_noidung)
                                        VALUES ('$gy_tenkh', '$gy_email', '$gy_noidung');";
                                        mysqli_query($conn, $sqlIS);
                                        echo '<script>
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "Góp ý của bạn đã được gửi",
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    </script>';
                                    } else {
                                        echo '<script>
                                        Swal.fire({
                                      icon: "error",
                                      title: "Lỗi...",
                                      text: "Không có nội dung góp ý !!!",
                                    });
                                    </script>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="contact__map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7857.683183030243!2d105.77392889794594!3d10.029927664869337!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1699910468298!5m2!1svi!2s" height="750" style="border:0" allowfullscreen=""></iframe>
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
        <!-- Search End -->

        <!-- Js Plugins -->
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
<?php } ?>

</html>