<?php 
include('db_connect.php');
session_start();
if(isset($_GET['land_id'])){
$land = $conn->query("SELECT * FROM land where land_id =".$_GET['land_id']);
foreach($land->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
    <div id="msg"></div>

    <form action="" id="manage-land">
        <input type="hidden" name="land_id" value="<?php echo isset($meta['land_id']) ? $meta['land_id']: '' ?>">
        <div class="form-group">
            <label for="land_title">Titre</label>
            <input type="text" name="land_title" id="land_title" class="form-control"
                value="<?php echo isset($meta['land_title']) ? $meta['land_title']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="name">Dimension</label>
            <input type="text" name="land_dimension" id="land_dimension" class="form-control"
                value="<?php echo isset($meta['land_dimension']) ? $meta['land_dimension']: '' ?>" required>
        </div>
        <!-- -->


        <div class="form-group">
            <label for="land_description" class="control-label">Description</label>
            <textarea name="land_description" id="land_description" cols="30" rows="10" class="summernote form-control"
                value="<?php echo isset($meta['land_description']) ? $meta['land_description']: '' ?>">

            </textarea>
        </div>


        <!-- <div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<small><i>Leave this blank if you dont want to change the password.</i></small>
		</div> -->


        <div class="form-group">
            <label for="" class="control-label">Avatar</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img"
                    onchange="displayImg(this,$(this))">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
        <div class="form-group d-flex justify-content-center">
            <img src="<?php echo isset($meta['avatar']) ? 'assets/uploads/'.$meta['avatar'] :'' ?>" alt="" id="cimg"
                class="img-fluid img-thumbnail">
        </div>


    </form>
</div>
<style>
img#cimg {
    height: 15vh;
    width: 15vh;
    object-fit: cover;
    border-radius: 100% 100%;
}
</style>
<script>
function displayImg(input, _this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('#manage-land').submit(function(e) {
    e.preventDefault();
    start_load()
    $.ajax({
        url: 'ajax.php?action=update_land',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Parcelle/Bassin modifié avec succès", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
            } else {
                $('#msg').html('<div class="alert alert-danger">Parcelle/Bassin existe déja.</div>')
                end_load()
            }
        }
    })
})
</script>