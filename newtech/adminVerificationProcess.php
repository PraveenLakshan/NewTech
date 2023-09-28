<?php


session_start();
require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){

    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` ='".$email."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num > 0){

        $code = uniqid();
        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email` ='".$email."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eshop045@gmail.com';
        $mail->Password = 'ktichwbtgqzpnfbu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('eshop045@gmail.com', 'Admin Verification');
        $mail->addReplyTo('eshop045@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'E-Shop Admin Verification Code';
        $bodyContent = '<h1 style="color:blue">Your Verification Code Is ' . $code . '<h1/>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification Code Sending Failed';
        } else {
            echo 'Success';
        }

    }else{
        echo("YounAre Not A Valid User");

    }


}else{
    echo("Email Field Should Not Be Empty");
}




?>