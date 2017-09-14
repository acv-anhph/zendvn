<?php
$to = 'hoanganhctm7@gmail.com';
$subject = 'email test';
$message = 'this is a test';
$header = 'From: hoanganhchoigame@gmail.com';

if (mail($to, $subject, $message, $header) == true) {
	echo 'success';
} else {
	echo 'fail';
}
