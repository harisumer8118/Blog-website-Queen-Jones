<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts by Category</title>
    <?php include('include/css.php'); ?>
</head>

<body>

    <?php include('include/header.php'); ?>

    <div class="container">
        <div class="row">


            <?php
            require('connection.php');

            // Get the category ID from the URL
            $category_id = $_GET['category_id'];

            // Create the SQL query to select posts by category
            $select_posts = "
            SELECT * 
            FROM all_post
            LEFT JOIN category ON all_post.category = category.category_id
            LEFT JOIN registration ON all_post.author = registration.id
            WHERE category.category_id = $category_id
           ORDER BY all_post.post_date DESC
        ";



            // Execute the query
            $sel_query = mysqli_query($connection, $select_posts);

            // Check if there are posts for the selected category
            if (mysqli_num_rows($sel_query) > 0) {
                while ($fetch = mysqli_fetch_assoc($sel_query)) {
                    $post_id = $fetch['post_id'];
                    $title = $fetch['title'];
                    $description = $fetch['description'];
                    $category_name = $fetch['category_name'];
                    $post_img = $fetch['post_img'];
                    $author = $fetch['role'];
                    $post_date = $fetch['post_date'];
                    ?>


                    <div class="row  pag-child margi single-post">


                        <div class=" col-4 col-lg-4 col-md-12 col-sm-12 multi-2 ">
                            <a href='single-blog.php?id=<?php echo $post_id; ?>'> <img class="width-img-height"
                                    src="blog_web/upload/<?php echo $post_img; ?>" alt="post-img"></a>
                        </div>
                        <div class="col-8 col-lg-8 col-md-12 col-sm-12 cate-pag-col multi multi-anc ">
                            <h3 class="category-post-h"><?php echo substr($title, 0, 85) . "..."; ?></h3>
                            <p class="category-post-p"><?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description);
                            echo substr($description, 0, 320) . "..."; ?>
                            </p>
                            <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
                            <h4><span><i class="fa-solid fa-list"></i></span><?php echo $category_name; ?></h4>
                            <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
                            <a href='single-blog.php?id=<?php echo $post_id; ?>'> Read more</a>


                        </div>

                    </div>
                    <hr class="margin-hr">

                    <?php
                }
            } else {
                echo "<p>No posts found for this category.</p>";
            }
            ?>

        </div>
    </div>






    <div class="container">
        <div class="row">

            <div class="col-12 related-topics ">
                <h3><span>Related T</span>opics</h3>
            </div>


            <div class="col-12 related-topics-post">
                <!-- Post 1 -->


                <?php
                $category_ids = $_GET['category_id'];

                // Sanitize input to ensure it's an integer
                $category_ids = intval($category_ids);

                // Create the SQL query to select the latest 4 posts by category
                $select_postss = "
    SELECT * 
    FROM all_post
    LEFT JOIN category ON all_post.category = category.category_id
    LEFT JOIN registration ON all_post.author = registration.id
    WHERE category.category_id = $category_ids
    ORDER BY all_post.post_date DESC
    LIMIT 4
";
                // Execute the query
                $sel_querys = mysqli_query($connection, $select_postss);

                // Check if there are posts for the selected category
                if (mysqli_num_rows($sel_querys) > 0) {
                    while ($fetch = mysqli_fetch_assoc($sel_querys)) {
                        $post_id = $fetch['post_id'];
                        $title = $fetch['title'];
                        $description = $fetch['description'];
                        $category_name = $fetch['category_name'];
                        $post_img = $fetch['post_img'];
                        $author = $fetch['role'];
                        $post_date = $fetch['post_date'];




                        ?>
                        <div class="cate-post">
                            <a href='single-blog.php?id=<?php echo $post_id; ?>'> <img class="cate-post-img"
                                    src="blog_web/upload/<?php echo $post_img; ?>" alt="post-img"></a>
                            <div class="cate-post-col">
                                <h6>Related: <span class="span"><?php echo $category_name; ?></span></h6>
                                <h3 class="cate-post-h3"><?php echo substr($title, 0, 35) . "..."; ?></h3>
                                <p class="cate-post-p"><?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description);
                                echo substr($description, 0, 120) . "..."; ?></p>
                                <div class="cate-tags">
                                    <a class="cate-btn" href='single-blog.php?id=<?php echo $post_id; ?>'>Read More</a>
                                    <div class="cate-icon-div">
                                        <h4 class="cate-icon"><span><i
                                                    class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
                                        <h4 class="cate-icon"><span><i
                                                    class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat similar structure for other posts -->

                        <?php

                    }
                }
                ?>

            </div>
        </div>
    </div>



    <?php
    include('include/footer.php');
    include('include/script.php');
    ?>

</body>

</html>