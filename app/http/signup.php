<?php  

# check if username, password, name submitted
if(isset($_POST['name']) &&
   isset($_POST['email']) &&
   isset($_POST['phone']) && 
   isset($_POST['role']) &&
   isset($_POST['password1']) && 
   $_POST['password1'] === $_POST['password2']){

   # database connection file
   include '../../db.conn.php';
   
   # get data from POST request and store them in var

   function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




   $name = test_input($_POST['name']);
   $email = test_input($_POST['email']);
   $phone = test_input($_POST['phone']);
   $role = test_input($_POST['role']);
   $password1 = test_input($_POST['password1']);
   $password2 = test_input($_POST['password2']);




   # making URL data format
   $data = 'name='.$name.'&email='.$email.'&phone'.$phone.'&role'.$role;

   #simple form Validation
   if (empty($name)) {
   	  # error message
   	  $em = "Le nom est obligatoire";

   	  # redirect to 'signup.php' and passing error message
   	  header("Location: ../../signup.php?error=$em");
   	  exit;
   }else if(empty($email)){
      # error message
   	  $em = "L'email est obligatoire";

   	  header("Location: ../../signup.php?error=$em&$data");
   	  exit;
   } else if(empty($phone)){
    # error message
       $em = "Numéro de téléphone est obligatoire";

       header("Location: ../../signup.php?error=$em&$data");
       exit;
   } else if(empty($role)){
    # error message
       $em = "Veuillez selectionner votre rôle";

       header("Location: ../../signup.php?error=$em&$data");
       exit;

   } else if(empty($password1) || empty($password2)){
   	  # error message
   	  $em = "Un mot de passe est obligatoire";

   	  header("Location: ../../signup.php?error=$em&$data");
   	  exit;
   } else if($password1 !== $password2) {
       $em = "Les deux mot de passes ne correspondent pas!";
   } else {
   	  # checking the database if the username is taken
   	  $sql = "SELECT email 
   	          FROM employees
   	          WHERE email=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$email]);

      if($stmt->rowCount() > 0){
      	$em = "L'adresse mail ($email) est déja prise";
      	header("Location: ../../signup.php?error=$em&$data");
   	    exit;
      }else {
      	# Profile Picture Uploading
      	if (isset($_FILES['pp'])) {
      		# get data and store them in var
      		$img_name  = $_FILES['pp']['name'];
      		$tmp_name  = $_FILES['pp']['tmp_name'];
      		$error  = $_FILES['pp']['error'];

      		# if there is not error occurred while uploading
      		if($error === 0){
               
               # get image extension store it in var
      		   $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

               /** 
				convert the image extension into lower case 
				and store it in var 
				**/
				$img_ex_lc = strtolower($img_ex);

				/** 
				crating array that stores allowed
				to upload image extension.
				**/
				$allowed_exs = array("jpg", "jpeg", "png");

				/** 
				check if the the image extension 
				is present in $allowed_exs array
				**/
				if (in_array($img_ex_lc, $allowed_exs)) {
					/** 
					 renaming the image with user's username
					 like: username.$img_ex_lc
					**/
					$new_img_name = $name. '.'.$img_ex_lc;

					# crating upload path on root directory
					$img_upload_path = '../../uploads/'.$new_img_name;

					# move uploaded image to ./upload folder
                    move_uploaded_file($tmp_name, $img_upload_path);
				}else {
					$em = "You can't upload files of this type";
			      	header("Location: ../../signup.php?error=$em&$data");
			   	    exit;
				}

      		}
      	} 

      	// password hashing
      	$password1 = password_hash($password1, PASSWORD_DEFAULT);
      	$password2 = password_hash($password2, PASSWORD_DEFAULT);


      	# if the user upload Profile Picture
      	if (isset($new_img_name)) {

      		# inserting data into database
            $sql = "INSERT INTO employees
                    (name, email, phone, role, password1, password2, p_p)
                    VALUES (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $email, $phone, $role, $password1, $password2, $new_img_name]);
      	}else {
            # inserting data into database
            $sql = "INSERT INTO employees
                    (name, email, phone, role, password1, password2)
                    VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $email, $phone, $role, $password1, $password2]);
      	}

      	# success message
      	$sm = "$name votre compte a été crée!";

      	# redirect to 'index.php' and passing success message
      	header("Location: ../../login.php?success=$sm");
     	exit;
      }

   }
}else {
	header("Location: ../../signup.php");
   	exit;
}