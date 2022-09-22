<?php include 'db_connect.php'; ?>
<?php
if(isset($_GET['id'])){
	$type_arr = array('',"Parcelle","Bassin");
	$qry = $conn->query("SELECT *, land_title as title, land_dimension as dimension, avatar as land_img, land_type as type, land_description as description FROM land where land_id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){ 
	$$k = $v;
}
}
?>
<div class="container-fluid">
    <div class="card card-widget widget-user shadow">
        <div class="widget-user-header bg-dark">
            <h3 class="widget-user-username"><?php echo ucwords($title) ?></h3>
            <h5 class="widget-user-desc"><?php echo $description ?></h5>
        </div>
        <div class="widget-user-image">
            <?php if(empty($land_img) || (!empty($land_img) && !is_file('assets/uploads/'.$land_img))): ?>
            <span
                class="brand-image img-circle elevation-2 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500"
                style="width: 90px;height:90px">
                <h4><?php echo strtoupper(substr($title, 0,1)) ?></h4>
            </span>
            <?php else: ?>
            <img class="img-circle elevation-2" src="assets/uploads/<?php echo $land_img ?>" alt="Land Avatar"
                style="width: 90px;height:90px;object-fit: cover">
            <?php endif ?>
        </div>
        <div class="card-footer">
            <div class="container-fluid">
                <dl>
                    <dt>Type</dt>
                    <dd><?php echo $type_arr[$type] ?></dd>
                </dl>

                <dl>
                    <dt>Dimension</dt>
                    <dd><?php echo $dimension ?></dd>
                </dl>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer display p-0 m-0">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
#uni_modal .modal-footer {
    display: none
}

#uni_modal .modal-footer.display {
    display: flex
}
</style>