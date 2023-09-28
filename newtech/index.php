<?php

require "connection.php";

?>




<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>New Tech</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

 <link rel="icon" href="resource/newtech.png" />

</head>

<body class="main-body">

    <div class="container-fluid vh-120 d-flex justify-content-center">

        <div class="row align-content-center">

            <!--header -->
            <div class="col-12">

                <div class="row">

                    <div class="col-12 logo"></div>

                    <div class="col-12">
                        <p class="text-center title1">Welcome to New Tech Shop</p>
                    </div>

                </div>

            </div>
            <!--header -->

            <!--content -->
            <div class="col-12 p-3">

                <div class="row">

                    <div class="col-6 d-none d-lg-block background"></div>

                    <div class="col-12 col-lg-6" id="signUpBox">

                        <div class="row g-2">

                            <div class="col-12">

                                <p class="title2">Create New Account</p>

                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg">

                                    </i>

                                </div>

                            </div>

                            <div class="col-6">
                                <lable class="form-lable text-white">First Name</lable>
                                <input type="text" class="form-control" id="f" />

                            </div>

                            <div class="col-6">
                                <lable class="form-lable text-white">Last Name</lable>
                                <input type="text" class="form-control" id="l" />

                            </div>

                            <div class="col-12">
                                <lable class="form-lable text-white">Email</lable>
                                <input type="email" class="form-control" id="e" />

                            </div>

                            <div class="col-12">
                                <lable class="form-lable text-white">Password</lable>
                                <input type="password" class="form-control" id="p" />

                            </div>

                            <div class="col-6">
                                <lable class="form-lable text-white">Mobile</lable>
                                <input type="text" class="form-control" id="m" />

                            </div>

                            <div class="col-6">
                                <lable class="form-lable text-white">Gender</lable>
                                <select class="form-select" id="g">
                                    <?php
                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>
                                </select>

                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>

                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">Already Have An Account? Sign In</button>

                            </div>



                        </div>

                    </div>

                    <div class="col-12 col-lg-6 d-none" id="signInBox">

                        <div class="row g-2">

                            <div class="col-12">

                                <p class="title2">Sign In</p>
                                <span class="text-danger" id="msg2"></span>

                                <?php
                                $email = "";
                                $password = "";

                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }

                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }

                                ?>

                            </div>

                            <div class="col-12">
                                <lable class="form-lable">Email</lable>
                                <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" />

                            </div>

                            <div class="col-12">
                                <lable class="form-lable">Password</lable>
                                <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" />

                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme" />
                                    <label class="form-check-label">Remember Me</label>
                                </div>

                            </div>

                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>

                            </div>

                            <div class="col-12 col-lg-6 d-grid">

                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>

                            </div>

                            <div class="col-12 col-lg-6 d-grid">

                                <button class="btn btn-danger" onclick="changeView();">New To Shop? Join Now</button>

                            </div>
                            <div class="col-12 col-lg-12 d-grid">

                            <a class="btn btn-warning" href="adminSignin.php">Admin Sign In</a>

                            </div>

                        </div>


                    </div>


                </div>

            </div>
            <!--content -->

            <!--modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-lable">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();"><i class="bi bi-eye-slash-fill"></i></button>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <label class="form-lable">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i class="bi bi-eye-slash-fill"></i></button>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <label class="form-lable">Verification Code</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="vc"/>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--modal -->

            <!--footer -->
            <div class="col-12 d-none d-lg-block">
                <p class="text-center text-white">&copy; 2023 New Tech(pvt) Ltd. || All Right Reserved</p>
            </div>
            <!--footer -->

        </div>



    </div>



    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>