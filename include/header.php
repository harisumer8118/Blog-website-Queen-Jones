<div class="container-fluid row-1">
  <div class="container wrapper">
    <div class="row new-logo-row">
      <div class="col-3 col-lg-3 col-md-12 col-sm-12 float-md-end  row-1-col-1">
        <a href="https://blogoria.elite-group.com.pk/"> <img src="images/Vector-logo.png" class="logo-img" alt="logo"></a>
      </div>
      <!-- ///////////////////////  sidebar nav   / -->
<!-- side-bar -->
<div id="sidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn clz" onclick="toggleSidebar()">&times;</a>

        <ul class="row-1-col-4-ul  ">
        <?php
        require ('connection.php');

        $select = "SELECT category_id, category_name FROM category";
        $sel_query = mysqli_query($connection, $select) or die("Query failed");

        if (mysqli_num_rows($sel_query) > 0) {
          while ($row = mysqli_fetch_assoc($sel_query)) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            echo "<li class='item'><a href='category_post.php?category_id=$category_id'>$category_name</a></li>";
          }
        }
        ?>

      </ul>

    </div>
    <div id="main">
        <button id="openbtn" class="openbtn" onclick="toggleSidebar()">☰</button>
    </div>


      <!-- side-bar -->


      <!-- ///////////////////////  sidebar nav  end / -->


      <!-- <div class="col-6 col-lg-7   col-md-12 col-sm-12 float-md-start row-1-col-2">
        <nav class="navbar navbar-expand-lg bg-body-tertiary row-col-1-nav">
          <div class="container-fluid nav-container-fluid">
            <button class="navbar-toggler nav-tog" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa-solid fa-bars line-icon"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav nav-1 row-1-col-2-ul">
                <li class="nav-item nav-ul-li">
                  <a class="nav-link active nav-ul-li-a" class="font-sm" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item nav-ul-li">
                  <a class="nav-link active nav-ul-li-a" class="font-sm" aria-current="page" href="about.php">About
                    us</a>
                </li>
                <li class="nav-item nav-ul-li">
                  <a class="nav-link active nav-ul-li-a" class="font-sm" aria-current="page"
                    href="declaimer.php">Disclaimer</a>
                </li>
                <li class="nav-item nav-ul-li">
                  <a class="nav-link active nav-ul-li-a" class="font-sm" aria-current="page"
                    href="privacy-police.php">Privacy Policy</a>
                </li>
                <li class="nav-item nav-ul-li">
                  <a class="nav-link active nav-ul-li-a" class="font-sm" aria-current="page" href="contact.php">Contact
                    us</a>
                </li>

              </ul>
            </div>
          </div>
        </nav>
      </div> -->
      <div class="col-5 col-lg-4 col-md-12 col-sm-12  row-1-col-3">
        <a href="blog_web/login.php" target="blank"><button type="button" class="btn btn-outline-secondary nav-btn-1">Login</button></a>
        <a href="blog_web/registration.php" target="blank"><button type="button" class="btn btn-outline-secondary nav-btn-2">Get Started for Free</button></a>
      </div>
    </div>
  </div>
  <!-- //////////////////////// -->
  <div class="col-12 row-1-col-4 ">

    <button id="prevButton" class="carousel-nav preww"><i class="fa-solid fa-chevron-left "></i></button>
    <div class="container   cara">



      <ul class="row-1-col-4-ul owl-carousel ">
        <?php
        require ('connection.php');

        $select = "SELECT category_id, category_name FROM category";
        $sel_query = mysqli_query($connection, $select) or die("Query failed");

        if (mysqli_num_rows($sel_query) > 0) {
          while ($row = mysqli_fetch_assoc($sel_query)) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            echo "<li class='item'><a href='category_post.php?category_id=$category_id'>$category_name</a></li>";
          }
        }
        ?>

      </ul>

    </div>
    <button id="nextButton" class="carousel-nav neext"><i class="fa-solid fa-chevron-right "></i></button>


  </div>

  <!-- ///////////////////// -->

  <!-- /////////////////// -->

  <div class="container">


    <div class="col-12 container-2-col-1">
      <h1>Blogging Website</h1>
      <h4>All over types blogs & comments...</h4>

      <div class="col-4 col-lg-4 col-md-6 col-sm-8 container-2-col-1-col">
        <input type="search" id="search-input" placeholder="Search" onkeyup="searchPosts()">
        <button type="button" id="search-button"><i class="fa-solid fa-magnifying-glass icon"></i></button>

        <div id="search-results" class="dropdown-menu"></div>
      </div>

      <!-- <div class="col-4 col-lg-4 col-md-6 col-sm-8 container-2-col-1-col">
        <input type="search" id="search-input" placeholder="Search" onkeyup="searchPosts()">
        <button type="button" id="search-button"><i class="fa-solid fa-magnifying-glass icon"></i></button>
      </div>
      <div id="search-results"></div> -->

    </div>


    <!-- <script>
      function searchPosts() {
        var query = document.getElementById('search-input').value;
        var resultsContainer = document.getElementById('search-results');

        if (query.length < 1) {
          resultsContainer.innerHTML = '';
          return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'search.php?query=' + encodeURIComponent(query), true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            resultsContainer.innerHTML = xhr.responseText;
          }
        };
        xhr.send();
      }
    </script> -->


    <script>
function searchPosts() {
  var query = document.getElementById('search-input').value;
  var resultsContainer = document.getElementById('search-results');

  if (query.length < 1) {
    resultsContainer.innerHTML = '';
    resultsContainer.style.display = 'none';
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'search.php?query=' + encodeURIComponent(query), true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      resultsContainer.innerHTML = xhr.responseText;
      resultsContainer.style.display = 'block';
    }
  };
  xhr.send();
}

document.addEventListener('click', function(event) {
  if (!event.target.closest('.container-2-col-1-col')) {
    document.getElementById('search-results').style.display = 'none';
  }
});
</script>




  </div>

</div>