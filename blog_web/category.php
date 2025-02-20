<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
require ('connection.php');

// Check user role
if ($_SESSION["role"] !== 'admin') {
    echo '<script>
        window.location.href = "index.php";
    </script>';
    exit();
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

    <?php include ('include/css.php'); ?>


</head>

<body id="page-top">
    <?php
    // echo $_SESSION['id'];
    

    if ($_SESSION["role"] == 'admin' || $_SESSION["role"] == 'moderator') {
        $select = "SELECT * FROM `category`";
    } else {

        '<script>
                alert("Only admin can use this page please go back ");
                window.location.href = "index.php";
              </script>';
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
                    <div class="container table-responsive">
                        <br>
                        <h1 class="h3 mb-0 text-gray-800"><a href="add_category.php" class=""><button type="button" class="btn btn-primary">Add category</button></a></h1><br><br>
                        
                        <table class="table datatable addprosdk">
                            <thead>
                                <th>Category name</th>
                                <th>No: of Posts</th>
                                <th>Delete </th>
                            </thead>

                            <tbody>
                                <?php
                                while ($fetch = mysqli_fetch_assoc($sel_query)) {
                                    $category_id = $fetch['category_id'];
                                    $category_name = $fetch['category_name'];
                                    $post = $fetch['post'];


                                    ?>

                                    <tr>
                                        <td><span style="width:30px !important;"><?php echo $category_name; ?></span></td>
                                        <td><?php echo $post; ?></td>
                                        <td><button><a class="btn btn-outline-primary"  href="delete_category.php?sno=<?php echo $category_id; ?>">Delete</a></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>


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