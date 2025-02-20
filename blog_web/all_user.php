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
    $delete = "DELETE FROM registration WHERE id='$user_id'";
    mysqli_query($connection, $delete);
    header('location: all_user.php');
}

// Update user role
if (isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];
    $update_role = "UPDATE registration SET role='$new_role' WHERE id='$user_id'";
    mysqli_query($connection, $update_role);
    header('location: all_user.php');
}

// Fetch all users
$select = "SELECT * FROM registration ORDER BY id DESC";
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

    
    <?php include ('include/css.php'); ?>


</head>
<body id="page-top">
    <div id="wrapper">
        <?php include('include/side_bar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('include/header.php'); ?>
                <div class="container-fluid">
                    <div class="container table-responsive">
                        <br><h1 class="h3 mb-0 text-gray-800">Manage Users</h1><br><br>
                        <table class="table datatable addprosdk">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($fetch = mysqli_fetch_assoc($sel_query)) { ?>
                                    <tr>
                                        <td><?php echo $fetch['firstname']; ?></td>
                                        <td><?php echo $fetch['lastname']; ?></td>
                                        <td><?php echo $fetch['email']; ?></td>
                                        <td>
                                            <form method="post" action="all_user.php" style="display:inline;">
                                                <input type="hidden" name="user_id" value="<?php echo $fetch['id']; ?>">
                                                <select name="role">
                                                    <option value="user" <?php if ($fetch['role'] == 'user') echo 'selected'; ?>>User</option>
                                                    <option value="moderator" <?php if ($fetch['role'] == 'moderator') echo 'selected'; ?>>Moderator</option>
                                                    <option value="admin" <?php if ($fetch['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                                </select>
                                                <a href="#"  class="btn btn-success ">
                                                <button type="submit" name="update_role" class="">Update</button>
                                                </a>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger text-white" href="all_user.php?delete=<?php echo $fetch['id']; ?>">Delete</a>
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
