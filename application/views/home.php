<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UY VIỆT</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/ionicons.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lte/dist/css/AdminLTE.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/lte/dist/css/skins/_all-skins.min.css'); ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url('assets/lte/plugins/iCheck/all.css'); ?>">
    <!-- custom select css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-customselect-1.9.1.css'); ?>">
    <!-- font roboto 400 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/roboto.css'); ?>">
    <!-- Swiper css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/swiper.min.css'); ?>">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <!-- toast notic -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css'); ?>" />
</head>

<body class="hold-transition skin-blue-light sidebar-mini main">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="./" class="logo" style="color: #2090CB; background: white;">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>U</b>V</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"> <center><img src="assets/images/logo.png" width="100px"></center></span>
            </a>

            <!-- Header Navbar -->
            <div id="search">
                <button type="button" class="btn btn-primary"><span class="fa fa-map-marker fa-2x"></span>
                </button>
            </div>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="row">
                    <form class="row form-select">

                        <div class="col-sm-12 group-list-drop-down">
                            <div class="form-group col-sm-1 btn-search-max">
                                <button type="button" style="width: 100%;"><span class="fa fa-search"></span>
                                </button>
                            </div>
                            <div class="form-group col-sm-2 list-drop-down">
                                <label class="col-sm-2 control-label" for="">Công Ty</label>
                                <div class="col-sm-10" id="company">
                                    <?php echo $select_company; ?>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 list-drop-down">
                                <label class="col-sm-2 control-label" for="">Tỉnh / Thành Phố</label>
                                <div class="col-sm-10" id="province">
                                    <?php echo $select_province; ?>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 list-drop-down">
                                <label class="col-sm-2 control-label" for="">Quận / Huyện</label>
                                <div class="col-sm-10" id="district">
                                    <select id='standard' name='standard' class='custom-select form-control'>
                                        <option value='0'>Tất cả</option>
                                    </select>
                                    <span><i class="fa fa-caret-right"></i></span>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 list-drop-down">
                                <label class="col-sm-2 control-label" for="">Xã / Phường / Thị Trấn</label>
                                <div class="col-sm-10" id="ward">
                                    <select id='standard' name='standard' class='custom-select form-control'>
                                        <option value=''>Tất cả</option>
                                    </select>
                                    <span><i class="fa fa-caret-right"></i></span>
                                </div>
                            </div>

                            <div class="form-group col-sm-1 btn-search-min">
                                <button type="button"><span class="fa fa-search"></span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </nav>

        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" id="search-str" class="form-control" placeholder="..." required="">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header text-center">MAIN NAVIGATION</li>

                    <li class="active treeview multi-selection">
                        <a href="#">
                            <i class="fa fa-bookmark-o"></i> <span><?php echo $shop_type["display_name"]; ?></span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php foreach ($shop_type["value"] as $key => $value) if($value->status == 1) {
                                ?>
                            <li class="condition" condition="<?php echo $shop_type['name']; ?>" data="<?php echo $value->id; ?>"><a href="#" style="border-color: green;"><span><img src="<?php echo base_url($value->icon_url); ?>"></span><?php echo $value->type; ?></a>
                            </li>
                                <?php
                            } ?>
                        </ul>
                    </li>
                    <?php foreach ($sidebar as $key => $option) {
                        ?>

                    <li class="active treeview single-selection">
                        <a href="#">
                            <i class="fa fa-bookmark-o"></i> <span><?php echo $option["display_name"]; ?></span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php foreach ($option["value"] as $key => $value) {
                                ?>
                            <li class="condition" condition="<?php echo $option['name']; ?>" data="<?php echo $value->id; ?>"><a style="border-color: <?php echo $value->color; ?>;" href="#"><?php echo $value->type; ?></a>
                            </li>
                                <?php
                            } ?>
                        </ul>
                    </li>


                        <?php
                    }
                    ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div id="map" style="overflow: hidden; position: absolute">
                    Map google here
                </div>
                <!-- Your Page Content Here -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->




    <div class="modal fade" id="myModalSearch" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="grid condensed">
                    <div class="modal-body row" style="padding: 0;">
                        <div class="col-xs-12">
                            <div class="swiper-container swiper-container-h">
                                <div class="swiper-wrapper">
                                
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination swiper-pagination-h"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loader"><img src="<?php echo base_url('assets/images/ajax-loader.gif') ?>"></div>

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3 -->
    <script type="text/javascript" src="<?php echo base_url('assets/lte/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/lte/dist/js/app.min.js'); ?>"></script>

    <!-- custom select -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-customselect-1.9.1.min.js'); ?>"></script>
    <!-- Swiper js -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/swiper.min.js'); ?>"></script>
    <!-- Icons js -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/icons.js'); ?>"></script>
    <!-- font awesome icon for marker -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/fontawesome-markers.min.js'); ?>"></script>
    <!-- config js -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/config.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/js/toastr.min.js'); ?>"></script>
    <!-- Google api -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCUH_5LKkKhglGrWjvxIVtpyzvrJ2mDyyk&sensor=false"></script>


    <script type="text/javascript">
        var map_icon = {
            <?php foreach ($sidebar as $key => $option) {
                ?>
            <?php echo $option["name"] ?> : { <?php  foreach ($option["value"] as $key => $value) { ?> <?php echo $value->id; ?> : "<?php echo $value->color; ?>", <?php } ?> },

                <?php
            } ?>

            <?php echo $shop_type["name"]; ?> : { <?php foreach ($shop_type["value"] as $key => $value) { ?> <?php echo $value->id; ?> : "<?php echo $value->icon_url; ?>", <?php } ?>

            }
        };

        var select = {<?php foreach ($shop_type["value"] as $key => $value) {
            echo $value->id . " : false,";
        } ?>};

    </script>
    <script type="text/javascript">
        var edit_link = "<?php echo $edit_link; ?>";
        $(function() {
            
            flag = true;

            //button menu when reponsive
            $("#search > button").click(function() {
                $(".form-select").toggle(500);
            });
            $(window).resize(function() {
                var win = $(this);
                //alert(win.width());
                if (win.width() >= 767) {
                    $(".form-select").show();
                } else {
                    $(".form-select").hide();
                }
            });

        });
    </script>
    <?php 
    if($this->session->userdata("user") && $this->session->userdata("user")->type < VIEW) {
        $this->view("admin/layout/temp/update_location"); 
        ?>
    <script type="text/javascript">
        $(function() {
            $("#modal-edit form").append($("<input type='hidden' name='url' value='" + window.location.href  + "'>"));
        });
    </script>
        <?php
    }
    ?>
    <!-- main script -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>

</html>