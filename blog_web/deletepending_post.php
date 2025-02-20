<?php 
require('connection.php');

$post_id = $_GET['sno'];
$cat_id = $_GET['catid'];

// Step 1: Retrieve the image filename
$imageQuery = "SELECT post_img FROM post WHERE post_id = {$post_id}";
$imageResult = mysqli_query($connection, $imageQuery);
$imageRow = mysqli_fetch_assoc($imageResult);
$post_img = $imageRow['post_img'];

// Step 2: Delete the post from the database
$sql = "DELETE FROM post WHERE post_id = {$post_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id} ";

if (mysqli_multi_query($connection, $sql)) {
    // Step 3: Delete the image file from the upload directory
    $filePath = 'upload/' . $post_img;
    if (is_file($filePath)) {
        if (unlink($filePath)) {
            // Redirect to index.php if the image is successfully deleted
            header("Location: index.php");
        } else {
            echo "<script>alert('Failed to delete image file');</script>";
        }
    } else {
        // If the image file does not exist, redirect to index.php
        header("Location: index.php");
    }
} else {
    echo "<script>alert('Query failed');</script>";
}

mysqli_close($connection);
?>
