<?php
session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["col"];
$clr_input = $_POST["col_in"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
//$image = $_POST[""];

if ($category == "0") {
    echo ("Plsease Select A Category");
} else if ($brand == "0") {
    echo ("Plsease Select A Brand");
} else if ($model == "0") {
    echo ("Plsease Select A Model");
} else if (empty($title)) {
    echo ("Please Enter A Title");
} else if (strlen($title) >= 100) {
    echo ("Title Should Have Lover Than 100 Characters");
} else if ($clr == "0") {
    echo ("Plsease Select A Color");
} else if (empty($qty)) {
    echo ("Please Enter The Quantity");
} else if ($qty == "0" | $qty == "e" | $qty < 0) {
    echo ("Invalid Input For Quantity");
} else if (empty($cost)) {
    echo ("Please Enter The Price");
} else if (!is_numeric($cost)) {
    echo ("Invalid Input For The Cost");
} else if (empty($dwc)) {
    echo ("Please Enter The Delivey Fee For Colombo");
} else if (!is_numeric($dwc)) {
    echo ("Invalid Input For The Delivey Cost Inside Colombo");
} else if (empty($doc)) {
    echo ("Please Enter The Delivey Fee For Out Of Colombo");
} else if (!is_numeric($doc)) {
    echo ("Invalid Input For The Delivey Cost Outside Colombo");
} else if (empty($desc)) {
    echo ("Please Enter A Description");
} else {
    $bhm_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id` = '" . $brand . "' AND `model_id` = '" . $model . "'  ");

    $brand_has_model_id;

    if ($bhm_rs->num_rows == 1) {

        $bhm_data = $bhm_rs->fetch_assoc();
        $brand_has_model_id = $bhm_data["id"];
    } else {
        Database::iud("INSERT INTO `brand_has_model` (`brand_id`)(`model_id`) 
        VALUES ('" . $brand . "' , '" . $model . "')  ");
        $brand_has_model_id = Database::$connection->insert_id;
    }

    //echo($brand_has_model_id);



    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product` (`price`,`qtyl`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,
    `category_id`,`brand_has_model_id`,`colour_id`,`status_id`,`condition_id`,`user_email`)VALUES
     ( '" . $cost . "','" . $qty . "','" . $desc . "','" . $title . "','" . $date . "','" . $dwc . "','" . $doc . "',
    '" . $category . "','" . $brand_has_model_id . "','" . $clr . "','" . $status . "','" . $condition . "','" . $email . "') ");

    //echo ("Product Saved Succesfully");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 3 && $length > 0) {
        $allowed_image_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml",);

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {
                $img_file = $_FILES["image" . $x];
                $file_extention = $img_file["type"];

                if (in_array($file_extention, $allowed_image_extensions)) {
                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//mobile_images//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "') ");
                } else {
                    echo ("Invalid Image Count");
                }
            }
        }
        echo ("Product Image Saved Succesfully");
    } else {
        echo ("Invalid Image Count");
    }
}
