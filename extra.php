<?php
// Database connection
$connection = new PDO('mysql:host=localhost;dbname=q_blog', 'root', '');

// Check if the page number is provided in the GET request
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$posts_per_page = 10; // Number of posts per page
$offset = ($page - 1) * $posts_per_page;

// Fetch posts from the database
$sql = "SELECT * FROM all_posts ORDER BY post_date DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $posts_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Fetch posts and check if there are any
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$has_posts = !empty($posts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Page</title>
    <style>
        /* Style for the loading spinner */
        .loading {
            text-align: center;
            padding: 20px;
        }
        .loading img {
            width: 50px;
        }
        .post {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div id="posts-container">
        <?php
        // Display posts using while loop
        while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="post">';
            echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
            echo '<p>' . htmlspecialchars($post['description']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="loading" id="loading" style="<?php echo $has_posts ? '' : 'display:none;'; ?>">
        <img src="loading-spinner.gif" alt="Loading...">
    </div>

    <script>
        let page = <?php echo $page; ?>; // Initialize page number from PHP
        let loading = false; // Prevent multiple AJAX calls

        // Function to load more posts
        function loadMorePosts() {
            if (loading) return; // Prevent multiple calls
            loading = true;
            page++;

            // AJAX request to load more posts
            fetch(`?page=${page}`)
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "") {
                        document.getElementById('loading').style.display = 'none'; // Hide loading spinner when no more posts
                    } else {
                        document.getElementById('posts-container').insertAdjacentHTML('beforeend', data);
                    }
                    loading = false;
                })
                .catch(error => {
                    console.error('Error loading posts:', error);
                    loading = false;
                });
        }

        // Detect when the user scrolls near the bottom
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                loadMorePosts();
            }
        });
    </script>
</body>
</html>
