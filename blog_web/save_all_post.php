<?php
session_start();
require('connection.php');

$post_id = $_GET['sno'];

// Fetch the post data from post table
$select = "SELECT * FROM post WHERE post_id = $post_id";
$result = mysqli_query($connection, $select);

if ($result) {
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row['post_id'];
            $title = mysqli_real_escape_string($connection, $row['title']);
            $description = mysqli_real_escape_string($connection, $row['description']);
            $category = mysqli_real_escape_string($connection, $row['category']);
            $post_date = mysqli_real_escape_string($connection, $row['post_date']);
            $author = mysqli_real_escape_string($connection, $row['author']);
            $post_img = mysqli_real_escape_string($connection, $row['post_img']);
            $feature = 0;
            // Insert the post data into all_post table
            $sql_insert = "INSERT INTO all_post (post_id, title, description, category, post_date, author, post_img, feature) VALUES ('$post_id', '$title', '$description', '$category', '$post_date', '$author', '$post_img' , '$feature')";

            if (mysqli_query($connection, $sql_insert)) {
                // echo "New post inserted successfully";

                // Delete the post from post table
                $sql_delete = "DELETE FROM post WHERE post_id = $post_id";

                if (mysqli_query($connection, $sql_delete)) {
                    // echo "Post deleted from post table successfully";
                    echo "<script>window.location.href='index.php';</script>";
                } else {
                    echo "Error deleting post: " . mysqli_error($connection);
                }
            } else {
                echo "Error inserting post: " . mysqli_error($connection);
            }
        }
    } else {
        echo "No pending post found with the given ID.";
    }
} else {
    echo "Error: " . $select . "<br>" . mysqli_error($connection);
}

mysqli_close($connection);
?>
