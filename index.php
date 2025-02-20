<?php

require('connection.php');



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Queen jones</title>
  <?php
  include('include/css.php');
  ?>
</head>

<body>

  <?php
  include('include/header.php');
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
          <div class="row row-2-col-1"> 
           <h2><span>Popular P</span>osts</h2>
          </div>
        <div class="col-8 col-lg-8 col-md-12 col-sm-12 row-2-col-1 float-start">
                   <a href='single-blog.php?id=<?php echo $post_id; ?>'><img class="post_img"
              src="blog_web/upload/<?php echo $post_img; ?>" alt="post-image">
            <h3 style=" color:#000;"><?php echo $title; ?></h3>
            <p style=" color:#000;">
              <?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description);
              echo substr($description, 0, 380) . "..."; ?>
            </p>
            <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
            <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>


            <?php
  }

  ?>
        </a>
        <div class="col-12 row-2-col-1-pa">





          <!-- // Fetch a single test post -->
          <?php
          $select1 = "SELECT * FROM all_post 
LEFT JOIN category ON all_post.category = category.category_id
LEFT JOIN registration ON all_post.author = registration.id 
ORDER BY all_post.post_date DESC
LIMIT 1 OFFSET 1";

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
            <a class="swiper-slide-ancc" href='single-blog.php?id=<?php echo $post_id; ?>'>
              <div class="col-6  row-2-col-1-cil-1"
                style="background-image: url('blog_web/upload/<?php echo $post_img; ?>');">
                <h3><?php echo substr($title, 0, 50) . "..."; ?></h3>
                <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
                <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
              </div>
            </a>
            <?php
          } else {
            echo "<p>No posts found.</p>";
          }
          ?>





          <?php
          $select1 = "SELECT * FROM all_post 
