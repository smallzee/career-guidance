<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-08-01
 * Time: 14:25
 */

$page_title = "Subject";
require_once 'config/core.php';

if (isset($_POST['add'])){
    $course = $_POST['course'];
    $name = strtolower($_POST['name']);

    if (empty($name) or empty($course)){
        $error[] = "All fields are required";
    }

    $sql = $db->query("SELECT * FROM ".DB_PREFIX."subject WHERE name='$name' and course_id='$course'");

    if ($sql->rowCount() >= 1){
        $error[] = "Subject name has already exist";
    }

    $error_count = count($error);

    if ($error_count == 0){

        $in = $db->query("INSERT INTO ".DB_PREFIX."subject (name,course_id)VALUES('$name','$course')");

        set_flash("Subject has been added successfully","info");

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
                        <label for="">Course</label>
                        <select name="course" id="" required class="form-control">
                            <?php
                            $sql = $db->query("SELECT * FROM ".DB_PREFIX."course ORDER BY name");
                            while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?= $rs['id'] ?>"> <?= ucwords($rs['name']) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="name" required placeholder="Subject" id="">
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

                    <a href="#" class="btn btn-primary mb-20" data-target="#myModal" data-toggle="modal">Add New Subject</a>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Course Name</th>
                                <th>Subject Name</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Course Name</th>
                                <th>Subject Name</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                  $sql = $db->query("SELECT * FROM ".DB_PREFIX."course ORDER BY name");
                                  while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                      ?>
                                      <tr>
                                          <td><?= $sn++ ?></td>
                                          <td><?= ucwords($rs['name']) ?></td>
                                          <td>
                                              <table>
                                                  <?php
                                                  $i=1;
                                                    $course_id = $rs['id'];
                                                    $sql2 = $db->query("SELECT * FROM ".DB_PREFIX."subject WHERE course_id='$course_id'");
                                                    while ($rs2 = $sql2->fetch(PDO::FETCH_ASSOC)){
                                                        ?>
                                                        <tr>
                                                            <td style="padding-bottom: 5px;"><?= $i++.". ". ucwords($rs2['name']) ?></td>
                                                        </tr>
                                                  <?php
                                                    }
                                                  ?>
                                              </table>
                                          </td>
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
