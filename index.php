<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 12/21/20
 * Time: 1:16 PM
 */

require_once 'config/core.php';

if (is_login()){
    redirect(base_url('dashboard.php'));
    return;
}

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = $db->query("SELECT * FROM ".DB_PREFIX."admin WHERE username='$username' and password='$password'");
    $rs = $sql->fetch(PDO::FETCH_ASSOC);

    if ($sql->rowCount() == 0){
        set_flash("Invalid login details entered","danger");
    }elseif ($rs['role'] != 1){
        set_flash("Access denied","danger");
    }else{
        $rs['password'] = 'xxx';
        $_SESSION['loggedin'] = true;
        $_SESSION[USER_SESSION_HOLDER] = $rs;
        redirect(base_url('dashboard.php'));
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= HTML_TEMPLATE ?>plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="icon" href="<?= image_url('logo.png') ?>">

    <style>
        .form-control{
            height: 45px;
            border-radius: 5px;
        }
    </style>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition" style="background: #f5f5f5;">

<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url() ?>"><img src="<?= image_url('logoOriginal2.png') ?>" alt=""></a>
    </div>
    <!-- /.login-logo -->
    <div class="box box-primary" style="box-shadow: 2px 2px 2px 0 rgba(0,0,0, 0.1)">
        <div class="box-header  with-border">
            <h5 class="box-title">Account Login</h5>
        </div>

        <div class="box-body">
            <?php flash(); ?>
            <form  method="post">
                <div class="form-group has-feedback">
                    <label for="">Username</label>
                    <input type="text" class="form-control" required name="username" placeholder="Username">
                </div>
                <div class="form-group has-feedback">
                    <label for="">Password</label>
                    <input type="password" class="form-control" required name="password" placeholder="Password">
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= HTML_TEMPLATE ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= HTML_TEMPLATE ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= HTML_TEMPLATE ?>plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>