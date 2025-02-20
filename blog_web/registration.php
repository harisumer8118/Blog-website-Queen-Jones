<?php
require('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    
    
    <!-- css include file -->
    <?php include ('include/css.php'); ?>

    
</head>

<body class="bg-gradient-primary" style="background-image: url('img/mask-group.png'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="p-5 pedding-of">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 loghead">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" placeholder="First Name" name="firstname">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" placeholder="Last Name" name="lastname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="Email Address" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" placeholder="Repeat Password" name="repeatpassword">
                                    </div>
                                </div>
                                <input type="hidden" name="posted">
                                <input type="submit" class="btn  btn-primary btn-user btn-block" value="Register Account">
                            </form>
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['posted'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    
    if ($password == $repeatpassword) {
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $insert = "INSERT INTO pending_users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";
            $ins_query = mysqli_query($connection, $insert);

            if ($ins_query) {
                echo '<script>
                    alert("Your account request has been submitted and is pending approval.");
                    window.location = "login.php";
                </script>';
            } else {
                echo '<script>alert("Data not inserted.");</script>';
            }
        } else {
            echo '<script>alert("Please fill all fields.");</script>';
        }
    } else {
        echo '<script>alert("Passwords do not match. Please type the password correctly.");</script>';
    }
}
?>
