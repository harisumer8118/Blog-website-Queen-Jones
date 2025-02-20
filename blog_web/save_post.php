
<?php
session_start();
require('connection.php');

if(isset($_FILES['file_upload']))
{
    $error = array();

    $file_name = $_FILES['file_upload']['name'];
    $file_size = $_FILES['file_upload']['size'];
    $file_tmp = $_FILES['file_upload']['tmp_name'];
    $file_type = $_FILES['file_upload']['type'];
    $file_ext = explode('.' , $file_name);
    $file_extt = strtolower(end($file_ext ));

    $extention = array("jpeg","jpg","png","webp");

    if (in_array($file_extt,$extention)=== false) {
         $error[] = "This extention file not allowed, please choose a jpg , png or webp file.";
        
    }
    if ($file_size > 2097152) {
         $error[] = "File must be 2MB  or lower. ";

    }
    if(empty($error)== true){
        move_uploaded_file($file_tmp,"upload/".$file_name);

    }else{
        die();
    }
}
else{
    echo "Image is not uploaded "; 
}

$title = mysqli_real_escape_string($connection,$_POST['title']);
$description = mysqli_real_escape_string($connection,$_POST['description']);
$category = mysqli_real_escape_string($connection,$_POST['category']);
$date = date("Y-m-d");
$author =  $_SESSION['id'] ;


$insert_post = "INSERT INTO `post` (`title`, `description`, `category`, `post_date`, `author`, `post_img`) 
VALUES ('$title', '$description', '$category', '$date', '$author', '$file_name')";

$insert_category = "UPDATE category SET post = post + 1 WHERE  category_id = {$category} ";
if (mysqli_query($connection, $insert_post) && mysqli_query($connection, $insert_category)) {
    header("Location: pendingpost.php");
} else {
    echo "Query failed: " . mysqli_error($connection);
}



?>  