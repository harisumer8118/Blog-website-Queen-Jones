

<?php
require 'connection.php';

$query = $_GET['query'];
$query = mysqli_real_escape_string($connection, $query);

$sql = "SELECT post_id, title FROM all_post WHERE title LIKE '%$query%'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
  // while ($row = mysqli_fetch_assoc($result)) {
  //   $post_id = $row['post_id'];
  //   $title = htmlspecialchars($row['title']);
  //   echo "<a href='single-blog.php?id=$post_id' class='dropdown-item'>$title</a>";
  // }
  while ($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $title = htmlspecialchars($row['title']);
    $short_title = substr($title, 0, 45) . '...'; // Display the first 10 characters followed by '...'
    echo "<a href='single-blog.php?id=$post_id' class='dropdown-item'>$short_title</a>";
}

} else {
  echo "<p class='dropdown-item'>No results found</p>";
}

mysqli_close($connection);
?>
