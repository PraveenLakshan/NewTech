<?php

session_start();
require "connection.php";

//echo("Hello");

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

//echo($email);
//echo("<br/>");
//echo($password);
//echo("<br/>");
//echo($rememberme);

if (empty($email)) {
    echo ("Please Enter Your Email !!");
} else if (strlen($email) >= 100) {
    echo ("Email Must Have Less Than 100 Characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email!!");
} else if (empty($password)) {
    echo ("Please Enter Your Password !!");
} else if (strlen($password) < 5 || strlen($password) > 20) {  // Or = || 
    echo ("Password Must Be Between 5-20 Characters");
} else {
    //echo("success");

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' 
    AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($rememberme == "true") {

            setcookie("email", $email, time() + (60 * 60 * 24 * 365));
            setcookie("password", $password, time() + (60 * 60 * 24 * 365));
        } else {

            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
    } else {
        echo ("Invalid Username or Password");
    }
}
