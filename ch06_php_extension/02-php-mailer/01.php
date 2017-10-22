<?php

require_once 'lib/PHPMailer.php';

$mail = new \PHPMailer\PHPMailer\PHPMailer();

// Thiết lập thông tin người gửi và email người gửi
$mail->setFrom('hoanganhchoigame@gmail.com', 'Hoang Anh');

// Thiết lập thông tin người nhận và email người nhận
$mail->addAddress('hoanganhctm7@gmail.com');

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