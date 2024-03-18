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
    <title>Ashion | Template</title>

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
if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    echo '<script>location.href="/PassdoSV.com/dangnhap.php";</script>';
} else {
?>
    <?php
    include_once(__DIR__ . '/dbconnect.php');

    // Kiểm tra dữ liệu trong session
    $giohangdata = [];
    if (isset($_SESSION['giohangdata'])) {
        $giohangdata = $_SESSION['giohangdata'];
    } else {
        $giohangdata = [];
    }
    ?>
    <?php
    if (empty($_SESSION['giohangdata'])) {
        $numberOfProducts = 0;
    } else {
        $numberOfProducts = count($_SESSION['giohangdata']);
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
                        <div class="tip"><?= $numberOfProducts ?></div>
                    </a></li>
            </ul>
            <div class="offcanvas__logo">
                <a href="./index.html"><img src="img/logo.png" alt=""></a>
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
                                <li><a href="#"><span class="icon_bag_alt"></span>
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
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Shop Cart Section Begin -->
        <section class="shop-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__cart__table">
                            <?php if (!empty($giohangdata)) : ?>
                                <table id="tblGioHang">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng giá</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;
                                        $hd = 0;
                                        foreach ($giohangdata as $sp) :
                                            $hd = $hd + $sp['thanhtien'];
                                            $i = $i + 1; ?>
                                            <tr>
                                                <td style="padding: 40px;"><?= $i ?></td>
                                                <td class="cart__product__item">
                                                    <img src="/PassdoSV.com/assets/upload/<?= $sp['hsp_tentaptin'] ?>" alt="" style="width: 80px;">
                                                    <div class="cart__product__item__title">
                                                        <h6><?= $sp['sp_ten'] ?></h6>
                                                        <!-- <div class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div> -->
                                                    </div>
                                                </td>
                                                <td class="cart__price"><?= number_format($sp['sp_gia'], 0, ',', '.') ?></td>
                                                <td class="cart__quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" id="sp_dh_soluong_<?= $sp['sp_ma'] ?>" name="sp_dh_soluong" value="<?= $sp['sp_dh_soluong'] ?>">
                                                    </div>
                                                    <button class="btn-no-border btn-capnhat-soluong" data-sp-ma="<?= $sp['sp_ma'] ?>" style="height: 20px; width: 100px;font-size: 10px;"><span class="icon_loading"></span> Cập nhật</button>
                                                </td>
                                                <td class="cart__total"><?= number_format($sp['thanhtien'], 0, ',', '.') ?></td>
                                                <td id="delete_<?= $i ?>" class="cart__close btn-delete-sanpham" data-sp-ma="<?= $sp['sp_ma'] ?>"><span class="icon_close"></span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <h2>Giỏ hàng rỗng!!!</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn">
                            <a href="/PassdoSV.com/sanpham.php">Tiếp tục mua</a>
                        </div>
                    </div>
                </div>
                <?php if (!empty($giohangdata)) : ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cart__total__procced">
                                <h6>Đơn đặt hàng</h6>
                                <?php
                                if (isset($_SESSION['giohangdata'])) {
                                    // Lấy mảng 'giohangdata' từ biến session
                                    $giohangdata = $_SESSION['giohangdata'];

                                    // Lấy từng phần tử của mảng
                                    // foreach ($giohangdata as $key => $value) {
                                    //     echo  $key;
                                    //     echo $value['sp_ten'];
                                }
                                ?>
                                <form action="/PassdoSV.com/backend/giohang/dathang.php" method="post">
                                    <?php foreach ($giohangdata as $key => $value) : ?>
                                        <input type="hidden" name="sp_ma[]" value="<?= $key ?>">
                                        <input type="hidden" name="sp_dh_soluong[]" value="<?= $value['sp_dh_soluong'] ?>">
                                        <input type="hidden" name="kh_ma[]" value="<?= $value['kh_ma'] ?>">
                                        <input type="hidden" name="sp_dh_dongia[]" value="<?= $value['thanhtien'] ?>">
                                    <?php endforeach; ?>
                                    <ul>
                                        <li>Tên khách hàng <span><?= $_SESSION['kh_ten'] ?></span></li>
                                        <li>Email <span><?= $_SESSION['kh_email'] ?></span></li>
                                        <li>Địa chỉ <span><input type="text" name="kh_diachi" class="form-control" style="border: none;"></span></li>
                                        <li>Số điện thoại <span><?= $_SESSION['kh_dienthoai'] ?></span></li>
                                        <li>Tổng <span><?= $hd ?></span></li>
                                    </ul>
                                    <button class="btn-no-border  primary-btn" name="btnDatHang">Đặt hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search End -->

        <!-- Js Plugins -->
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
<?php } ?>
<script>
    $(document).ready(function() {
        function removeSanPhamVaoGioHang(id) {
            // Dữ liệu gởi
            var dulieugoi = {
                sp_ma: id
            };

            // AJAX đến API xóa sản phẩm khỏi Giỏ hàng trong Session
            $.ajax({
                url: '/PassdoSV.com/backend/api/giohang/xoaspgiohang.php',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    // Refresh lại trang
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        };
        $('#tblGioHang').on('click', '.btn-delete-sanpham', function(event) {
            // debugger;
            event.preventDefault();
            var id = $(this).data('sp-ma');

            console.log(id);
            removeSanPhamVaoGioHang(id);
        });

        function capnhatSanPhamTrongGioHang(id, sp_dh_soluong) {
            // Dữ liệu gởi
            var dulieugoi = {
                sp_ma: id,
                sp_dh_soluong: sp_dh_soluong
            };

            $.ajax({
                url: '/PassdoSV.com/backend/api/giohang/suaslgiohang.php',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    // Refresh lại trang
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        };
        $('#tblGioHang').on('click', '.btn-capnhat-soluong', function(event) {
            // debugger;
            event.preventDefault();
            var id = $(this).data('sp-ma');
            var soluongmoi = $('#sp_dh_soluong_' + id).val();
            capnhatSanPhamTrongGioHang(id, soluongmoi);
        });
    });
</script>

</html>