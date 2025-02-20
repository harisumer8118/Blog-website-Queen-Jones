<?php
session_start();
require('connection.php');

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}

// Handle file upload
if (empty($_FILES['new_image']['name'])) {
    $file_name = $_POST['old_image'];
} else {
    $error = array();

    $file_name = $_FILES['new_image']['name'];
    $file_size = $_FILES['new_image']['size'];
    $file_tmp = $_FILES['new_image']['tmp_name'];
    $file_type = $_FILES['new_image']['type'];
    $file_ext = explode('.', $file_name);
    $file_extt = strtolower(end($file_ext));

    $extension = array("jpeg", "jpg", "png","webp");

    if (in_array($file_extt, $extension) === false) {
        $error[] = "This extension file not allowed, please choose a jpg or , png or webp file.";
    }
    if ($file_size > 2097152) {
        $error[] = "File must be 2MB or lower.";
    }
    if (empty($error) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        die(implode(", ", $error));
    }
}

$post_id = $_POST["post_id"];
$title = mysqli_real_escape_string($connection, $_POST["title"]);
$description = mysqli_real_escape_string($connection, $_POST["description"]);
$category = mysqli_real_escape_string($connection, $_POST["category"]);

// Get the old category before updating
$query_old_category = "SELECT category FROM all_post WHERE post_id = $post_id";
$result_old_category = mysqli_query($connection, $query_old_category);
if (!$result_old_category) {
    die("Query failed: " . mysqli_error($connection));
}
$row_old_category = mysqli_fetch_assoc($result_old_category);
$old_category = $row_old_category['category'];

$sql = "UPDATE all_post SET title='$title', description='$description', category='$category', post_img='$file_name' 
        WHERE post_id=$post_id";
$resu = mysqli_query($connection, $sql);

if ($resu) {
    // Decrease the post count of the old category
    $update_old_category = "UPDATE category SET post = post - 1 WHERE category_id = $old_category";
    if (!mysqli_query($connection, $update_old_category)) {
        die("Updating old category failed: " . mysqli_error($connection));
    }

    // Increase the post count of the new category
    $update_new_category = "UPDATE category SET post = post + 1 WHERE category_id = $category";
    if (!mysqli_query($connection, $update_new_category)) {
        die("Updating new category failed: " . mysqli_error($connection));
    }

    echo '<script>window.location.href = "index.php";</script>';
} else {
    die("Post update failed: " . mysqli_error($connection));
}
?>
