<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Titre</label>
							<input type="text" name="land_title" class="form-control form-control-sm" required value="<?php echo isset($title) ? $title : '' ?>">
                            <small id="title_match" data-status=''></small>

						</div> 
				
                        <div class="form-group">
							<label for="" class="control-label">Dimension</label>
							<input type="text" name="land_dimension" class="form-control form-control-sm" required value="<?php echo isset($dimension) ? $dimension : '' ?>">
						</div>
						<?php if($_SESSION['login_type'] == 1): ?>
						<div class="form-group">
							<label for="" class="control-label">Type</label>
							<select name="land_type" id="type" class="custom-select custom-select-sm">
								<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Bassin</option>
								<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Parcelle</option>
							</select>
						</div>

                        <div class="col-md-10"> 
				            <div class="form-group">
                                <label for="" class="control-label">Description</label>
                                <textarea name="land_description" id="" cols="30" rows="10" class="summernote form-control">
                                    <?php echo isset($description) ? $description : '' ?>
                                </textarea>
				            </div>
			            </div>


						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($land_img) ? 'assets/uploads/'.$land_img :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
						</div>
					</div>
				
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="land_title"]').keyup(function(){
		var landTitle = $('[name="land_title"]').val()
		if(landTitle == ''){
			$('#title_match').attr('data-status','')
		}else{
			if(cpass > 0){
				$('#title_match').attr('data-status','1').html('<i class="text-success">title Disponible.</i>')
			}else{
				$('#title_match').attr('data-status','2').html('<i class="text-danger">title Non Disponible.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage_land').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('[name="land_title"]').val() != ''){
			if($('#title_match').attr('data-status') != 1){
				if($("[name='land_title']").val() !=''){
					$('[name="land_title"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url:'ajax.php?action=save_land',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Parcelle/Bassin ajouté avec succès.',"success");
					setTimeout(function(){
						location.replace('index.php?page=land_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>