<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=q_blog', 'root', '');

// Get the current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$posts_per_page = 10; // Number of posts per page

// Calculate the offset
$offset = ($page - 1) * $posts_per_page;

// Fetch posts from the database
$sql = "SELECT * FROM all_posts ORDER BY post_date DESC LIMIT :offset, :limit";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $posts_per_page, PDO::PARAM_INT);
$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post) {
    echo '<div class="post">';
    echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
    echo '<p>' . htmlspecialchars($post['description']) . '</p>';
    echo '</div>';
}

// Return an empty response if there are no more posts
if (empty($posts)) {
    echo '';
}
?>
