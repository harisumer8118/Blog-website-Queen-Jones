<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3 dash-logo"><img src="../images/Vector-logo.png" alt="logo.png"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <!-- <i class="fas fa-fw fa-chart-area"></i> -->
            <span>All Post</span></a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="add_post.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Add Post</span></a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="pendingpost.php">
            <!-- <i class="fas fa-fw fa-chart-area"></i> -->
            <span>Pending Post</span></a>
    </li>

    <?php if ($_SESSION["role"] == 'admin' || $_SESSION["role"] == 'moderator') { ?>
        <li class="nav-item">
            <a class="nav-link" href="category.php">
                <!-- <i class="fas fa-fw fa-chart-area"></i> -->
                <span>Category</span></a>
        </li>
        <?php } ?>

        <?php if ($_SESSION["role"] == 'admin') { ?>
            <li class="nav-item">
            <a class="nav-link" href="user.php">
                <!-- <i class="fas fa-fw fa-chart-area"></i> -->
                <span>Pending Users</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="all_user.php">
                <!-- <i class="fas fa-fw fa-chart-area"></i> -->
                <span>All Users</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="feature_post.php">
                <!-- <i class="fas fa-fw fa-chart-area"></i> -->
                <span>Featured posts</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="subscriber.php">
                <!-- <i class="fas fa-fw fa-chart-area"></i> -->
                <span>Subscriber</span></a>
        </li>
    <?php } ?>




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Addons
    </div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
            <a class="nav-link" href="category.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Category</span></a>
        </li> -->


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!
        </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> -->

</ul>
<!-- End of Sidebar -->