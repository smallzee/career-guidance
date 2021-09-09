<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-09-01
 * Time: 09:03
 */

$page_title = "Edit Career Guidance";
require_once 'config/core.php';

$id = $_GET['id'];

if (!isset($id) && empty($id)){
    redirect(base_url('dashboard.php'));
    return;
}

$sql = $db->query("SELECT * FROM ".DB_PREFIX."guidance WHERE id='$id'");
if ($sql->rowCount() == 0){
    redirect(base_url('dashboard.php'));
    return;
}

$data = $sql->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])){
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

        $guidance_id = $data['id'];
        $course_id = $data['course_id'];

        $db->query("DELETE FROM ".DB_PREFIX."guidance_grade WHERE guidance_id='$guidance_id'");

        $db->query("UPDATE ".DB_PREFIX."guidance SET department_id='$department', course_id='$course_id', description='$description' WHERE id='$guidance_id'");


        for ($i =0 ; $i < count($subject); $i++){
            $subject2 = $subject[$i];
            $grade2 = strtoupper($grade[$i]);

            $in = $db->query("INSERT INTO ".DB_PREFIX."guidance_grade (guidance_id,subject_id,grade)VALUES('$guidance_id','$subject2','$grade2')");
        }

        set_flash("Guidance has been updated successfully","info");

        redirect(base_url('guidance.php'));


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


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php flash(); ?>
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

                    <form action="" method="post">

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
                                               if ($rs['id'] == $data['department_id']){
                                                   ?>
                                                   <option value="<?= $rs['id'] ?>" <?= ($data['department_id'] == $rs['id']) ? 'selected' : '' ?>><?= ucwords($rs['name']) ?></option>
                                                   <?php
                                               }
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
                                                if ($rs['id'] == $data['course_id']){
                                                    ?>
                                                    <option value="<?= $rs['id'] ?>" <?= ($data['course_id'] == $rs['id']) ? 'selected' : ''?>><?= ucwords($rs['name']) ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    $course_id = $data['course_id'];
                                    $sql2 = $db->query("SELECT * FROM ".DB_PREFIX."subject WHERE course_id='$course_id'");
                                    while ($rs2 = $sql2->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <div class="form-group">
                                            <select name="subject[]" required id="" class="form-control">
                                                <option value="<?= $rs2['id'] ?>"><?= ucwords($rs2['name']) ?></option>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?php
                                    $course_id = $data['course_id'];
                                    $sql2 = $db->query("SELECT * FROM ".DB_PREFIX."subject WHERE course_id='$course_id'");
                                    while ($rs2 = $sql2->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="grade[]" placeholder="Grade"  id="">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control" required style="resize: none" placeholder="Description"><?= $data['description'] ?></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update" name="update" id="">
                            </div>

                        </form>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'libs/foot.php'?>
