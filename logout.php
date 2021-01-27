<?php
/**
 * Created by PhpStorm.
 * User: Tech4all
 * Date: 12/21/20
 * Time: 2:39 PM
 */

require_once 'config/core.php';
unset($_SESSION['loggeding']);
unset($_SESSION[USER_SESSION_HOLDER]);
session_destroy();
set_flash("You have logged out successfully","info");
redirect(base_url());