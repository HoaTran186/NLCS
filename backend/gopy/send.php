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
    $gy_ma = $_GET['gy_ma'];
    require("/xampp/htdocs/PassdoSV.com/assets/vendor/PHPMailer-master/src/PHPMailer.php");
    require("/xampp/htdocs/PassdoSV.com/assets/vendor/PHPMailer-master/src/Exception.php");
    require("/xampp/htdocs/PassdoSV.com/assets/vendor/PHPMailer-master/src/SMTP.php");
    $sql = "SELECT * FROM gop_y WHERE gy_ma = $gy_ma;";
    $result = mysqli_query($conn,$sql);
    $data = [];
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $data = array(
            'gy_tenkh' =>$row['gy_tenkh'],
            'gy_email' =>$row['gy_email'],
            'gy_noidung' =>$row['gy_noidung']
        );
    }
    $email = $data['gy_email'];
    $gy_tenkh = $data['gy_tenkh'];
    $gy_noidung = $data['gy_noidung'];
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
        $mail->Subject = "[Phản hồi góp ý của bạn !!]";

        // Nội dung Mail
        // Lưu ý khi thiết kế Mẫu gởi mail
        // - Chỉ nên sử dụng TABLE, TR, TD, và các định dạng cơ bản của CSS để thiết kế
        // - Các đường link/hình ảnh có sử dụng trong mẫu thiết kế MAIL phải là đường dẫn WEB có thật, ví dụ như logo,banner,...
        $body = <<<EOT
        <h2>Góp ý của bạn $gy_tenkh</h2>
        <h3>Cảm ơn bạn đã góp ý về trang web của chúng tôi</h3>
        <p>Chúng tôi đã xem xét góp ý của bạn với nội dung :$gy_noidung.</p>
    <br>
    <b style="color: red;font-size: 20px;">Cảm ơn bạn đã đóng góp ý kiến của mình để trang web phát triển hơn.</b>
EOT;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
    }
    $sql = "DELETE FROM gop_y WHERE gy_ma = $gy_ma;";
    mysqli_query($conn,$sql);
    echo '<script>location.href ="index.php";</script>';
?>
<?php } ?>