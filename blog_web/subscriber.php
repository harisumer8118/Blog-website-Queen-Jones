<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
require('connection.php');

if ($_SESSION["role"] != 'admin') {
    header('location: index.php');
}

// Delete user
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete = "DELETE FROM subscriber WHERE id='$user_id'";
    mysqli_query($connection, $delete);
    header('location: subscriber.php');
}

// Fetch all users
$select = "SELECT * FROM subscriber ORDER BY id DESC";
$sel_query = mysqli_query($connection, $select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Manage Users</title>
    
    
    <!-- css include file -->
    <?php include ('include/css.php'); ?>

    
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include('include/side_bar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('include/header.php'); ?>
                <div class="container-fluid">
                    <div class="container ">
                        <br><h1 class="h3 mb-0 text-gray-800">Subscriber</h1><br><br>
                        <table class="table datatable addprosdk">
                            <thead>
                                <tr>
                                    <th>Subscriber's Email</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($fetch = mysqli_fetch_assoc($sel_query)) { ?>
                                    <tr>
                                        <td><?php echo $fetch['sub_email']; ?></td>
                                        <td>
                                            <a class="btn btn-danger text-white delete-btn" href="#" data-id="<?php echo $fetch['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php include('include/footer.php'); ?>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this subscriber?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" id="confirmDeleteBtn" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                var userId = $(this).data('id');
                $('#confirmDeleteBtn').attr('href', 'subscriber.php?delete=' + userId);
                $('#confirmDeleteModal').modal('show');
            });
        });
    </script>
</body>
</html>
