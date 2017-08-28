<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo site_url("admin/dashboard")?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><h4><b>UV</b></h4></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><h4><b>UY VIỆT</b></h4></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="<?php echo base_url('admin/signout'); ?>">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>