<?php

require 'authentication.php'; // admin authentication check 

// auth check
$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['name'];
$security_key = $_SESSION['security_key'];
if ($user_id == NULL || $security_key == NULL) {
    header('Location: index.php');
}

// check admin
$user_role = $_SESSION['user_role'];

$task_id = $_GET['land_id'];



if(isset($_POST['update_land'])){
    // $obj_admin->update_task_info($_POST,$task_id, $user_role);
}

$page_name="Edit Task";
include("sidebar.php");

$sql = "SELECT land_name, land_description,
land_dimension, activities, image
FROM land
WHERE land_id='$land_id'";
$info = $obj_admin->manage_all_info($sql);
$row = $info->fetch(PDO::FETCH_ASSOC);

?>
