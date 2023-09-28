<?php

require "connection.php";

if (isset($_GET["b"])) {

    $brand_id = $_GET["b"];

    $models_rs = Database::search("SELECT * FROM `model` WHERE `brand_id` = '" . $brand_id . "' ");
    $models_num = $models_rs->num_rows;

    if ($models_num > 0) {

        for ($x = 0; $x < $models_num; $x++) {

            $models_data = $models_rs->fetch_assoc();

         ?>

            <option value="<?php echo $models_data["id"]; ?>"><?php echo $models_data["name"]; ?></option>

        <?php

        }
    } else {

        $all_models = Database::search("SELECT * FROM `model`");
        $all_num = $all_models->num_rows;

        for ($y = 0; $y < $all_num; $y++) {
            $all_data = $all_models->fetch_assoc();
        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["name"]; ?></option>

        <?php
        
        }
    }
}

?>