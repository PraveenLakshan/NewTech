<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">

</head>

<body>

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-12 col-lg-4 align-self-start mt-2">

                <?php

                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                    //echo($data["fname"]);

                ?>

                    <span class="text-lg-start wc-name" onclick="window.location='home.php';"><b>Welcome </b><?php echo $data["fname"]; ?></span> |
                    <span class="text-lg-start fw-bold signout" onclick="signout();">Sign Out</span> |

                <?php

                } else {
                ?>

                    <a href="index.php" class="text text-decoration-none fw-bold">Sign In Or Register</a> |


                <?php
                }

                ?>


                <span class="text-lg-start fw-bold ">Help And Contact</span>

            </div>

            <div class="offset-lg-4 col-12 col-lg-3 align-self-end">

                <div class="row">
                <a class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 " href="cart.php">
                <img src="resource/cart1.png" alt="Bootstrap" width="30" height="24">
            </a>

                    <div class=" col-2 col-lg-6 dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                            <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                            <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="message.php">Message</a></li>
                            <li><a class="dropdown-item" href="#" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">Contact Admin</a></li>
                        </ul>
                    </div>

                   
                       

                    </div>

                     <!--msg modal-->
                     <div class="modal" tabindex="-1" id="contactAdmin">
                            <div class="modal-dialog">  
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Contact Admin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body overflow-scroll">
                                        <!--received-->
                                        <div class="modal-body">
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-8 rounded bg-success">
                                                        <div class="row">
                                                            <div class="col-12 pt-2">
                                                                <span class="text-white fs-4 fw-bold">Hello There !!</span>
                                                            </div>
                                                            <div class="col-12 pb-2 text-end">
                                                                <span class="text-white fs-6 ">2022-11-09 21:42:20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--received-->
                                        <!--sent-->
                                        <div class="modal-body">
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-8 rounded bg-primary offset-4">
                                                        <div class="row">
                                                            <div class="col-12 pt-2">
                                                                <span class="text-white fs-4 fw-bold">Hello There !!</span>
                                                            </div>
                                                            <div class="col-12 pb-2 text-end">
                                                                <span class="text-white fs-6 ">2022-11-09 21:42:20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--sent-->
                                        <div class="modal-footer">

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <input type="text" class="form-control" id="msgtxt"/>
                                                    </div>
                                                    <div class="col-3 d-grid">
                                                        <button type="button" class="btn btn-primary" onclick="sendAdminMsg();">Send</button>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!--msg modal-->

                </div>
            </div>

        </div>

    </div>



    <script src="script.js"></script>

    <!-- <script src="bootstrap.bundle.js"></script> -->


</body>

</html>