LEFT JOIN category ON all_post.category = category.category_id
LEFT JOIN registration ON all_post.author = registration.id 
ORDER BY all_post.post_date DESC
LIMIT 2 OFFSET 4";

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
            <!-- col-lg-6 col-md-12 col-sm-12 -->
            <a class="swiper-slide-ancc" href='single-blog.php?id=<?php echo $post_id; ?>'>
              <div class="col-6  row-2-col-1-cil-1"
                style="background-image: url('blog_web/upload/<?php echo $post_img; ?>');">
                <h3><?php echo substr($title, 0, 50) . "..."; ?></h3>
                <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
                <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
              </div>
            </a>
            <?php
          } else {
            echo "<p>No posts found.</p>";
          }
          ?>



        </div>
      </div>
      <div class="col-4 col-lg-4 col-md-8 col-sm-12 float-end grid-con-col-2 ">
        <form method="post">
          <div class="col-12 grid-con-col-2-col ">
            <h3>Subscribe to our blog</h3>
            <p>To get the latest and most quality design resources!</p>

            <input type="email" placeholder="Email Address" class="ppp newbtnimp" name="sub_email">
            <!-- <button type="submit" class="hov" name="subscribe">Sign me up</button> -->
            <!-- <input type="hidden" name="posted"> -->
            <!-- <input type="submit" class="hov newbtn" value="Sign me up"> -->
            <!-- <input type="hidden" name="posted"> -->
            <button type="submit" class="hov" name="posted">Sign me up</button>


          </div>
        </form>

        <?php

        if (isset($_POST['posted'])) {

          $sub_email = $_POST['sub_email'];

          $insert = "INSERT INTO subscriber (sub_email) VALUES ('$sub_email')";
          $ins_query = mysqli_query($connection, $insert);

          if ($ins_query) {
            echo '<script> alert("You have subscribed successfully.");   </script>';
          } else {
            echo '<script>alert("Data not inserted.");</script>';
          }


        }

        // } else {
        //   echo '<script>alert("Try again later.");</script>';
        // }
        ?>
        <div class="col-12 cate">

          <select class="form-select" aria-label="Default select example" onchange="location = this.value;">

            <option disabled selected>Select category</option>
            <?php
            $select = "SELECT * FROM `category`";
            $sel_query = mysqli_query($connection, $select) or die("Query failed");
            if (mysqli_num_rows($sel_query) > 0) {
              while ($row = mysqli_fetch_assoc($sel_query)) {
                echo "<option value='category_post.php?category_id={$row['category_id']}'>{$row['category_name']}</option>";
              }
            }
            ?>

          </select>

          <h3>Recent Posts</h3>
        </div>
        <div class="marque-tag-parent new-marquetag col-12">
          <marquee class="marque-tag" behavior="alternate" direction="down" scrollamount="4">
            <?php
            // Assuming you have already established a database connection
            
            $select_queryy = "SELECT * FROM all_post 
                   LEFT JOIN category ON all_post.category = category.category_id
                   LEFT JOIN registration ON all_post.author = registration.id
                   ORDER BY all_post.post_date DESC
                   LIMIT 10";

            $resulty = mysqli_query($connection, $select_queryy);

            if (mysqli_num_rows($resulty) > 0) {
              while ($row = mysqli_fetch_assoc($resulty)) {
                $post_id = $row['post_id'];
                $title = $row['title'];
                $description = $row['description'];
                $post_date = $row['post_date'];
                $category_id = $row['category_id'];
                $post_img = $row['post_img'];

                // Output each post within the marquee
                ?>
                <div class="col-12 col-lg-12 mar">
                  <div class="col-5 col-lg-5 col-md-4 col-sm-3 marcol-1"><a class="mar_anc2"
                      href='single-blog.php?id=<?php echo $post_id; ?>'> <img class="post_img imgg_recent"
                        src="blog_web/upload/<?php echo $post_img; ?>" alt="post-image"></a>
                  </div>
                  <div class="col-7 col-lg-7 col-md-8 col-sm-9 marcol-2">
                    <h3> <a class="mar_anc2"
                        href='single-blog.php?id=<?php echo $post_id; ?>'><?php echo substr($title, 0, 60) . "..."; ?></a>
                    </h3>
                    <p style=" color:#000;">
                      <?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description);
                      echo substr($description, 0, 100) . "..."; ?>
                    </p>
                    <a class="mar_anc" href='single-blog.php?id=<?php echo $post_id; ?>'>Read more</a>
                  </div>
                </div>
                <?php

              }
            } else {
              echo "No posts found.";
            }

            // Close the database connection
            ?>


          </marquee>
        </div>
      </div>
    </div>
  </div>
  </div>



  <!-- ////////           Feature posts  -->


  <div class="container fetured">
    <div class="col-12 featured-heading">
      <h2>Featured Posts</h2>
    </div>


    <div class="col-12">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">

          <?php
          $select5 = "SELECT * FROM all_post 
