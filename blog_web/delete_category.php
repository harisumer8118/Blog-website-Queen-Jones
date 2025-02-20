<?php 

require ('connection.php');

$cat_id = $_GET['sno'];

// Check the number of posts in the category
$check_posts_query = "SELECT post FROM category WHERE category_id = {$cat_id}";
$result = mysqli_query($connection, $check_posts_query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $post_count = $row['post'];

    if ($post_count > 0) {
        // If there are posts in the category, do not delete
        ?>
        <script>
            alert("Category cannot be deleted because it contains posts.");
            window.location.href = 'category.php';
        </script>
        <?php
    } else {
        // If there are no posts in the category, proceed with deletion
        $sql = "DELETE FROM category WHERE category_id = {$cat_id}";

        if (mysqli_query($connection, $sql)) {
            header("LOCATION: category.php");
        } else {
            ?>
            <script>
                alert("Query failed");
                window.location.href = 'category.php';
            </script>
            <?php
        }
    }
} else {
    ?>
    <script>
        alert("Category not found.");
        window.location.href = 'category.php';
    </script>
    <?php
}
?>
