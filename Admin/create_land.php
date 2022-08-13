<?php

ob_start();
session_start();

require 'admin_class.php';
$obj_admin = new Admin_class();

if (isset($_GET['logout'])) {
    $obj_admin->admin_logout();

}


?>