<?php

require "connection.php";

if (isset($_GET["id"])) {

    $invoice_id = $_GET["id"];


    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $invoice_id . "'");
    $invoice_num = $invoice_rs->num_rows;


    if ($invoice_num == 1) {

        $invoice_data = $invoice_rs->fetch_assoc();

?>
        <div class="row">
            <div class="col-1 bg-secondary text-end">
                <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["id"]; ?></label>
            </div>
            <?php
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $invoice_data["product_id"] . "' ");
            $product_data = $product_rs->fetch_assoc();
            ?>
            <div class="col-3 bg-body text-end">
                <label class="form-label fs-5 fw-bold text-black mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
            </div>
            <?php
            $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $invoice_data["user_email"] . "' ");
            $user_data = $user_rs->fetch_assoc();
            ?>
            <div class="col-3 bg-secondary text-end">
                <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></label>
            </div>
            <div class="col-2 bg-body text-end">
                <label class="form-label fs-5 fw-bold text-black mt-1 mb-1">Rs.<?php echo $invoice_data["total"]; ?>.00</label>
            </div>
            <div class="col-1 bg-secondary text-end">
                <label class="form-label fs-5 fw-bold text-white mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></label>
            </div>
            <div class="col-2 bg-white d-grid">
                <?php

                if ($invoice_data["status"] == 0) {
                ?>
                    <button class="btn btn-success mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Confirm Order</button>
                <?php
                } else if ($invoice_data["status"] == 1) {
                ?>
                    <button class="btn btn-warning mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Packing</button>
                <?php
                } else if ($invoice_data["status"] == 2) {
                ?>
                    <button class="btn btn-info mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Dispatch</button>
                <?php
                } else if ($invoice_data["status"] == 3) {
                ?>
                    <button class="btn btn-primary mt-1 mb-1" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Shipping</button>
                <?php
                } else if ($invoice_data["status"] == 4) {
                ?>
                    <button class="btn btn-danger mt-1 mb-1 disabled" onclick="changeStatus('<?php echo $invoice_data['id']; ?>');" id="btn<?php echo $invoice_data["id"]; ?>">Delivered</button>
                <?php
                }
                ?>

            </div>
        </div>
<?php

    } else {
        echo ("Invalid Invoice Id");
    }
}