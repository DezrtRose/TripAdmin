<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_NAME ?> | Control Panel</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url('assets/admin-assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- font Awesome -->
    <link href="<?php echo base_url('assets/admin-assets/css/font-awesome.min.css') ?>" rel="stylesheet"
          type="text/css"/>
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
    <style>
        html, body {
            height: 100%;
        }
    </style>
</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    <?php flash(); ?>
    <div class="header">Sign In</div>
    <form action="<?php echo base_url('admin/index/login') ?>" method="post" class="forms">
        <div class="body bg-gray">
            <div class="form-group">
                <input type="text" name="username" class="form-control required" style="width: 100%!important;" placeholder="User ID"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control required" placeholder="Password"/>
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
        </div>
    </form>
</div>
<!-- jQuery 2.0.2 -->
<script src="<?php echo base_url('assets/admin-assets/js/jquery.min.js') ?>"></script>
<!-- jQuery validate -->
<script src="<?php echo base_url('assets/admin-assets/js/jquery.validate.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/admin-assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- custom js -->
<script src="<?php echo base_url('assets/admin-assets/js/custom.js') ?>" type="text/javascript"></script>
</body>
</html>