<?php

// session_start();
// require ('connection.php');

// if (!isset($_SESSION['email'])) {
//     header('location: login.php');
// }

session_start();
require('connection.php');

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit;
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
    <?php include ('include/css.php'); ?>


    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

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
                        <h1 class="h3 mb-0 text-gray-800">Add blog post</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">


                        <!-- form starts  -->

                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Blog</h5>

                                    <!-- Horizontal Form -->
                                    <form class="user" action="save_post.php" method="post"
                                        enctype="multipart/form-data">
                                        <div class="row mb-3 col-12">
                                            <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Subject</label> -->
                                            <div class="col-sm-12">
                                                <label for="exampleInputPassword1" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="inputText" name="title"
                                                    placeholder="Title">
                                                <!-- <label for="message">Message:</label><br> -->
                                                <!-- ////////////////////// -->




                                                <!-- ///////////// -->
                                                <label for="exampleInputPassword1"
                                                    class="form-label">Description</label>
                                                <!-- <textarea id="message" name="description" class="form-control text-area-txt " placeholder="Enter your description here..."></textarea> -->

                                                <div id="quill-editor-full" class="quill-editor-full"></div>
                                                <textarea id="message" name="description" class="form-control text-area-txt" style="display:none;"></textarea>
                                                
                                                <label for="exampleInputPassword1" class="form-label">Category</label>
                                                <select name="category" id="catee" class="form-control">
                                                    <option disabled>Select category</option>
                                                    <?php
                                                    $select = "SELECT * FROM `category`";
                                                    $sel_query = mysqli_query($connection, $select) or die("Query failed");
                                                    if (mysqli_num_rows($sel_query) > 0) {
                                                        while ($row = mysqli_fetch_assoc($sel_query)) {
                                                            echo "<option value='{$row['category_id']}'> {$row['category_name']} </option>";
                                                        }

                                                    }

                                                    ?>
                                                </select>
                                                <label for="exampleInputPassword1" class="form-label">Upload Image :
                                                    Please ensure your image size is less than 2 MB.</label>

                                                <input style="height:44px;" type="file" name="file_upload" id="fil"
                                                    class="form-control ">
                                            </div>
                                        </div>


                                        <div class="text-center add-posttext-margin-top">
                                            <button type="submit" class="btn btn-primary">Add Blog Post</button>

                                            <!-- <button type="reset" class="btn btn-secondary">Reset Blog Post</button> -->
                                        </div>
                                    </form><!-- End Horizontal Form -->

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










        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                var quill = new Quill('#quill-editor-full', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['link', 'image']
                        ]
                    }
                });

                var form = document.querySelector('form');
                form.onsubmit = function() {
                    var description = document.querySelector('textarea[name=description]');
                    description.value = quill.root.innerHTML;
                };
            });
        </script>

</body>

</html>