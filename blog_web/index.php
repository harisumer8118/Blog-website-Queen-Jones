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
    
    
    <!-- css include file -->
    <?php include ('include/css.php'); ?>

    
</head>

<body id="page-top">

    <?php
    if ($_SESSION["role"] == 'admin' || $_SESSION["role"] == 'moderator') {
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
        <?php include ('include/side_bar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper " class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include ('include/header.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    </div>
                    <div class="container">
                        <h1 class="h3 mb-0 text-gray-800"><a href="add_post.php" class=""><button type="button" class="btn btn-primary">Add new post</button></a></h1><br><br>
                    </div>
                    <!-- Content Row -->
                    <?php
                    while ($fetch = mysqli_fetch_assoc($sel_query)) {
                        $post_id = $fetch['post_id'];
                        $title = $fetch['title'];
                        $reg_id = $fetch['id'];
                        $description = $fetch['description'];
                        $category = $fetch['category_name'];
                        $post_date = $fetch['post_date'];
                        $author = $fetch['role'];
                        $post_img = $fetch['post_img'];
                    ?>
                        <!-- Post Card -->
                        <div class="container mt-5">
                            <div class="card table-responsive">
                                <img src="upload/<?php echo $post_img; ?>" class="ml-3 mt-3 imgpost" alt="Blog Image" width="150px">
                                <div class="card-body">
                                    <h2 class="card-title" style="font-size: 20px;"><?php echo substr($title, 0, 90) . "..."; ?></h2>
                                    <p class="card-text" style="font-size: 12px;"><?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description); echo substr($description, 0, 280) . "..."; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">Category: <span class="badge badge-primary"><?php echo $category; ?></span></small>

                                        <small class="text-muted"><?php echo $post_date; ?></small>

                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="text-muted">User status: <span class="badge badge-primary"><?php echo $author; ?></span></small>
                                        <?php if ($_SESSION["role"] == 'admin') { ?>
                                            <small class="text-muted">User ID: <span class="badge badge-primary"><?php echo $reg_id; ?></span></small>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="d-flex flex-row-reverse">
                                        <a class="btn btnn btn-danger btn-sm ml-2" href="delete_index_post.php?sno=<?php echo $post_id; ?>&catid=<?php echo $fetch['category_id']; ?>">Delete</a>
                                        <a class="btn btnn btn-warning btn-sm ml-2 mr-2" href="update_index.php?sno=<?php echo $post_id; ?>">Update</a>
                                        <?php if ($_SESSION["role"] == 'admin') { ?>
                                        <a class="btn btnn btn-sm ml-2 mr-2 btn-success" href="feature_post.php?sno=<?php echo $post_id; ?>">Feature</a>
                                        <?php } ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include ('include/footer.php'); ?>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
