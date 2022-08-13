<?php 
    require 'authentication.php';

    $user_id = $_SESSION['admin_id'];
    $user_name = $_SESSION['name'];
    $security_key = $_SESSION['security_key'];

    if ($user_id == NULL || $security_key == NULL) { 
        header("Location: index.php");
    }

    $user_role = $_SESSION['user_role'];
    if ($user_role != 1) {
        header("Location: task-info.php");
    }

    $page_name = "Admin";
    include("sidebar.php"); 

?>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" /> -->

<div class="row">
      <div class="col-md-12">
        <div class="well well-custom">
          <ul class="nav nav-tabs nav-justified nav-tabs-custom">
            <li class="active"><a href="manage-admin.php">Gestion Admin</a></li>
            <li><a href="admin-manage-user.php">Gestion Employers</a></li>
            <li><a href="admin-manage-land.php">Gestion Espaces</a></li>
          </ul>
          <div class="gap"></div>
          <div class="table-responsive">
            <table class="table table-codensed table-custom">
              <thead>
                <tr>
                  <th>Serial No.</th>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Nom d'utilisateur</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>

              <?php 
                $sql = "SELECT * FROM tbl_admin WHERE user_role = 1";
                $info = $obj_admin->manage_all_info($sql);

                $serial  = 1;
                $total_expense = 0.00;
                while( $row = $info->fetch(PDO::FETCH_ASSOC) ){
              ?>
                <tr>
                  <td><?php echo $serial; $serial++; ?></td>
                  <td><?php echo $row['fullname']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  
                  <td><a title="Update Admin" href="update-admin.php?admin_id=<?php echo $row['user_id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;</td>
                </tr>
                
              <?php  } ?>
    
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


<?php
if(isset($_SESSION['update_user_pass'])){

  echo '<script>alert("Password updated successfully");</script>';
  unset($_SESSION['update_user_pass']);
}
// include("include/footer.php");

?>