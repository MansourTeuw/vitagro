<?php 
  session_start();

  if (!isset($_SESSION['email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" href="css/signup.css">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="app/http/signup.php"
	 	      enctype="multipart/form-data">
               <div class="d-left">
                       <a class="btn btn-primary" href="index.php">Accueil</a>
               </div>
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/vitagro.png" 
	 		     class="w-25">
	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Sign Up</h3>   
	 		</div>

	 		<?php if (isset($_GET['error'])) { ?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']);?>
			</div>
			<?php } 
              
              if (isset($_GET['name'])) {
              	$name = $_GET['name'];
              }else $name = '';

              if (isset($_GET['email'])) {
              	$email = $_GET['email'];
              }else $email = '';

			  if (isset($_GET['phone'])) {
				$phone = $_GET['phone'];
			}else $phone = '';

			// if (isset($_GET['role'])) {
			// 	$role = $_GET['role'];
			// }else $role = '';


			?>

	 	  <div class="mb-3">
		    <label class="form-label">
		           Nom Complet</label>
		    <input type="text"
		           name="name"
		           value="<?=$name?>" 
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Email</label>
		    <input type="email" 
		           class="form-control"
		           value="<?=$email?>" 
		           name="email">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Téléphone</label>
		    <input type="number" 
		           class="form-control"
		           value="<?=$phone?>" 
		           name="phone">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Rôle</label>
				  <select name="role" id="role" class="form-select mb-3">
					<option value="">Veuillez selection un rôle......</option>
					<option value="agri">Agriculture</option>
					<option value="aqua">Aquaculture</option>
				  </select>
		  </div>


		  <div class="mb-3">
		    <label class="form-label">
		           Mot de Passe</label>
		    <input type="password" 
		           class="form-control"
		           name="password1">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Répéter Mot de passe</label>
		    <input type="password" 
		           class="form-control"
		           name="password2">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Photo</label>
		    <input type="file" 
		           class="form-control"
		           name="pp">
		  </div>
		  
		  <button type="submit" 
		          class="btn btn-primary">
		          Sign Up</button>
		  <button type="reset" 
		          class="btn btn-danger">
		          Reset</button>
		  <a href="login.php">Login</a>
		</form>
	 </div>
</body>
</html>
<?php
  }else{
  	header("Location: login.php");
   	exit;
  }
 ?>