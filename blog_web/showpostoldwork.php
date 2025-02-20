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

$limit = 3;


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;


$select = "SELECT * FROM `post` 
LEFT JOIN `category` ON post.category = category.category_id
LEFT JOIN `registration` ON post.author = registration.id 
ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
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
                    <table class="table datatable addprosdk" >
                <thead>

                        <!-- <table border="2px solid #000" cellpadding="20px">
                            <thead align="center"> -->
                                <th>Sno</th>
                                <th>Title</th>
                                <!-- <th>Description</th> -->
                                <th>Category</th>
                                <th>Date</th>
                                <th>Author</th>
                                <th>Image</th>
                                <th colspan="2" >Options</th>
                            </thead>

                            <tbody>
                                <?php
                                while ($fetch = mysqli_fetch_assoc($sel_query)) {
                                    $post_id = $fetch['post_id'];
                                    $title = $fetch['title'];
                                    $description = $fetch['description'];
                                    $category = $fetch['category_name'];
                                    $post_date = $fetch['post_date'];
                                    $author = $fetch['role'];
                                    $post_img = $fetch['post_img'];

                                    ?>

                                    <tr>
                                        <td><?php echo $post_id; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <!-- <td class="custom-td"><?php echo $description; ?></td> -->
                                        <td><?php echo $category; ?></td>
                                        <td><?php echo $post_date; ?></td>
                                        <td><?php echo $author; ?></td>
                                        <td><img src="upload/<?php echo $post_img; ?>" alt="image" width="50px" style="border-radius:4px;"></td>

                                        <td ><button ><a href="#" class="btn btn-outline-primary">Post</a></button></td>
                                        <td><button><a  class="btn btn-outline-primary" href="#" >Delete</a></button></td>
                                    </tr>

                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>

                        <?php
                        $select1 = "SELECT * FROM `post`";
                        $sel_query1 = mysqli_query($connection, $select1);

                        if (mysqli_num_rows($sel_query1) > 0) {

                            $total_record = mysqli_num_rows($sel_query1);
                            // $limit = "3";
                            $total_pages = ceil($total_record / $limit);

                            echo ' <ul class="pagination">';

                            if ($page > 1) {
                                echo '<li class="page-item">
                            <a class="page-link" href="showpost.php?page=' . ($page - 1) . '" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            </a>
                  </li>';

                            }
                            for ($i = 1; $i <= $total_pages; $i++) {

                                // echo ' <li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                                echo ' <li class="page-item">' . $i . '</li>';

                            }

                            if ($total_pages > $page) {
                                echo '<li class="page-item">
                            <a class="page-link" href="showpost.php?page=' . ($page + 1) . '" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            </a>
                      </li>';

                            }

                            echo ' </ul>';


                        }


                        ?>
                        <!-- Pagination with icons -->



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


