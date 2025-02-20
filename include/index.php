<?php

require ('connection.php');



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Queen jones</title>
  <?php
  include ('include/css.php');
  ?>
</head>

<body>

  <?php
  include ('include/header.php');
  ?>

  <?php
  $select = "
    SELECT * 
    FROM `all_post`
    LEFT JOIN `category` ON all_post.category = category.category_id
    LEFT JOIN `registration` ON all_post.author = registration.id 
    ORDER BY RAND()
    LIMIT 1
";

  $sel_query = mysqli_query($connection, $select);

  if ($fetch = mysqli_fetch_assoc($sel_query)) {
    $post_id = $fetch['post_id'];
    $title = $fetch['title'];
    $description = $fetch['description'];
    $category = $fetch['category_name'];
    $post_date = $fetch['post_date'];
    $author = $fetch['role'];
    $author_person = $fetch['author'];
    $post_img = $fetch['post_img'];
    ?>



    <div class="container grid-con">
      <div class="row margin-none">
        <div class="col-8 col-lg-8 col-md-12 col-sm-12 row-2-col-1 float-start">
          <h2><span>Popular P</span>osts</h2>
          <img class="post_img" src="blog_web/upload/<?php echo $post_img; ?>" alt="post-image">
          <h3><?php echo $title; ?></h3>
          <p><?php echo substr($description, 0, 280) . "..."; ?></p>
          <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
          <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>


          <?php
  }

  ?>
        <div class="col-12 row-2-col-1-pa">





          <!-- // Fetch a single test post -->
          <?php
          $select1 = "SELECT * FROM all_post 
               LEFT JOIN `category` ON all_post.category = category.category_id
               LEFT JOIN `registration` ON all_post.author = registration.id 
               LIMIT 1";

          $sel_query = mysqli_query($connection, $select1);

          if ($fetch = mysqli_fetch_assoc($sel_query)) {
            $post_id = $fetch['post_id'];
            $title = $fetch['title'];
            $description = $fetch['description'];
            $category = $fetch['category_name'];
            $post_date = $fetch['post_date'];
            $author = $fetch['role'];
            $author_person = $fetch['author'];
            $post_img = $fetch['post_img'];
            ?>
            <div class="col-6 row-2-col-1-cil-1"
              style="background-image: url('blog_web/upload/<?php echo $post_img; ?>');">
              <h3><?php echo substr($description, 0, 50) . "..."; ?></h3>
              <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
              <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
            </div>
            <?php
          } else {
            echo "<p>No posts found.</p>";
          }
          ?>





          <?php
          $select1 = "SELECT * FROM all_post 
           LEFT JOIN category ON all_post.category = category.category_id
           LEFT JOIN registration ON all_post.author = registration.id 
           LIMIT 1 OFFSET 1"; // Fetch the second post by skipping the first one
          
          $sel_query = mysqli_query($connection, $select1);

          if ($fetch = mysqli_fetch_assoc($sel_query)) {
            $post_id = $fetch['post_id'];
            $title = $fetch['title'];
            $description = $fetch['description'];
            $category = $fetch['category_name'];
            $post_date = $fetch['post_date'];
            $author = $fetch['role'];
            $author_person = $fetch['author'];
            $post_img = $fetch['post_img'];
            ?>
            <div class="col-6 row-2-col-1-cil-1"
              style="background-image: url('blog_web/upload/<?php echo $post_img; ?>');">
              <h3><?php echo substr($description, 0, 50) . "..."; ?></h3>
              <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
              <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
            </div>
            <?php
          } else {
            echo "<p>No posts found.</p>";
          }
          ?>>
          <!-- <div class="col-6 row-2-col-1-cil-1 cil-2">
            <h3>Finch Zoom PUTS Stock: Revolutionizing
              Finance With Innovation & Opportunitys</h3>
            <h4><span><i class="fa-solid fa-user"></i></span>Travis</h4>
            <h4><span><i class="fa-regular fa-calendar-days"></i></span>12 apr 2024</h4>
          </div> -->



        </div>
      </div>
      <div class="col-4 col-lg-4 col-md-8 col-sm-12 float-end grid-con-col-2 ">
        <div class="col-12 grid-con-col-2-col ">
          <h3>Subscribe to our blog</h3>
          <p>To get the latest and most quality design resources!</p>
          <input type="email" placeholder="Email Address" class="ppp">
          <button type="submit" class="hov">Sign me up</button>
        </div>
        <div class="col-12 cate">
          <select class="form-select" aria-label="Default select example">
            <option selected>Category</option>
            <option value="1">Groceries</option>
            <option value="2">Health & Beauty</option>
            <option value="3">Men’s Fashion</option>
            <option value="3">Women’s Fashion</option>
            <option value="3">Mother Baby</option>
            <option value="3">Home & Lifestyles</option>
            <option value="3">Electronic Devices</option>
            <option value="3">Electronic Accessories</option>
            <option value="3">Sports & Outdoor</option>
            <option value="3">Watches, Bags & Jewelry</option>
          </select>
          <h3>Recent Posts</h3>
        </div>
        <marquee behavior="" direction="down" height="500px">
          <div class="col-12 col-lg-12 mar">
            <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"> <img src="images/image 6.png" alt="marquee"></div>
            <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
              <h3>6 Classic Chinese Foods You Need to Taste</h3>
              <p>Explore six traditional Chinese meals that are a must-try for any food aficionado as you explore the
                vibrant and varied flavors of Chinese cuisine. Every meal ....
              </p>
              <a href="#">Read more</a>
            </div>
          </div>
          <div class="col-12 mar">
            <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"> <img src="images/image 7.png" alt="marquee"></div>
            <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
              <h3>Future Health Software:
                Revolutionizing Healthcare</h3>
              <p>In recent years, advancements in technology have revolutionized various industries, and healthcare is
                no exception. The integration of software solutio...

              </p>
              <a href="#">Read more</a>
            </div>
          </div>
          <div class="col-12 mar">
            <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"> <img src="images/image 10.png" alt="marquee"></div>
            <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
              <h3>Future Health Software:
                Revolutionizing Healthcare</h3>
              <p>In recent years, advancements in technology have revolutionized various industries, and healthcare is
                no exception. The integration of software solutio...

              </p>
              <a href="#">Read more</a>
            </div>
          </div>
          <div class="col-12 mar">
            <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"> <img src="images/image 11.png" alt="marquee"></div>
            <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
              <h3>Future Health Software:
                Revolutionizing Healthcare</h3>
              <p>In recent years, advancements in technology have revolutionized various industries, and healthcare is
                no exception. The integration of software solutio...

              </p>
              <a href="#">Read more</a>
            </div>

            <div class="col-12 col-lg-12 mar">
              <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"> <img src="images/image 7.png" alt="marquee"></div>
              <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
                <h3>6 Classic Chinese Foods You Need to Taste</h3>
                <p>Explore six traditional Chinese meals that are a must-try for any food aficionado as you explore the
                  vibrant and varied flavors of Chinese cuisine. Every meal ....

                </p>
                <a href="#">Read more</a>
              </div>
            </div>
            <div class="col-12 col-lg-12 mar">
              <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"> <img src="images/image 6.png" alt="marquee"></div>
              <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
                <h3>6 Classic Chinese Foods You Need to Taste</h3>
                <p>Explore six traditional Chinese meals that are a must-try for any food aficionado as you explore the
                  vibrant and varied flavors of Chinese cuisine. Every meal ....

                </p>
                <a href="#">Read more</a>
              </div>
            </div>
        </marquee>
      </div>
    </div>
  </div>
  </div>














  <!-- pagination-1   to blow this div -->











  <div class="container  ">
    <div class="row pag">



      <?php
      $limit = 2;

      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $offset = ($page - 1) * $limit;


      $select3 = "SELECT * FROM `all_post` 
