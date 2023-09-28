<?Php

require "connection.php";

//echo("Hello");

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

//echo($fname);
//echo("<br/>");
//echo($lname);
//echo("<br/>");
//echo($email);
//echo("<br/>");
//echo($password);
//echo("<br/>");
//echo($mobile);
//echo("<br/>");
//echo($gender);

if(empty($fname)){
    echo("Please Enter Your First Name !!");

}else if(strlen($fname) > 50){
    echo("First Name Must Have Less Than 50 Characters");

}else if(empty($lname)){
    echo("Please Enter Your Last Name !!");

}else if(strlen($lname) > 50){
    echo("Last Name Must Have Less Than 100 Characters");

}else if(empty($email)){
    echo("Please Enter Your Email !!");

}else if(strlen($email) >= 100){
    echo("Email Must Have Less Than 100 Characters");

}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email!!");


}else if(empty($password)){
    echo("Please Enter Your Password !!");

}else if(strlen($password) <5 || strlen($password) >20 ){  // Or = || 
    echo("Password Must Be Between 5-20 Characters");

}else if(empty($mobile)){
    echo("Please Enter Your Mobile !!");

}else if(strlen($mobile) != 10){  // Not Equal = !=
    echo("Mobile Must Have 10 Characters");

}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo("Invalid Mobile !!");

}else{

    //echo("Success");

    $rs = Database::search("SELECT * FROM `user` WHERE `email` =  '".$email."' OR `mobile` =  '".$mobile."' ");
    $n = $rs->num_rows;

    if($n > 0){
        echo("User With The Same Email Or Mobile Already Exists.");

    }else{
       $d = new DateTime();
       $tz = new DateTimeZone("Asia/Colombo");
       $d->setTimezone($tz);
       $date = $d->format("Y-m-d H:i:s");


       Database::iud("INSERT INTO `user` 
       (`fname`,`lname`,`email`,`mobile`,`password`,`gender_id`,`joined_date`,`status`) VALUES 
       ('".$fname."','".$lname."','".$email."','".$mobile."','".$password."','".$gender."','".$date."','1')" );


       echo("Success");

    }



}
