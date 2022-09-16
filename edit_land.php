<?php
include 'db_connect.php';

if(isset($_GET['land_id'])){

    $qry = $conn->query("SELECT * FROM land where land_id = ".$_GET['land_id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}



include 'new_land.php';
?>