LEFT JOIN `category` ON all_post.category = category.category_id
LEFT JOIN `registration` ON all_post.author = registration.id 
ORDER BY all_post.post_id DESC LIMIT {$offset}, {$limit}";


      $sel_query = mysqli_query($connection, $select3);
      if (mysqli_num_rows($sel_query) > 0) {

        while ($fetch = mysqli_fetch_assoc($sel_query)) {
          $post_id = $fetch['post_id'];
          $title = $fetch['title'];
          $description = $fetch['description'];
          $category = $fetch['category_name'];
          $category_post = $fetch['post'];
          $post_date = $fetch['post_date'];
          $author = $fetch['role'];
          $author_person = $fetch['author'];
          $post_img = $fetch['post_img'];
          ?>





          <div class="col-6  col-lg-6 col-md-12 col-sm-12  pag-child margi">
          <a href='single-blog.php?id=<?php echo $post_id; ?>'> <img class="width-img-height" src="blog_web/upload/<?php echo $post_img; ?>" alt="post-img"></a>
            <div class="col-12 pag-col">
            <h3><?php echo substr($title, 0, 55) . "..."; ?></h3>
              <p><?php echo substr($description, 0, 280) . "..."; ?> </p>
              <h4><span><i class="fa-solid fa-user"></i></span><?php echo  $author ; ?></h4>
              <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo  $post_date ; ?></h4>
              <a href='single-blog.php?id=<?php echo $post_id; ?>'> Read more</a>

            </div>
          </div>

        <?php
        }
      }else{
        echo "<h2>No Recordes Found. </h2>";
      }
      ?>


      <div class="col-12 pag-col-2">

      <?php
        $select1 = "SELECT * FROM `all_post`";
        $sel_query1 = mysqli_query($connection, $select1);

        if (mysqli_num_rows($sel_query1) > 0) {

            $total_record = mysqli_num_rows($sel_query1);
            // $limit = "3";
            $total_pages = ceil($total_record / $limit);

            echo ' <ul class="pagination">';

            if ($page > 1) {
                echo '<li class="page-item ">
                            <a class="page-link" href="index.php?page=' . ($page - 1) . '" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            </a>
                  </li>';

            }
            for ($i = 1; $i <= $total_pages; $i++) {

                // echo ' <li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                echo ' <li class="page-item active">' . $i . '</li>';

            }

            if ($total_pages > $page) {
                echo '<li class="page-item ">
                            <a class="page-link" href="index.php?page=' . ($page + 1) . '" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            </a>
                      </li>';

            }

            echo ' </ul>';


        }


        ?>
        <!-- <ul>
          <li>Page: </li>
          <li><i class="fa-solid fa-chevron-left left-icon"></i></li>
          <li>1</li>
          <li>to</li>
          <li>30</li>

          <li><i class="fa-solid fa-chevron-right left-icon"></i></li>
        </ul> -->
        <a href="#">Older Post</a>
      </div>
    </div>

  </div>
  <?php
  include ('include/footer.php');
  include ('include/script.php');
  ?>

</body>

</html>