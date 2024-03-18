<?php
if (session_id() === '') {
    session_start();
}
?>
<?php
if (isset($_SESSION['dadangnhap']) && $_SESSION['dadangnhap'] == false || !isset($_SESSION['dadangnhap'])) {
    echo '<script>location.href="../../dangnhap.php";</script>';
} elseif (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false) {
    echo 'Bạn không có quyền sử dụng chức năng này!';
    echo '<a href="../../index.php">Quay lại trang chủ</a>';
} else {
?>
<?php
    include_once __DIR__ . '/../../dbconnect.php';
    $xn_ma = $_GET['xn_ma'];
    $sqlISSP = "INSERT INTO san_pham(sp_ten, sp_giacu, sp_gia, sp_soluong, sp_mota, sp_ngaycapnhat,sp_ngayxacnhan,hsp_tentaptin, lsp_ma, lh_ma, httt_ma,kh_ma)
    SELECT sp_ten, sp_giacu, sp_gia, sp_soluong, sp_mota, sp_ngaycapnhat,NOW(),hsp_tentaptin, lsp_ma, lh_ma, httt_ma,kh_ma
    FROM xac_nhan_ban_sp
    WHERE xn_ma = $xn_ma;";
    mysqli_query($conn, $sqlISSP);

    $sqlSLXN = "SELECT * FROM xac_nhan_ban_sp WHERE xn_ma = $xn_ma;";
    $resultSLXN = mysqli_query($conn, $sqlSLXN);
    $dataXN = [];
    while ($row = mysqli_fetch_array($resultSLXN, MYSQLI_ASSOC)) {
        $dataXN = array(
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
            'httt_ma' => $row['httt_ma'],
            'kh_ma' => $row['kh_ma']
        );
    }
    require("/xampp/htdocs/PassdoSV.com/assets/vendor/PHPMailer-master/src/PHPMailer.php");
    require("/xampp/htdocs/PassdoSV.com/assets/vendor/PHPMailer-master/src/Exception.php");
    require("/xampp/htdocs/PassdoSV.com/assets/vendor/PHPMailer-master/src/SMTP.php");
    $kh_ma = $dataXN['kh_ma'];
    $sqlKH = "SELECT * FROM khach_hang WHERE kh_ma = $kh_ma";
    $resultDLKH = mysqli_query($conn, $sqlKH);
    $dataKH = [];
    while ($row = mysqli_fetch_array($resultDLKH, MYSQLI_ASSOC)) {
        $dataKH = array(
            'kh_ma' => $row['kh_ma'],
            'kh_ten' => $row['kh_ten'],
            'kh_diachi' => $row['kh_diachi'],
            'kh_email' => $row['kh_email']
        );
    }
    $kh_ten = $dataKH['kh_ten'];
    $email = $dataKH['kh_email'];
    $sp_ten = $dataXN['sp_ten'];
    $sp_gia = $dataXN['sp_gia'];
    $sp_soluong = $dataXN['sp_soluong'];
    $sp_ngaycapnhat = $dataXN['sp_ngaycapnhat'];
    $hsp_tentaptin = $dataXN['hsp_tentaptin'];
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                   // Enable verbose debug output
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = 'passdosv@gmail.com'; // SMTP username
        $mail->Password = 'ckkn rwzp evoa uumy';                   // SMTP password
        $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                      // TCP port to connect to
        $mail->CharSet = "UTF-8";
        // Bật chế bộ tự mình mã hóa SSL
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom('passdosv@gmail.com', 'PassdoSV.com');
        $mail->addAddress("$email");               // Add a recipient
        $mail->addReplyTo($email);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name

        //Content
        $mail->isHTML(true);                                    // Set email format to HTML

        // Tiêu đề Mail
        $mail->Subject = "[Thông báo !!]";

        // Nội dung Mail
        // Lưu ý khi thiết kế Mẫu gởi mail
        // - Chỉ nên sử dụng TABLE, TR, TD, và các định dạng cơ bản của CSS để thiết kế
        // - Các đường link/hình ảnh có sử dụng trong mẫu thiết kế MAIL phải là đường dẫn WEB có thật, ví dụ như logo,banner,...
        $body = <<<EOT
        <b>Đơn hàng của bàn $kh_ten</b>
        <table border=1>
        <thead>
            <tr>
                <td>Sản phẩm tên</td>
                <td>Sản phẩm giá</td>
                <td>Số lượng</td>
                <td>Ngày cập nhật</td>
                <td>Hình sản phẩm</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>$sp_ten</td>
                <td>$sp_gia</td>
                <td>$sp_soluong</td>
                <td>$sp_ngaycapnhat</td>
                <td>$hsp_tentaptin</td>
            </tr>
        </tbody>
    </table>
    <br>
    <b style="color: red;font-size: 30px;">Đã được xác nhận.</b>
EOT;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
    }
    $uploadDirOld = __DIR__ . '/../../assets/wait/';
    $uploadDir = __DIR__ . '/../../assets/upload/';
    copy($uploadDirOld . $dataXN['hsp_tentaptin'], $uploadDir . $dataXN['hsp_tentaptin']);
    unlink($uploadDirOld . $dataXN['hsp_tentaptin']);
    $sqlDLXN = "DELETE FROM xac_nhan_ban_sp WHERE xn_ma=$xn_ma;";
    mysqli_query($conn, $sqlDLXN);
    echo '<script>location.href ="xacnhan.php";</script>';
?>
<?php } ?>