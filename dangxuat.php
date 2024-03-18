<?php
    session_start();
    unset($_SESSION['giohangdata']);
    unset($_SESSION['kh_ma']);
    unset($_SESSION['dadangnhap']);
    unset($_SESSION['kh_tendangnhap']);
    unset($_SESSION['kh_ten']);
    unset($_SESSION['kh_email']);
    unset($_SESSION['kh_quantri']);
    unset($_SESSION['kh_dienthoai']);
    echo '<script>location.href= "./dangnhap.php"</script>';
?>