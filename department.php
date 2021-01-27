<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 1/27/21
 * Time: 11:01 AM
 */

$page_title = "All Schools &amp; Departments";
require_once 'config/core.php';
require_once 'libs/head.php';
?>

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

                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>School Name</th>
                                <th>Department Name</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>School Name</th>
                                <th>Department Name</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $sql = $db->query("SELECT * FROM ".DB_PREFIX."schools ORDER BY name");
                                while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <tr>
                                        <td><?= $sn++ ?></td>
                                        <td><?= ucwords($rs['name']) ?></td>
                                        <td>
                                            <table>
                                                <?php
                                                    $school_id = $rs['id'];
                                                    $i =1;
                                                    $sql2 = $db->query("SELECT * FROM ".DB_PREFIX."departments WHERE school_id='$school_id' ORDER BY name");
                                                    while ($rs2 = $sql2->fetch(PDO::FETCH_ASSOC)){
                                                        ?>
                                                    <tr>
                                                        <td style="padding: 5px"><?= $i++.'. '.ucwords($rs2['name']) ?></td>
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
            <!-- /.box -->
        </div>
    </div>
</section>

<?php require_once 'libs/foot.php'?>
