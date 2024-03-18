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
                        include_once __DIR__ . '/dbconnect.php';
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
                            <li class="active"><a href="/PassdoSV.com/gioithieu.php">Giới thiệu</a></li>
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

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/PassdoSV.com/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Giới thiệu</span>
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
                            <h5>Giới thiệu PassdoSV.com</h5>
                            <ul>
                                <li>
                                    <p><b>Chào mừng bạn đến với "<a href="/PassdoSV.com/index.php">PassdoSV.com</a>" - Nơi Tương Tác và Tiết Kiệm Độc Đáo!</b></p>
                                </li>
                                <li>
                                    <p>Bạn là sinh viên và muốn tìm kiếm những cơ hội tiết kiệm không chỉ về ngân sách mà còn về tinh thần xanh? Hãy đến với chúng tôi, nơi mà sự sáng tạo gặp gỡ với tiết kiệm, và cộng đồng của bạn trở nên sống động hơn bao giờ hết.</p>
                                </li>
                                <li>
                                    <p>Bạn có thể đăng bán các sản phẩm mà bạn không sử dụng nửa nhưng vẫn còn tốt bạn hãy đến với chúng tôi. Chúng tôi sẽ giúp bạn giải quyết vấn đề đó bạn có thể đăng bán các sản phẩm như tài liệu học tập, các dụng cụ học tập ,...</p>
                                </li>
                                <li>
                                    <p>Bạn đang tìm kiếm tài liệu từ những người bạn nơi đây chúng tôi sẽ giúp bạn tìm kiếm điều này chỉ với một cái click chuột bạn sẽ có tài liệu hay một cái gì đó mà bạn cần thiết.</p>
                                </li>
                                <li>
                                    <p><h6>Tham Gia Ngay Để:</h6></p>
                                        <ul>
                                            <li>Khám phá những sản phẩm độc đáo mà bạn không thể tìm thấy ở bất kỳ nơi nào khác.</li>
                                            <li>Kết nối với cộng đồng sinh viên đầy năng lượng.</li>
                                            <li>Tiết kiệm tiền và đồng thời chăm sóc môi trường.</li>
                                            <li><p>Hãy đến với chúng tôi tại <a href="/PassdoSV.com/index.php">PassdoSV.com</a> và trải nghiệm sự sáng tạo và tiết kiệm một cách hoàn toàn mới! "<a href="/PassdoSV.com/index.php">PassdoSV.com</a>" - Nơi thay đổi cách bạn mua sắm!</p></li>
                                        </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <img src="/PassdoSV.com/img/img.jpg" alt="">
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

</html>