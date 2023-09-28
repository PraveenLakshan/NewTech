<?php

class Database{

    public static $connection; // Static - Me Variable Eka Apita Project Eke Ona Thanakin
                               // Use Karanna Puluwan (Database Object Eka Haraha)

    public static function setUpConnection(){

        if(!isset(Database::$connection)){ // Database Class Eke Connection Kiyana Static Variable Ekata 
                                           // Value Ekak Set Wela Nadda Kiyala Balanawa

            Database::$connection = new mysqli("localhost","root","JapL050514#@","newtech","3306");
        }


    }

    public static function iud($q){ // iud - Insert, Update, Delete

        Database::setUpConnection(); // Database Class Eke Set Up Connection Kiyana Function Ekata Call 
                                    // Karala Check Karala Balanawa Connection Ekak Set Wela Nadda Kiyala

        Database::$connection->query($q);


    }

    public static function search($q){

        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;  // Query Eka Excicute Wela Ena Result Set Eka Apita Query Eka Pass Wena Thanata
                           // Return Karanawa


    }



}

?>
