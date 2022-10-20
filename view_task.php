<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM tasks_list where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}





?>
<div class="container-fluid">
    <dl>
        <dt><b class="border-bottom border-primary">Tâche</b></dt>
        <dd><?php echo ucwords($task) ?></dd>
    </dl>
    <dl>
        <dt><b class="border-bottom border-primary">Status</b></dt>
        <dd>
            <?php 
        	if($status == 1){
		  		echo "<span class='badge badge-secondary'>Suspendu</span>";
        	}elseif($status == 2){
		  		echo "<span class='badge badge-primary'>On-Progress</span>";
        	}elseif($status == 3){
		  		echo "<span class='badge badge-success'>Done</span>";
        	}
        	?>
        </dd>
    </dl>

    <dl>
        <dt><b class="border-bottom border-primary">Description</b></dt>
        <dd><?php echo html_entity_decode($description) ?></dd>
    </dl>

    <dl>
        <div class="card card-outline card-primary">
            <div class="card-header">
                <span><b>Les membres de l'équipe:</b></span>
                <div class="card-tools">
                    <!-- <button class="btn btn-primary bg-gradient-primary btn-sm" type="button" id="manage_team">Manage</button> -->
                </div>
            </div>
            <div class="card-body">
                <ul class="userss-list clearfix">
                    <?php 
						if(!empty($user_ids)):
							$members = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM userss where id in ($user_ids) order by concat(firstname,' ',lastname) asc");
							while($row=$members->fetch_assoc()):
						?>
                    <li>
                        <img src="assets/uploads/<?php echo $row['avatar'] ?>" alt="User Image"><br>
                        <a class="userss-list-name" href="javascript:void(0)"><?php echo ucwords($row['name']) ?></a>
                        <!-- <span class="userss-list-date">Today</span> -->
                    </li>
                    <?php 
							endwhile;
						endif;
						?>
                </ul>
            </div>
        </div>
    </dl>


</div>