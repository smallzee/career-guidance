<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-08-01
 * Time: 16:10
 */
require_once 'config/core.php';
$subject_data = $data = $data2 = array();

if (isset($_POST['add'])){
    $course = $_POST['course'];

    $sql = $db->query("SELECT g.id, d.name, g.description FROM ".DB_PREFIX."guidance g INNER JOIN ".DB_PREFIX."departments d ON g.department_id = d.id WHERE g.course_id='$course'");

    if ($sql->rowCount() == 0){
        $error[] = "";
    }

    $error_count = count($error);

    if ($error_count > 0){
        $_SESSION['show-alert'] = 1;
        $_SESSION['alert-icon'] = "error";
        $_SESSION['alert-title'] = "error";
        $_SESSION['alert-text'] = "No available department for your secondary school course";
    }

    if ($error_count == 0){

        while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
            $data[] = $rs;
        }

        $_SESSION['data'] = $data;
        redirect(base_url('careers.php'));

        $_SESSION['show-alert'] = 1;
        $_SESSION['alert-icon'] = "success";
        $_SESSION['alert-title'] = "Success";
        $_SESSION['alert-text'] = "S";
    }
}

?>
<!Doctype html>
<html>
<head>
    <title>Career Guidance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">
    <style>
        .form-control{
            height: 45px;
        }
        body{
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
            font-size: 14px;
        }
    </style>
</head>
<body>


    <div style="margin: 10px">
        <div class="container">
            <form action="" method="post">

                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group mt-2">
                            <label for="" class="mb-2">Secondary School Course</label>
                            <select name="course" id="course" required class="form-control">
                                <option value="" disabled selected>Select</option>
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

                </div>

               <div class="col-12">
                   <div class="form-group mt-3">
                       <input type="submit" style="width: 100%; background: #01579B; border: #01579B solid thin;" class="btn btn-lg btn-primary btn-block" value="Submit" name="add" id="">
                   </div>
               </div>
            </form>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php

        if(isset($_SESSION['show-alert'])){
        ?>

        <script type="text/javascript">

            swal({
                icon: "<?= $_SESSION["alert-icon"];?>",
                title: "<?= $_SESSION["alert-title"];?>",
                text: "<?= $_SESSION["alert-text"];?>"
            });

        </script>

        <?php
        unset($_SESSION['show-alert']);
        unset($_SESSION['alert-title']);
        unset($_SESSION['alert-text']);
    }
    ?>

</body>
</html>
