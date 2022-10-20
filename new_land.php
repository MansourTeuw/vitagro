<?php

?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form action="" id="manage_land">
                <input type="hidden" name="land_id" value="<?php echo isset($land_id) ? $land_id : '' ?>">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <div class="form-group">
                            <label for="" class="control-label">Titre</label>
                            <input type="text" name="land_title" class="form-control form-control-sm" required
                                value="<?php echo isset($land_title) ? $land_title : '' ?>">

                        </div>


                        <div class="form-group">
                            <label for="" class="control-label">Dimension</label>
                            <input type="text" name="land_dimension" class="form-control form-control-sm" required
                                value="<?php echo isset($dimension) ? $dimension : '' ?>">
                        </div>
                        <?php if($_SESSION['login_type'] == 1): ?>
                        <div class="form-group">
                            <label for="" class="control-label">Type</label>
                            <select name="land_type" id="type" class="custom-select custom-select-sm">
                                <option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Bassin
                                </option>
                                <option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Parcelle
                                </option>
                            </select>
                        </div>

                        <!-- <div class="col-md-10">  -->
                        <div class="form-group">
                            <label for="" class="control-label">Description</label>
                            <textarea name="land_description" id="" cols="30" rows="10" class="summernote form-control">
                                    <?php echo isset($description) ? $description : '' ?>
                                </textarea>
                        </div>
                        <!-- </div> -->


                        <?php else: ?>
                        <input type="hidden" name="type" value="3">
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="" class="control-label">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="img"
                                    onchange="displayImg(this,$(this))">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center align-items-center">
                            <img src="<?php echo isset($land_img) ? 'assets/uploads/'.$land_img :'' ?>" alt="Avatar"
                                id="cimg" class="img-fluland_id img-thumbnail ">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Code</label>
                            <input type="password" class="form-control form-control-sm" name="code"
                                <?php echo !isset($land_id) ? "required":'' ?>>
                            <small><i><?php echo isset($land_id) ? "Laissez le champ vland_ide si vous ne voulez pas changer le code":'' ?></i></small>
                        </div>
                        <div class="form-group">
                            <label class="label control-label">Confirmer Code</label>
                            <input type="password" class="form-control form-control-sm" name="code_rep"
                                <?php echo !isset($land_id) ? 'required' : '' ?>>
                            <small id="code_match" data-status=''></small>
                        </div>
                    </div>



                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2">Soumettre</button>
                    <button class="btn btn-secondary" type="button"
                        onclick="location.href = 'index.php?page=land_list'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
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
$('[name="code"], [name="code_rep"]').keyup(function() {
    var code = $('[name="code"]').val()
    var codeRep = $('[name="code_rep"]').val()

    if (codeRep == '' || code == '') {
        $('#code_match').attr('data-status', '')
    } else {
        if (codeRep == code) {
            $('#code_match').attr('data-status', '1').html(
                '<i class="text-success">Les deux code ne corresponde pas!.</i>')
        } else {
            $('#code_match').attr('data-status', '2').html(
                '<i class="text-danger">OK! les deux code sont pas identiques.</i>')
        }
    }
})

function displayImg(input, _this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('#manage_land').submit(function(e) {
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')
    if ($('[name="code"]').val() != '' && $('[name="code_rep"]').val() != '') {
        if ($('#code_match').attr('data-status') != 1) {
            if ($("[name='code']").val() != '') {
                $('[name="code"], [name="code_rep"]').addClass("border-danger")
                end_load()
                return false;
            }
        }
    }
    $.ajax({
        url: 'ajax.php?action=save_land',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                alert_toast('Parcelle/Bassin ajouté avec succès.', "success");
                setTimeout(function() {
                    location.replace('index.php?page=land_list')
                }, 750)
            } else if (resp == 2) {
                $('#msg').html(
                "<div class='alert alert-danger'>Parcelle/Bassin existe déja.</div>");
                $('[name="land_title"]').addClass("border-danger")
                end_load()
            }
        }
    })
})
</script>