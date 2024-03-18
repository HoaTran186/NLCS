<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PassdoSV.com/assets/vendor/font-awesome/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/PassdoSV.com/assets/vendor/bootstrap/css/bootstrap.min.css">
    <title>Đăng nhập</title>
    <?php
    // include_once __DIR__ . './layouts/styles.php';
    ?>
</head>
<?php
include_once __DIR__ . './layouts/styles.php';
?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url('/PassdoSV.com/assets/img/bg-anime-dep.jpg');
        background-size: cover;
        background-position: center;
    }

    .wrapper {
        width: 420px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }

    .wrapper h1 {
        font-size: 36px;
        text-align: center;
    }

    .wrapper .input-box {
        position: relative;
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .ivalid {
        color: red;
        border: 2px solid red;
        border-radius: 40px;
    }

    .input-box span {
        padding-top: 10px;
        font-size: 12px;
    }

    .input-box input::placeholder {
        color: #fff;
    }

    .input-box i {
        color: #fff;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .input-box #lock {
        cursor: pointer;
    }

    .wrapper .btn {
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        color: #333;
        font-weight: 300;
        cursor: pointer;
    }

    .wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        margin-top: 20px;
    }

    .register-link {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;

    }
</style>

<body>
    <?php if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == true) : ?>
        <h6>Bạn đang đăng nhập bạn có muốn <a href="./dangxuat.php">Đăng xuất</a> không?</h6>
    <?php else : ?>
        <div class="wrapper" id="wrapper">
            <form action="" method="post" name="frmDangNhap" id="frmDangNhap">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" placeholder="Tên đăng nhập">
                    <i class="fa fa-user-o"></i>
                    <span class="form-message"></span>
                </div>
                <div class="input-box">
                    <input type="password" name="kh_matkhau" id="kh_matkhau" placeholder="Mật khẩu">
                    <div id="lock">
                        <i class="fa fa-lock"></i>
                    </div>
                    <span class="form-message"></span>
                </div>
                <button class="btn" name="btnDangNhap" type="submit">Đăng nhập</button>
                <div class="register-link">
                    <p>Thành viên mới?<a href="./dangki.php"> Đăng kí</a> tại đây</p>
                </div>
            </form>
            <!-- <div role="alert"></div> -->
            <?php
            include_once __DIR__ . './layouts/scripts.php';
            ?>
            <?php
            if (isset($_POST['btnDangNhap'])) {
                $kh_tendangnhap = $_POST['kh_tendangnhap'];
                $kh_matkhau = sha1($_POST['kh_matkhau']);
                include_once __DIR__ . '/dbconnect.php';
                $sqlDN = "SELECT * FROM khach_hang  WHERE kh_tendangnhap = '$kh_tendangnhap' 
                                                AND kh_matkhau = '$kh_matkhau';";
                $resultDN = mysqli_query($conn, $sqlDN);

                $dataKH = [];
                while($row = mysqli_fetch_array($resultDN,MYSQLI_ASSOC)){
                    $dataKH = array(
                        'kh_ma' =>$row['kh_ma'],
                        'kh_tendangnhap' =>$row['kh_tendanhap'],
                        'kh_ten' => $row['kh_ten'],
                        'kh_email' =>$row['kh_email'],
                        'kh_dienthoai' =>$row['kh_dienthoai'],
                        'kh_quantri' =>$row['kh_quantri']
                    );
                }
                // $dataKH = mysqli_fetch_array($resultDN, MYSQLI_ASSOC);
                if (!empty($dataKH)) {
                    $_SESSION['dadangnhap'] = true;
                    $_SESSION['kh_ma'] = $dataKH['kh_ma'];
                    $_SESSION['kh_tendangnhap'] = $kh_tendangnhap;
                    $_SESSION['kh_ten'] = $dataKH['kh_ten'];
                    $_SESSION['kh_email'] =$dataKH['kh_email'];
                    $_SESSION['kh_dienthoai'] =$dataKH['kh_dienthoai'];
                    $_SESSION['kh_quantri'] = $dataKH['kh_quantri'];
                    $_SESSION['giohangdata'] = [];
                    // $_SESSION['sp_ma'] = $dataKH['sp_ma'];
                    echo 'Bạn đã đăng nhập thành công!';
                    if ($_SESSION['kh_quantri'] == true) {
                        echo '<script>location.href = "/PassdoSV.com/backend/Dashboard/dashboard.php"</script>';
                    } else {
                        echo '<script>location.href = "./index.php"</script>';
                    }
                } else {
                }
            ?>
                <div class="alert alert-danger" role="alert">
                    Tài khoản hoặc mật khẩu không đúng?
                </div>
            <?php } ?>
        </div>
    <?php endif; ?>
</body>
<script src="/PassdoSV.com/assets/vendor/jquery-validation/dist/jquery.validate.min.js" ></script>
<script src="/PassdoSV.com/assets/vendor/bootstrap/js/bootstrap.min.js" ></script>
<script src="/PassdoSV.com/assets/vendor/jquery/jquery.min.js" ></script>
<script>
    $(document).ready(function() {
        $('#lock').click(function() {
            $(this).toggleClass('open');
            $(this).children('i').toggleClass('fa-unlock-alt fa-lock');
            if ($(this).hasClass('open')) {
                $(this).prev().attr('type', 'text');
            } else {
                $(this).prev().attr('type', 'password');
            }
        });
    });
    Validator({
        form: '#frmDangNhap',
        rules: [
            Validator.isRequired('#kh_tendangnhap', 'Vui lòng nhập tên tài khoản!'),
            Validator.isRequired('#kh_matkhau', 'Vui lòng nhập mật khẩu!')
        ]
    });
</script>

</html>