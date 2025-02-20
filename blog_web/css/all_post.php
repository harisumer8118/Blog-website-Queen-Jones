<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
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

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php

if ($_SESSION["role"] == 'admin') {
    $select = "SELECT * FROM `all_post` 
    LEFT JOIN `category` ON all_post.category = category.category_id
    LEFT JOIN `registration` ON all_post.author = registration.id 
    ORDER BY all_post.post_id DESC";
} elseif ($_SESSION["role"] == 'user') {
    $select = "SELECT * FROM `all_post` 
    LEFT JOIN `category` ON all_post.category = category.category_id
    LEFT JOIN `registration` ON all_post.author = registration.id 
    WHERE all_post.author = '{$_SESSION['id']}'
    ORDER BY all_post.post_id DESC";
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <h1 class="h3 mb-0 text-gray-800"></h1> -->

                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <?php
                    while ($fetch = mysqli_fetch_assoc($sel_query)) {
                        $post_id = $fetch['post_id'];
                        $title = $fetch['title'];
                        $description = $fetch['description'];
                        $category = $fetch['category_name'];
                        $post_date = $fetch['post_date'];
                        $author = $fetch['role'];
                        $author_person = $fetch['author'];
                        $post_img = $fetch['post_img'];

                        ?>
                        <div class="container mt-5">


                            <div class="card">
                                <img src="upload/<?php echo $post_img; ?>" class="" alt="Blog Image" width="200px">
                                <div class="card-body">
                                    <h2 class="card-title"><?php echo $title; ?></h2>
                                    <p class="card-text"><?php echo $description; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">Category: <span class="badge badge-primary">
                                        <?php echo $category; ?></span></small>
                                        <small class="text-muted"><?php echo $post_date; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                    <!-- Content Row -->



                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>