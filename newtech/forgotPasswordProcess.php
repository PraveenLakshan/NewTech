<?php

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;




//echo($email);

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eshop045@gmail.com';
        $mail->Password = 'ktichwbtgqzpnfbu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('eshop045@gmail.com', 'Reset Password');
        $mail->addReplyTo('eshop045@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'E-Shop Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:green">Your Verification Code Is ' . $code . '<h1/>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification Code Sending Failed';
        } else {
            echo 'Success';
        }
    } else {
        echo ("Invalid Email Address");
    }
}
