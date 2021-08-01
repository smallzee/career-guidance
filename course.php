<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-08-01
 * Time: 14:25
 */

$page_title = "Course";
require_once 'config/core.php';

if (isset($_POST['add'])){
    $name = strtolower($_POST['name']);

    if (empty($name)){
        $error[] = "Course name is required";
    }

    $sql = $db->query("SELECT * FROM ".DB_PREFIX."course WHERE name='$name'");

    if ($sql->rowCount() >= 1){
        $error[] = "Course name has already exist";
    }

    $error_count = count($error);

    if ($error_count == 0){

        $in = $db->query("INSERT INTO ".DB_PREFIX."course (name)VALUES('$name')");

        set_flash("Course has been added successfully","info");

    }else{
        $msg = ($error_count == 1) ? 'An error occurred': 'Some error(s) occurred';
        foreach ($error as $value){
            $msg.='<p>'.$value.'</p>';
        }
        set_flash($msg,'danger');
    }
}

require_once 'libs/head.php';
?>

<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                <h4 id="myModalLabel" class="modal-title">Add Course</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post">

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Name" id="">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit" name="add" id="">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php  flash() ?>

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

                    <a href="#" class="btn btn-primary mb-20" data-target="#myModal" data-toggle="modal">Add New Course</a>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                    $i=1;
                                    $sql = $db->query("SELECT * FROM ".DB_PREFIX."course ORDER BY name");
                                    while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= ucwords($rs['name']) ?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'libs/foot.php'?>
