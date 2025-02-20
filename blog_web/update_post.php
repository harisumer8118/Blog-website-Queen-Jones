<?php

session_start();
require ('connection.php');

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

// include ('connection.php');
// session_start();
// if (isset($_SESSION["role"]) && $_SESSION["role"] == 'user') {

//     header('location: index.php');
// }


$post_id = $_GET['sno'];
// echo $sno;
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


    <link href="assets/quill.snow.css" rel="stylesheet">



</head>

<body id="page-top">

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
                        <h1 class="h3 mb-0 text-gray-800">Update pending post</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">


                        <!-- form starts  -->

                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Blog</h5> -->
                                    <?php
                                    // $sno = $_GET['sno'];
                                    
                                    $select = "SELECT * FROM `post` 
                                            LEFT JOIN `category` ON post.category = category.category_id
                                            LEFT JOIN `registration` ON post.author = registration.id 
                                            WHERE post.post_id = {$post_id} ";
                                    $sel_query = mysqli_query($connection, $select);
                                    if (mysqli_num_rows($sel_query) > 0) {
                                        while ($fetch = mysqli_fetch_assoc($sel_query)) {


                                            ?>
                                            <!-- Horizontal Form -->
                                            <form class="user" action="save-update-post.php" method="POST"
                                                enctype="multipart/form-data">
                                                <div class="row mb-3 col-12">
                                                    <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Subject</label> -->
                                                    <div class="col-sm-12">
                                                        <input type="hidden" class="form-control" id="inputText" name="post_id"
                                                            placeholder="" value="<?php echo $fetch['post_id'] ?>">

                                                        <label for="exampleInputPassword1" class="form-label">Title</label>
                                                        <input type="text" class="form-control" id="inputText" name="title"
                                                            placeholder="Title" value="<?php echo $fetch['title'] ?>">

                                                        <!-- <label for="message">Message:</label><br> -->
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Description</label>

                                                        <div id="editor-container" class="form-control text-area-txt">
                                                            <?php echo $fetch['description'] ?>
                                                        </div>
                                                        <!-- Hidden textarea to hold Quill content -->
                                                        <textarea name="description" id="hidden-description"
                                                            style="display:none;"></textarea>

                                                        <label for="exampleInputPassword1" class="form-label">Category</label>
                                                        <select name="category" id="catee" class="form-control">
                                                            <option disabled>Select category</option>
                                                            <?php
                                                            $select1 = "SELECT * FROM `category`";
                                                            $sel_query1 = mysqli_query($connection, $select1) or die("Query failed");
                                                            if (mysqli_num_rows($sel_query1) > 0) {
                                                                while ($row1 = mysqli_fetch_assoc($sel_query1)) {
                                                                    $selected = ($fetch['category'] == $row1['category_id']) ? "selected" : "";
                                                                    echo "<option {$selected} value='{$row1['category_id']}'> {$row1['category_name']} </option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="exampleInputPassword1" class="form-label">Image
                                                            Upload</label>
                                                        <input style="height:44px;" type="file" name="new_image" id="fil"
                                                            class="form-control">
                                                        <img src="upload/<?php echo $fetch['post_img'] ?>" alt="img"
                                                            class="updatepost_imgg">
                                                        <input type="hidden" name="old_image"
                                                            value="<?php echo $fetch['post_img'] ?>">
                                                    </div>
                                                </div>


                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Update Post</button>

                                                    <!-- <button type="reset" class="btn btn-secondary">Reset Blog Post</button> -->
                                                </div>
                                            </form><!-- End Horizontal Form -->


                                            <?php
                                        }
                                    } else {
                                        echo "Result not found";
                                    }
                                    ?>


                                </div>
                            </div>




                        </div>


                        <!-- form ends -->
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

        <?php
        include ('include/script.php');
        ?>

</body>

</html>