

<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
require ('connection.php');

if ($_SESSION["role"] != 'admin') {
    header('location: index.php');
}

if (isset($_GET['approve'])) {
    $user_id = $_GET['approve'];
    $select_user = "SELECT * FROM pending_users WHERE id='$user_id'";
    $result = mysqli_query($connection, $select_user);
    $user_data = mysqli_fetch_assoc($result);
    
    $insert = "INSERT INTO registration (firstname, lastname, email, password, role) VALUES ('{$user_data['firstname']}', '{$user_data['lastname']}', '{$user_data['email']}', '{$user_data['password']}', 'user')";
    if (mysqli_query($connection, $insert)) {
        $delete = "DELETE FROM pending_users WHERE id='$user_id'";
        mysqli_query($connection, $delete);
    }
}

if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete = "DELETE FROM pending_users WHERE id='$user_id'";
    mysqli_query($connection, $delete);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">

       <?php
    if ($_SESSION["role"] == 'admin' || $_SESSION["role"] == 'moderator') {
        $select = "SELECT * FROM pending_users ORDER BY id DESC";
    }

    $sel_query = mysqli_query($connection, $select);
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include ('include/side_bar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include ('include/header.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container-fluid">

                    <!-- //////////////////// -->
                    <div class="container">
                        <br><h1 class="h3 mb-0 text-gray-800">Pending User Requests</h1><br><br>
                        <table class="table datatable addprosdk">
                            <thead>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th colspan="2">Actions</th>
                            </thead>
                            <tbody>
                                <?php while ($fetch = mysqli_fetch_assoc($sel_query)) { ?>
                                    <tr>
                                        <td><?php echo $fetch['firstname']; ?></td>
                                        <td><?php echo $fetch['lastname']; ?></td>
                                        <td><?php echo $fetch['email']; ?></td>
                                        <td><a class="btn btn-outline-primary" href="user.php?approve=<?php echo $fetch['id']; ?>">Approve</a></td>
                                        <td><a class="btn btn-outline-primary" href="user.php?delete=<?php echo $fetch['id']; ?>">Delete</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- ////////////////////////////////// -->

                </div>



                <!-- End of Main Content -->

                <!-- Footer -->
                <?php
                include ('include/footer.php');
                ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->








        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>