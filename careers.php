<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 2021-08-09
 * Time: 10:34
 */

require_once 'config/core.php';
if (!isset($_SESSION['data'])){
    redirect(base_url('career.php'));
    exit();
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

<?php
    $data = $_SESSION['data'];
    if (is_array($data) && count($data) > 0 && isset($data)){
        for ($i=0; $i < count($data); $i++){

            $guidance_id = $data[$i]['id'];

            ?>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $data[$i]['id'] ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $data[$i]['id'] ?>" aria-expanded="false" aria-controls="collapseTwo">
                            <?= ucwords($data[$i]['name']) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $data[$i]['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $data[$i]['id'] ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <p><?= $data[$i]['description'] ?></p>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sn =1;
                                    $sql = $db->query("SELECT s.name, g.grade  FROM ".DB_PREFIX."guidance_grade g INNER JOIN ".DB_PREFIX."subject s ON g.subject_id = s.id WHERE g.guidance_id='$guidance_id'");
                                    while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){

                                        ?>
                                        <tr>
                                            <td><?= $sn++ ?></td>
                                            <td><?= ucwords($rs['name']) ?></td>
                                            <td><?= $rs['grade'] ?></td>
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

            <?php
        }
    }
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

