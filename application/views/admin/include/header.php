<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->site_data->title ?> | Control Panel</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url('assets/admin-assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- font Awesome -->
    <link href="<?php echo base_url('assets/admin-assets/css/font-awesome.min.css') ?>" rel="stylesheet"
          type="text/css"/>
    <!-- Ionicons -->
    <link href="<?php echo base_url('assets/admin-assets/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- jQuery UI CSS -->
    <link href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/jquery-ui/jquery-ui.theme.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/admin-assets/css/AdminLTE.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- custom style -->
    <link href="<?php echo base_url('assets/admin-assets/css/style.css') ?>" rel="stylesheet" type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- ckeditor and ckfinder -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin-assets/js/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin-assets/js/plugins/ckfinder/ckfinder.js"></script>

    <!-- jQuery 2.0.2 -->
    <script src="<?php echo base_url('assets/admin-assets/js/jquery.min.js') ?>"></script>
</head>
<body class="skin-blue fixed">
<input type="hidden" value="<?php echo site_url() ?>" id="base_url"/>
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="<?php echo base_url('admin') ?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <?php echo $this->site_data->title ?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <?php $session = $this->session->all_userdata(); ?>
                        <span><?php echo ucfirst($session['username']); ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <p>
                                Welcome - <?php echo ucfirst($session['username']); ?>
                                <small><?php echo date('d M y', time()) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url('admin/config/#admin-config') ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('admin/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">