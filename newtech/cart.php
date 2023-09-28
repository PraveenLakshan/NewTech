<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | New Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/newtech.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include "header.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];


                $total = 0;
                $subtotal = 0;
                $shipping = 0;


            ?>



                <hr />

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>


                <div class="col-12 border border-1 rounded  mb-3 border-primary">
                    <div class="row">
                        <div class="col-12">
                            <label for="form-label" class="fs-1  fw-bolder">Cart <i class="bi bi-cart4  fs-1 text-success"></i></label>

                        </div>

                        <div class="col-12 col-lg-6">
                            <hr />

                        </div>

                        <div class="col-12 ">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search In Cart.....">

                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-primary">Search</button>

                                </div>

                            </div>

                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php

                        require "connection.php";

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>

                            <!-- empty view -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 fw-bold">You Have No Items In Your Cart Yet.</label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                        <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <!-- empty view -->

                        <?php

                        } else {
                        ?>

                            <!-- have Products -->

                            <div class="col-12 col-lg-12">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON
                                        user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE 
                                        `user_email` = '" . $email . "'  ");

                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 2) {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $product_data["delivery_fee_other"];
                                        } else {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $product_data["delivery_fee_other"];
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();

                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];



                                    ?>

                                        <div class=" mb-3 mx-0 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $seller; ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">
                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" 
                                                    data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Details">
                                                        <img src="resource/mobile_images/iphone12.jpg" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>


                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title">Apple iPhone 12</h3>

                                                        <span class="fw-bold text-black-50">Colour : Sierra Blue</span> &nbsp; |

                                                        &nbsp; <span class="fw-bold text-black-50">Condition : Brand New</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.350000.00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="15">
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.2000.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['id'];?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.352000.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                    <?php
                                    }


                                    ?>




                                </div>
                            </div>

                            <!-- have Products -->

                            <!-- summery -->


                            <div class="col-12 col-lg-12">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs.<?php echo $total; ?>.00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs.<?php echo $shipping; ?>.00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs.<?php echo ($total + $shipping); ?>.00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                    </div>

                                </div>
                            </div>



                            <!-- summery -->


                        <?php

                        }


                        ?>




                    </div>

                </div>

            <?php






            } else {
                echo ("Please  Sign In Or Register");
            }



            ?>







            

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script>
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl)
                })
            </script>


        </div>
        <?php include "footer.php"; ?>


    </div>

</body>

</html>