LEFT JOIN category ON all_post.category = category.category_id
LEFT JOIN registration ON all_post.author = registration.id 
WHERE all_post.feature = 1";

          $sel_query = mysqli_query($connection, $select5);

          while ($fetch = mysqli_fetch_assoc($sel_query)) {
            $post_id = $fetch['post_id'];
            $title = $fetch['title'];
            $reg_id = $fetch['id'];
            $description = $fetch['description'];
            $category = $fetch['category_name'];
            $post_date = $fetch['post_date'];
            $author = $fetch['role'];
            $post_img = $fetch['post_img'];
            ?>

            <div class="swiper-slide">
              <a class="swiper-slide-ancc" href='single-blog.php?id=<?php echo $post_id; ?>'>
                <div class="col-4 row-2-col-1-cil-1 fetured-coll"
                  style="background-image: url('blog_web/upload/<?php echo $post_img; ?>');">
                  <h3><?php echo substr($title, 0, 40) . "..."; ?></h3>
                  <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
                  <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
                </div>
              </a>
            </div>

            <?php
          }
          ?>



        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>


  <!-- feature post ends -->






  <!-- pagination-1   to blow this div -->











  <div class="container index-posts-container ">
    <div class="row pag">


      <?php
      $limit = 3;

      if (isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page <= 0) {
          echo "<script>alert('Invalid page number! Redirecting to the first page.');</script>";
          echo "<script>window.location.href = 'index.php?page=1';</script>";
          exit;
        }
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
          <div class="col-4 col-lg-4 col-md-12 col-sm-12 pag-child margi">
            <a href='single-blog.php?id=<?php echo $post_id; ?>'> <img class="width-img-height"
                src="blog_web/upload/<?php echo $post_img; ?>" alt="post-img"></a>
            <div class="col-12 pag-col">
              <h3 class="pag-col-h3"><?php echo substr($title, 0, 58) . "..."; ?></h3>
              <p class="pag-col-p">
                <?php $description = preg_replace('/<(h\d|p)>(.*?)<\/\1>/', '$2', $description);
                echo substr($description, 0, 215) . "..."; ?>
              </p>
              <h4><span><i class="fa-solid fa-user"></i></span><?php echo $author; ?></h4>
              <h4><span><i class="fa-regular fa-calendar-days"></i></span><?php echo $post_date; ?></h4>
              <a href='single-blog.php?id=<?php echo $post_id; ?>'> Read more</a>
            </div>
          </div>
          <?php
        }
      } else {
        echo "<h2>No Records Found. </h2>";
      }
      ?>

      <div class="col-12 pag-col-2">
        <?php
        $select1 = "SELECT * FROM all_post";
        $sel_query1 = mysqli_query($connection, $select1);

        if (mysqli_num_rows($sel_query1) > 0) {
          $total_record = mysqli_num_rows($sel_query1);
          $total_pages = ceil($total_record / $limit);
          ?>

          <div class="col-12 pagina-olderpost">
            <div class="col-6 pag-col-2">
              <?php
              echo '<ul>';

              // Previous page arrow
              if ($page >= 1) {
                echo '<li class="page-item pal-col-arrow-pagi">
                    <a class="page-link give" href="index.php?page=' . ($page - 1) . '" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                    </a>
                  </li>';
              }

              // Numbered pages or current page indicator with dots
              if ($total_pages <= 7) {
                // If total pages are less than or equal to 7, show all pages
                for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $page) {
                    echo '<li class="page-item"><a class="acti">' . $i . '</a></li>';
                  } else {
                    echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                  }
                }
              } else {
                // If total pages are more than 7, show a more compact pagination
                if ($page <= 4) {
                  for ($i = 1; $i <= 5; $i++) {
                    if ($i == $page) {
                      echo '<li class="page-item"><a class="acti">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                  }
                  echo '<li class="page-item"><a class="page-link">...</a></li>';
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                } elseif ($page > 4 && $page < $total_pages - 3) {
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=1">1</a></li>';
                  echo '<li class="page-item"><a class="page-link">...</a></li>';
                  for ($i = $page - 1; $i <= $page + 1; $i++) {
                    if ($i == $page) {
                      echo '<li class="page-item"><a class="acti">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                  }
                  echo '<li class="page-item"><a class="page-link">...</a></li>';
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                } else {
                  echo '<li class="page-item"><a class="page-link" href="index.php?page=1">1</a></li>';
                  echo '<li class="page-item"><a class="page-link">...</a></li>';
                  for ($i = $total_pages - 4; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                      echo '<li class="page-item"><a class="acti">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                  }
                }
              }

              // Next page arrow
              if ($page <= $total_pages) {
                echo '<li class="page-item">
                    <a class="page-link give" href="index.php?page=' . ($page + 1) . '" aria-label="Next">
                        <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                    </a>
                  </li>';
              }

              echo '</ul>';
        }
        ?>
          </div>

          <div class="col-6  pag-col-2 pag-col-older">
            <!-- <a href="#">Older Post</a> -->
            <a href="index.php?page=<?php echo $total_pages; ?>">Older Post</a>
          </div>
        </div>
      </div>
    </div>

  </div>




  <?php
  include('include/footer.php');
  include('include/script.php');
  include('include/slider-script.php');
  ?>

</body>

</html>