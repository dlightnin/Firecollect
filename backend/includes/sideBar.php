<?php


$user_id = $_SESSION["user_id"];

 ?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- END SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item ">
                    <a href="../fc-admin/dashboard.php" class="nav-link nav-toggle">
                        <i class="material-icons" style="font-size:32px">dashboard</i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="../fc-projects/projects.php" class="nav-link nav-toggle">
                        <i class="fa fa-tasks"></i>
                        <span class="title">Projects</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="../fc-projects/projects.php" class="nav-link ">
                                <span class="title">View Projects</span>
                            </a>
                        </li>

                        <li class="nav-item  ">
                            <a href="../fc-projects/add_project.php" class="nav-link ">
                                <span class="title">Add Projects</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="#view_gallery_modal" data-toggle='modal' class="nav-link ">
                                <span class="title">View Gallery</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item  ">
                    <a href="../fc-projects/data_sets.php" class="nav-link nav-toggle">
                        <i class="fa fa-database"></i>
                        <span class="title">View Data Sets</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="../fc-projects/variables.php" class="nav-link nav-toggle">
                        <i class="fa fa-flask"></i>
                        <span class="title">View Variables</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href='#view_dfs_modal' class="nav-link nav-toggle " data-toggle='modal' >
                        <i class="fa fa-file-o"></i>
                        <span class="title">View Datafiles</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            <!-- END SIDEBAR MENU -->




        </div>
        <!-- END SIDEBAR -->
    </div>

    <!-- END SIDEBAR -->
