<?php

session_start();
require ('connection.php');

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    
    
    <!-- css include file -->
    <?php include ('include/css.php'); ?>

    

</head>

<body class="bg-gradient-primary" style="background-image: url('img/mask-group.png'); background-size: cover; background-position: center;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 newdsf">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-8 mx-auto ">
                                <div class="p-5 pedding-of">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 loghead">Login Account</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div> -->
                                        </div>

                                        <input type="hidden" name="posted">
                                        <input type="submit" class="btn btn-primary btn-user btn-block "
                                            id="exampleInputPassword" value="Log in">


                                        <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="registration.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>




<?php
if (isset($_POST['posted'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $select = "SELECT * FROM `registration` WHERE `email` = '$email'";
        $sel_query = mysqli_query($connection, $select);



        $fetch_email = null;
        $fetch_password = null;


        while ($fetch = mysqli_fetch_assoc($sel_query)) {

            $_SESSION["role"] = $fetch['role'];
            $_SESSION['firstname'] = $fetch['firstname']; // Ensure this is set
            $fetch_id = $fetch['id'];
            $fetch_email = $fetch['email'];
            $fetch_password = $fetch['password'];
            $pass_verify = password_verify($password, $fetch_password);
        }
        if ($email == $fetch_email) {
            if ($password == $pass_verify) {
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $fetch_id;
                
                ?>
                <script>
                    window.location = 'index.php';
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Incorrect Password");
                </script>
                <?php
            }

        } else {
            ?>
            <script>
                alert("Incorrect Email");
            </script>
            <?php
        }



    } else {

        ?>
        <script>
            alert("Fill all fields");
        </script>
        <?php

    }


}





?>