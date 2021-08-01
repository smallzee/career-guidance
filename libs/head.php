<?php
    if (!is_login()){
        redirect(base_url());
        return;
    }
    $name = admin_details('fname');
    $sn =1;

    $subject_data = array();

    $subject_sql = $db->query("SELECT * FROM ".DB_PREFIX."subject ORDER BY name");
    while ($sub = $subject_sql->fetch(PDO::FETCH_ASSOC)){
        $subject_data[] = $sub;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta property="og:locale" content="en_US">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title><?= page_title(@$page_title); ?></title>
    <!-- Font Awesome -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/morris.js/morris.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>dist/css/css.css">
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>plugins/pace/pace.min.css">
    <link rel="stylesheet" href="<?= HTML_TEMPLATE  ?>dist/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="<?= HTML_TEMPLATE  ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/0.5.0/sweet-alert.css">
    <!-- folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="icon" href="<?= image_url('logo.png') ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?= base_url() ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?= WEB_SUB_TITLE ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?= WEB_TITLE ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= image_url('icon.jpeg') ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= ucwords(admin_details('fname')) ?> (Admin)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= image_url('icon.jpeg') ?>" style="width: 40px; height: 40px;" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= ucwords($name) ?></p>
                    <a href="#"><i class="fa fa-circle text-green"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li >
                    <a href="<?= base_url('dashboard.php') ?>">
                        <i class="fa fa-home text-primary "></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li >
                    <a href="<?= base_url('staff.php') ?>">
                        <i class="fa fa-users text-primary "></i>
                        <span>All Staffs</span>
                    </a>
                </li>

                <li >
                    <a href="<?= base_url('course.php') ?>">
                        <i class="fa fa-book text-primary "></i>
                        <span>Course</span>
                    </a>
                </li>

                <li >
                    <a href="<?= base_url('subject.php') ?>">
                        <i class="fa fa-book text-primary "></i>
                        <span>Subject</span>
                    </a>
                </li>

                <li >
                    <a href="<?= base_url('guidance.php') ?>">
                        <i class="fa fa-book text-primary "></i>
                        <span>Career Guidance</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('department.php') ?>">
                        <i class="fa fa-book text-primary "></i>
                        <span>All Schools &amp; Departments</span>
                    </a>
                </li>


                <li>
                    <a href="<?= base_url('logout.php') ?>">
                        <em class="fa fa-sign-out text-danger"></em>
                        <div class="label label-primary pull-right"></div>
                        <span>Logout</span>
                    </a>
                </li>
                <!-- END Menu-->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $page_title ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url('dashboard.php') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="active"><?= $page_title ?></li>
            </ol>
        </section>

