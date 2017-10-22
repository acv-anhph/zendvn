<?php
require_once 'lib/PHPMailer.php';
require_once 'lib/SMTP.php';
require_once 'lib/Exception.php';
require_once 'lib/OAuth.php';
require_once 'lib/POP3.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

// Gọi đến lớp SMTP
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'hoanganhctm7@gmail.com';
$mail->Password = 'dcmyou123';
$mail->SMTPSecure = 'tls';



// Thiết lập thông tin người gửi và email người gửi
$mail->setFrom('hoanganhctm7@gmail.com', 'Hoang Anh');

// Thiết lập thông tin người nhận và email người nhận
$mail->addAddress('hoanganh3111989@gmail.com');

// Thiết lập tiêu đề
$mail->Subject = "PHP Mailer";

// Thiết lập charset
$mail->CharSet = 'utf-8';

// Thiết lập nội dung
$mail->Body = "Khóa học lập trình web với PHP - ZendVN";

if ($mail->Send() == false) {
    echo 'Error: ' . $mail->ErrorInfo;
} else {
    echo 'Success';
}