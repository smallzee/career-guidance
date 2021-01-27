<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 12/21/20
 * Time: 3:13 PM
 */

$page_title = "All Staffs";
require_once 'config/core.php';
if (isset($_POST['add'])){
    $username = $_POST['username'];
    $password = $username;
    $fname = $_POST['fname'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (empty($username) or empty($fname) or empty($role)){
        $error[]= "All field(s) are required";
    }

    $sql = $db->query("SELECT * FROM ".DB_PREFIX."admin WHERE username='$username' and phone='$phone' and email='$email'");
    if ($sql->rowCount() >= 1){
        $error[] = "Staff id or email or phone number has already exist";
    }

    if (strlen($phone) != 11){
        $error[] = "Invalid phone number entered, it should be exactly 11 numbers";
    }

    if (!is_numeric($phone)){
        $error[] = "Invalid phone number format, it should be only digit number";
    }

    if (!empty($email) && !checkemail($email)){
        $error[] = "Invalid email address entered";
    }

    $error_count = count($error);
    if ($error_count == 0){

        $in = $db->query("INSERT INTO ".DB_PREFIX."admin (username,fname,role,password,phone,email)VALUES('$username','$fname','$role','$password','$phone','$email')");

        set_flash("Staff has been added successfully","info");

    }else{
        $msg = ($error_count == 1) ? 'An error occurred' : 'Some error(s) occurred';
        foreach ($error as $value){
            $msg.='<p>'.$value.'</p>';
        }
        set_flash($msg,'danger');
    }
}
require_once 'libs/head.php';
?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Staff</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Staff Id</label>
                                <input type="text" class="form-control" required placeholder="Staff Id" name="username" id="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Staff Name</label>
                                <input type="text" class="form-control" required placeholder="Staff Name" name="fname" id="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control" required placeholder="Email Address" id="">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="phone" name="phone" class="form-control" required placeholder="Phone Number" id="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="add" class="btn btn-primary btn-sm" value="Submit" id="">
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $page_title ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">


                    <button type="button" class="btn btn-default mb-20" data-toggle="modal" data-target="#modal-default">
                        Add New Staff
                    </button>

                    <?php flash(); ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="example1">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Staff Id</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Staff Id</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Created At</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $sql = $db->query("SELECT a.* FROM ".DB_PREFIX."admin a 
                               ORDER BY a.id DESC");
                                while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <tr>
                                        <td><?= $sn++ ?></td>
                                        <td><?= $rs['username'] ?></td>
                                        <td><?= $rs['fname'] ?></td>
                                        <td><?= $rs['email'] ?></td>
                                        <td><?= $rs['phone'] ?></td>
                                        <td><?= $rs['created_at'] ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->

                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<?php require_once 'libs/foot.php'?>
