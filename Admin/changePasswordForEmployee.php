<?php
require 'authentication.php'; // admin authentication check 

// auth check
if(isset($_SESSION['admin_id'])){
  $user_id = $_SESSION['admin_id'];
  $user_name = $_SESSION['name'];
  $security_key = $_SESSION['security_key'];
 
}

if(isset($_POST['change_password_btn'])){
 $info = $obj_admin->change_password_for_employee($_POST);
}

$page_name="Login";
include("includes/header.php");

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/vitagro.png">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="">
               
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/vitagro.png" 
	 		     class="w-25">
	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Veuillez changer votre Password</h3>   


	 		</div>
	 		<?php if(isset($info)){ ?>
			  <h5 class="alert alert-danger"><?php echo $info; ?></h5>
			  <?php } ?>
			  
		  <div class="mb-3 form-group">
		  <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required/>
		    <label class="form-label">
		           Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password" required>
		  </div>

		  <div class="mb-3 form-group"
		  ng-class="{'has-error': loginForm.password.$invalid && loginForm.password.$dirty, 'has-success': loginForm.password.$valid}">
		    <label class="form-label">
		           Retype Password</label>
		    <input type="password" 
		           class="form-control"
		           name="re_password">
		  </div>
		  
		  <button type="submit" 
				 name="change_password_btn"
		          class="btn btn-primary">
		          CHANGE PASSWORD</button>

		 <button type="reset" 
		          class="btn btn-danger">
		          Reset</button>
		</form>
	 </div>
</body>
</html>
