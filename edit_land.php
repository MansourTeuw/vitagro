<?php
include 'db_connect.php';

if(isset($_GET['id'])){

    $qry = $conn->query("SELECT * FROM land where land_id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}



include 'new_land.php';
?>