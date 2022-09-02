<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_land"><i class="fa fa-plus"></i> Ajouter Parcelle/Bassin</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="land_list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Titre</th>
						<th>Dimension</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Parcelle","PBassin");
					$qry = $conn->query("SELECT * FROM land ORDER BY date_created asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['Title']) ?></b></td>
						<td><b><?php echo $row['dimension'] ?></b></td>
						<td><b><?php echo $type[$row['type']] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_land" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_land" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#land_list').dataTable()
	$('.view_land').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_land.php?id="+$(this).attr('data-id'))
	})
	$('.delete_land').click(function(){
	_conf("Are you sure to delete this user?","delete_land",[$(this).attr('data-id')])
	})
	})
	function delete_land($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_land',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>