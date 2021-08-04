<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 1/27/21
 * Time: 11:48 AM
 */

$page_title = "Career Guidance";
require_once 'config/core.php';

if (isset($_POST['add'])){
    $department = $_POST['department'];
    $course = $_POST['course'];
    $description = $_POST['description'];
    $grade = $_POST['grade'];

    $subject = $_POST['subject'];

    if (empty($department) or empty($course) or empty($description) ){
        $error[] = "All fields(s) are required";
    }

    $error_count = count($error);

    if ($error_count == 0){

        $in = $db->query("INSERT INTO ".DB_PREFIX."guidance (department_id,course_id,description)VALUES('$department','$course','$description')");

        $guidance_id = $db->lastInsertId();


        for ($i =0 ; $i < count($subject); $i++){
            $subject2 = $subject[$i];
            $grade2 = strtoupper($grade[$i]);

            $in = $db->query("INSERT INTO ".DB_PREFIX."guidance_grade (guidance_id,subject_id,grade)VALUES('$guidance_id','$subject2','$grade2')");
        }

        set_flash("Guidance has been added successfully","info");


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
                <h4 id="myModalLabel" class="modal-title">Add New Guidance</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" id="" class="form-control" required>
                                    <option value="" selected>Select</option>
                                    <?php
                                        $sql = $db->query("SELECT * FROM ".DB_PREFIX."departments");
                                        while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <option value="<?= $rs['id'] ?>"><?= ucwords($rs['name']) ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Course</label>
                                <select name="course" id="course" required class="form-control">
                                    <option value="" selected disabled> Select</option>
                                    <?php
                                        $sql = $db->query("SELECT * FROM ".DB_PREFIX."course ORDER BY name");
                                        while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <option value="<?= $rs['id'] ?>"><?= ucwords($rs['name']) ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="add-more"></div>

                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control" required style="resize: none" placeholder="Description"></textarea>
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

                    <a href="#" class="btn btn-primary mb-20" data-target="#myModal" data-toggle="modal">Add New Guidance</a>

                    <?php flash(); ?>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Course</th>
                                <th>Department</th>
                                <th>Description</th>
                                <th>Subject &amp; Grade</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Course</th>
                                <th>Department</th>
                                <th>Description</th>
                                <th>Subject &amp; Grade</th>
                                <th>Created At</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                              $sql = $db->query("SELECT g.*, d.name as department, c.name course FROM ".DB_PREFIX."guidance g
                                INNER JOIN ".DB_PREFIX."departments d
                                    ON g.department_id = d.id
                                    
                                INNER JOIN ".DB_PREFIX."course c
                                    ON g.course_id = c.id
                               ORDER BY g.id DESC");
                              while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){

                                  $guidance_id = $rs['id'];

                                  ?>
                                  <tr>
                                      <td><?= $sn++ ?></td>
                                      <td><?= ucwords($rs['course']) ?></td>
                                      <td><?= $rs['department'] ?></td>
                                      <td><?= $rs['description'] ?></td>
                                      <td>
                                          <table border="1">
                                             <thead>
                                             <tr>
                                                 <th style="padding: 10px; width: 100%">Subject</th>
                                                 <th style="padding: 10px; width: 100%">Grade</th>
                                             </tr>
                                             </thead>
                                              <tbody>

                                                <?php
                                                    $sql2 = $db->query("SELECT g_g.*, s.name as subject FROM ".DB_PREFIX."guidance_grade g_g INNER JOIN ".DB_PREFIX."subject s ON g_g.subject_id = s.id WHERE g_g.guidance_id='$guidance_id'");
                                                    while ($rs2 = $sql2->fetch(PDO::FETCH_ASSOC)){
                                                        ?>
                                                        <tr>
                                                            <td style="padding: 10px; width: 100%"><?= ucwords($rs2['subject']) ?></td>
                                                            <td style="padding: 10px; width: 100%"><?= $rs2['grade'] ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                ?>

                                              </tbody>
                                          </table>
                                      </td>
                                      <td><?= $rs['created_at'] ?></td>
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
