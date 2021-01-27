<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 12/21/20
 * Time: 2:27 PM
 */

$page_title = "Dashboard";
require_once 'config/core.php';
require_once 'libs/head.php';
?>

<section class="content">

    <div class="row">
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue-gradient">
                <div class="inner">
                    <h3>
                        <?php
                            $sql = $db->query("SELECT * FROM ".DB_PREFIX."admin");
                            echo $sql->rowCount();
                        ?>
                    </h3>
                    <p class="text-uppercase">All Fpe Staffs</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?= base_url('staff.php') ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple-gradient">
                <div class="inner">
                    <h3>
                        <?php
                        $sql = $db->query("SELECT * FROM ".DB_PREFIX."schools");
                        echo $sql->rowCount();
                        ?>
                    </h3>
                    <p class="text-uppercase">All Fpe Schools</p>
                </div>
                <div class="icon">
                    <i class="fa fa-home"></i>
                </div>
                <a href="<?= base_url('department.php') ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-12 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <h3>
                        <?php
                        $sql = $db->query("SELECT * FROM ".DB_PREFIX."departments");
                        echo $sql->rowCount();
                        ?>
                    </h3>
                    <p class="text-uppercase">All Fpe Departments</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="<?= base_url('department.php') ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

</section>

<?php require_once 'libs/foot.php'?>
