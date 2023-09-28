<?php

session_start();

require "connection.php";

if (isset($_SESSION["p"])) {

    $pid = $_SESSION["p"]["pid"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["d"];

    Database::iud("UPDATE `product` SET `title` = '".$title."', `qtyl` = '".$qty."', `delivery_fee_colombo` = '".$dwc."',
    `delivery_fee_other` = '".$doc."', `description` = '".$description."' WHERE `id` = '".$pid."'  ");

    echo("Product Has Been Updated! ");


    $length = sizeof($_FILES);

    $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml",);

    if ($length <= 3 && $length > 0) {
        $allowed_img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml",);

        
        Database::iud("DELETE FROM `images` WHERE `product_id` = '".$pid."' ");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["i" . $x])) {
                $img_file = $_FILES["i" . $x];
                $file_type = $img_file["type"];

                if (in_array($file_extention, $allowed_img_extensions)) {
                    $new_img_extention;

                    if ( $file_type  == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ( $file_type  == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ( $file_type  == "image/png") {
                        $new_img_extention = ".png";
                    } else if ( $file_type  == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//mobile_images//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);


                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $file_name . "','" . $pid . "') ");


                } else {
                    echo ("File Type Not Allowed");
                }
            }
        }
        echo ("Product Image Saved Succesfully");
    } else {
        echo ("Invalid Image Count");
    }

}
