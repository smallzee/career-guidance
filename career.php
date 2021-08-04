<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-08-01
 * Time: 16:10
 */
require_once 'config/core.php';
$subject_data = array();

$subject_sql = $db->query("SELECT * FROM ".DB_PREFIX."subject ORDER BY name");
while ($sub = $subject_sql->fetch(PDO::FETCH_ASSOC)){
    $subject_data[] = $sub;
}
?>
<!Doctype html>
<html>
<head>
    <title>Career Guidance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .form-control{
            height: 45px;
        }
        body{
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
                            <label for="" class="mb-2">Your Name</label>
                            <input type="text" required class="form-control" name="name" placeholder="Your Name" id="">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group mt-2">
                            <label for="" class="mb-2">Course</label>
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


                    <div class="col-6">
                        <div class="add-more-subject mt-3"></div>
                    </div>

                    <div class="col-6">
                        <div class="add-more-grade mt-3"></div>
                    </div>
                </div>

               <div class="col-12">
                   <div class="form-group mt-3">
                       <input type="submit" style="width: 100%; background: #01579B; border: #01579B solid thin;" class="btn btn-lg btn-primary btn-block" value="Submit" name="" id="">
                   </div>
               </div>
            </form>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        var subject = JSON.parse('<?= json_encode($subject_data) ?>');

        $("#course").change(function (e) {
            var course_id = $(this).val();

            $(".add-more").html('');

            for (var i =0; i < subject.length; i++){
                if (course_id == subject[i].course_id){

                    var sub = ` <div class="form-group mt-2">
                                        <label for="" class="mb-2">Subject</label>
                                        <select name="subject[]" id="" required class="form-control">
                                            <option value="" selected>Select</option>
                                            <option value="`+subject[i].id+`">`+subject[i].name+`</option>
                                        </select>
                                    </div>`;

                    var grade = ` <div class="form-group mt-2">
                                        <label for="" class="mb-2">Grade</label>
                                        <select name="grade[]" class="form-control" id="">
                                            <option value="" disabled selected>Select</option>
                                            <option>A1</option>
                                            <option>B2</option>
                                            <option>B3</option>
                                            <option>C5</option>
                                            <option>C6</option>
                                            <option>D7</option>
                                            <option>E8</option>
                                            <option>F9</option>
                                        </select>
                                    </div>`;

                    $(".add-more-subject").append(sub);
                    $(".add-more-grade").append(grade);

                }
            }
        });
    </script>
</body>
</html>
