<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog website</title>
    <?php
    include('include/css.php');
    ?>

</head>

<body>

    <?php
    include('include/header.php');
    ?>


    <div class="container">

        <?php
        require('connection.php');

        // Get the post ID from the URL
        $post_id = $_GET['id'];

        // Create the SQL query to select the specific post
        $select3 = "SELECT * FROM `all_post` 
            LEFT JOIN `category` ON all_post.category = category.category_id
            LEFT JOIN `registration` ON all_post.author = registration.id
            WHERE all_post.post_id = $post_id";

        // Execute the query
        $sel_query = mysqli_query($connection, $select3);


        // Check if the query was successful and fetch the post
        if ($fetch = mysqli_fetch_assoc($sel_query)) {
            $title = $fetch['title'];
            $description = $fetch['description'];
            $category = $fetch['category_name'];
            $post_date = $fetch['post_date'];
            $author = $fetch['role'];
            $author_person = $fetch['author'];
            $post_img = $fetch['post_img'];
            ?>

                    <div class="row  pag-child margi single-post single_img sin-res upd-div">
                        <div class="col-lg-8 col-md-12 col-sm-12 pag-coll single-post-chil">
                            <img src="blog_web/upload/<?php echo $post_img; ?>" alt="post-5">
                            <h2 class="single-post-chil-h2"><?php echo $title; ?></h2>
                            <p><?php echo $description; ?> </p>
                            <h4 class="single_icn"><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
                            <h4 class="single_icn"><span><i class="fa-solid fa-list"></i></span><?php echo $category; ?></h4>
                            <h4 class="single_icn"><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
                        </div>
                        <!-- /////////////////////  upd  -->

                        <?php
                } else {
                    echo "<div>No post found!</div>";
                }
                ?>


                    <!-- marque-tag  class nikali hay-->
                    <div class=" col-lg-4 col-md-12 col-sm-12 upd-recent-post">
                        <h3>Recent Posts</h3>

                        <marquee class="marque-tag marque-height" direction="down" behavior="alternate" scrollamount="4">
                            <!-- Static example posts -->

                            <?php
                            if (isset($category)) {

                                $selects = "SELECT * FROM `all_post` 
                                        LEFT JOIN `category` ON all_post.category = category.category_id
                                        LEFT JOIN `registration` ON all_post.author = registration.id
                                        WHERE category.category_name = '$category'
                                            ORDER BY all_post.post_date DESC LIMIT 7";


                                // Execute the query
                                $sel_querys = mysqli_query($connection, $selects);
                                // Check if the query was successful and fetch the post
                            

                                if ($sel_querys && mysqli_num_rows($sel_querys) > 0) {
                                    while ($fetch = mysqli_fetch_assoc($sel_querys)) {
                                        $post_id = $fetch['post_id'];
                                        $title = $fetch['title'];
                                        $description = $fetch['description'];
                                        $category_name = $fetch['category_name'];
                                        $post_img = $fetch['post_img'];
                                        $author = $fetch['role'];
                                        $post_date = $fetch['post_date'];




                                        ?>

                                        <div class="col-12 col-lg-12 mar res-pos-div">
                                            <div class="row">
                                                <div class="col-6 col-lg-5 col-md-12 col-sm-12 ">
                                                    <a class="mar_anc2" href='single-blog.php?id=<?php echo $post_id; ?>'>
                                                        <img class="post_img imgg_recent upd-img" src="blog_web/upload/<?php echo $post_img; ?>"
                                                            alt="post-image">
                                                    </a>
                                                </div>
                                                <div class="col-6 col-lg-7 col-md-12 col-sm-12 marcol-2">
                                                    <h3 class="upd-h"><?php echo substr($title, 0, 70) . "..."; ?></h3>
                                                    <p class="upd-p">
                                                        <?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description);
                                                        echo substr($description, 0, 100) . "..."; ?>
                                                    </p>
                                                    <a class="mar_anc" href='single-blog.php?id=<?php echo $post_id; ?>'>Read more

                                                    </a>
                                                </div>
                                            </div>
                                        </div>


                                        <?php
                                    }
                                } else {
                                    // No recent posts found
                                    echo "<div>No recent posts available.</div>";
                                }
                            }

                            ?>


                            <!-- Add more static posts here as needed -->

                        </marquee>
                    </div>
                </div>



        <!-- ////////////////////////// upd -->

    </div>


    <?php
    include('include/footer.php');
    include('include/script.php');
    ?>

</body>

</html>