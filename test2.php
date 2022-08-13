<?php
// Englober tout le code par une class 

class Admin_class {
    // Connexion à la base de données 

    public function __construct()
    {   
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $db_name = "vitagro";

      

        try {
            $connection = new PDO("mysql:host={$host_name}; dbname={$db_name}", $user_name, $password);
            $this->db = $connection;
            // echo "Connected!!!";
        } catch (PDOException $message) {
            echo $message -> getMessage();
        }
    }

    // Assenir les données 

    public function test_form_input_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    return $data;

    }

    // Verifier le login de l'admin et les autres 

    public function admin_login_check($data) {
        // $upass = $this->test_form_input_data(md5($data['admin_password']));
        $upass = $this->test_form_input_data($data['admin_password']);


        $username = $this->test_form_input_data($data['username']);

        try {

            $sql = "SELECT * FROM tbl_admin WHERE username=:uname AND password=:upass LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(':uname'=>$username, ':upass'=>$upass));

            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            // Définir les sessions 

            if ($stmt->rowCount() > 0) {
                session_start();

                $_SESSION['admin_id'] = $userRow['user_id'];
                $_SESSION['name'] = $userRow['fullname'];
                $_SESSION['security_key'] = 'rewsgf@%^&*nmghjjkh';
                $_SESSION['user_role'] = $userRow['user_role'];
                $_SESSION['temp_password'] = $userRow['temp_password'];

                if ($userRow['temp_password'] == null) {
                    header("Location: task-info.php");
                } else {
                    header("Location: changePasswordForEmployee.php");

                }
            } else {
                $message = "Identifiant ou Mot de Passe Invalide!";
                return $message;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Changer le mot de passe des employes 

    public function change_password_for_employee($data) {
        $password = $this->test_form_input_data($data['password']);
        $re_password = $this->test_form_input_data($data['re_password']);

        $user_id = $this->test_form_input_data($data['user_id']);
        $final_password = $password;
        $temp_password = '';

        // comparer les deux passwords 
        if ($password == $re_password) {
            
            try {
                $sql1 = "UPDATE tbl_admin SET password = :x, temp_password = :y WHERE user_id = :id";
                $update_user = $this->db->prepare($sql1);
                $update_user ->bindparam(':x', $final_password);
                $update_user->bindparam(':y', $temp_password);
                $update_user->bindparam(':id', $user_id);
                $update_user->execute();

                $sql2 = "SELECT * FROM tbl_admin WHERE user_id=:id LIMIT 1";

                $stmt = $this->db->prepare($sql2);
                $stmt->execute(array(':id'=>$user_id));
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                    session_start();

                    $_SESSION['admin_id'] = $userRow['user_id'];
                    $_SESSION['name'] = $userRow['fullname'];
                    $_SESSION['security_key'] = 'rewsgf@%^&*nmghjjkh';
                    $_SESSION['user_role'] = $userRow['user_role'];
                    $_SESSION['temp_password'] = $userRow['temp_password'];

                    header("Location: task-info.php");
                }

            } catch (PDOException $e) {
                echo $e -> getMessage();
            }
 
        } else {
            $message = "Identifiant ou Mot de Passe Incorrecte";
            return $message;
        }
    }


    // Destruction de la session: logout  

    public function admin_logout() {
        session_start();

        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['security_key']);
        unset($_SESSION['user_role']);

        header("Location: index.php");
    }

    // Création des utilisateurs  

    public function add_new_user($data) {
        $user_fullname = $this->test_form_input_data($data['em_fullname']);
        $user_username = $this->test_form_input_data($data['em_username']);
        $user_email = $this->test_form_input_data($data['em_email']);
        $temp_password = rand(000000001,10000000);
        $user_password = $this->test_form_input_data(md5($temp_password));

        $user_role = 2;

        try {
            // Pour voir si l'email ou le username est disponible 

            $sqlEmail = "SELECT email FROM tbl_admin WHERE email = '$user_email' ";
            $query_result_for_email = $this->manage_all_info($sqlEmail);
            $total_email = $query_result_for_email->rowCount();

            $sqlUsername = "SELECT username FROM tbl_admin WHERE username = '$user_username' ";
            $query_result_for_username = $this->manage_all_info($sqlUsername);
            $total_username = $query_result_for_username->rowCount();

            if ($total_email != 0 && $total_username != 0) {
                $message = "Adresse mail et mot de passe pas disponible";
                return $message;
            } elseif ($total_username != 0) {
                $message = "Nom d'utilisateur est déja pris!";
                return $message;
            } elseif ($total_email != 0) {
                $message = "Adresse mail est déja prise!";
                return $message;
            } else {
                $added_user = "INSERT INTO tbl_admin (fullname, username, email, password, temp_password, user_role) VALUES (:x, :y, :z, :a, :b, :c) ";
                $add_user = $this->db->prepare($added_user);

                $add_user->bindparam(':x', $user_fullname);
                $add_user->bindparam(':y', $user_username);
                $add_user->bindparam(':z', $user_email);
                $add_user->bindparam(':a', $user_password);
                $add_user->bindparam(':b', $temp_password);
                $add_user->bindparam(':c', $user_role);

                $add_user->execute();

            }


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Mise a jour des donnees utilisateurs: employees 

    public function update_user_data($data, $id) {
        $user_fullname = $this->test_form_input_data($data['em_fullname']);
        $user_username = $this->test_form_input_data($data['em_username']);
        $user_email = $this->test_form_input_data($data['em_email']);

        try {

            $updated_user = "UPDATE tbl_admin SET fullname = :x, username = :y, email = :z WHERE user_id = :id";

            $update_user = $this->db->prepare($updated_user);

            $update_user->bindparam(':x', $user_fullname);
            $update_user->bindparam(':y', $user_username);
            $update_user->bindparam(':z', $user_email);
            $update_user->bindparam(':id', $id);

            $update_user->execute();

            $_SESSION['update_user'] = 'update_user';

            header("Location: admin-manage-user.php");


        } catch (PDOException $e) {
            echo $e -> getMessage();
        }

    }

    // Mise a jour donnees admin principal 

    public function update_admin_data($data, $id) {
        $user_fullname = $this->test_form_input_data($data['em_fullname']);
        $user_username = $this->test_form_input_data($data['em_username']);
        $user_email = $this->test_form_input_data($data['em_email']);

        try {

            $update_user = $this->db->prepare("UPDATE tbl_admin SET fullname = :x, username = :y, email = :z WHERE user_id = :id ");

            $update_user->bindparam(':x', $user_fullname);
            $update_user->bindparam(':y', $user_username);
            $update_user->bindparam(':z', $user_email);
            $update_user->bindparam(':id', $id);

            $update_user->execute();

            header("Location: manage-admin.php");


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Mise a jour donnees employes 

    public function update_user_password($data, $id) {
        // $employee_password = $this->test_form_input_data(md5($data['employee_password']));
        $employee_password = $this->test_form_input_data($data['employee_password']);


        try {

            $update_user_password = $this->db->prepare("UPDATE tbl_admin SET password = :x WHERE user_id = :id");

            $update_user_password->bindparam(':x', $employee_password);
            $update_user_password->bindparam(':id', $id);

            $update_user_password->execute();

            $_SESSION['update_user_pass'] = 'update_user_pass';

            header("Location: admin-manage-user.php");

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Changer le mot de passe de l'admin principal 

    public function admin_password_change ($data, $id) {
        $admin_old_password = $this->test_form_input_data(md5($data['admin_old_password']));
        $admin_new_password = $this->test_form_input_data(md5($data['admin_new_password']));
        $admin_cnew_password = $this->test_form_input_data(md5($data['admin_cnew_password']));
        $admin_raw_password = $this->test_form_input_data(md5($data['admin_raw_password']));

        // Verifier l'ancien password 

       try {

        $sql = "SELECT * FROM tbl_admin WHERE user_id = '$id' AND password = '$admin_old_password' ";

        $query_result = $this->manage_all_info($sql);

        $total_row = $query_result->rowCount();
        $all_error = '';

        if ($total_row == 0) {
            $all_error = "Mot de Passe Invallide";
        }

        if ($admin_new_password != $admin_cnew_password) {
            $all_error .= '<br>'. "Nouveau et Confirmer Nouveau MdePasse ne correspondent pas";
        }

        if (empty($all_error)) {
            $update_admin_password = $this->db->prepare("UPDATE tbl_admin SET password = :x WHERE user_id = :id ");

            $update_admin_password->execute();

            $_SESSION['update_user_pass'] = 'update_user_pass';
        } else {
            return $all_error;
        }

       } catch (PDOexception $e) {
        echo $e->getMessage();
       }
    }

    // creation des Parcelles 
    public function add_new_land($data) {

        // if (isset($_POST['add_land '])) {

            // if (isset($_POST['land_name']) && isset($_POST['land_description']) && isset($_POST['land_dimension']) && isset($_POST['activities']) && isset($_POST['land_image'])) {

                $file_img = $_FILES['image']['name'];
                $file_locate = $_FILES['image']['tmp_name'];

                // $file = $this->test_form_input_data($data[$_FILES['image']['name']]);
                $file = $this->test_form_input_data($data[$file_img]);

                // $file_loc = $this->test_form_input_data($data[$_FILES['image']['tmp_name']]);
                $file_loc = $this->test_form_input_data($data[$file_locate]);


                $folder = "uploads/";
                $new_file_name = strtolower($file);
                $final_file = str_replace(' ', '-', $new_file_name);


                if (move_uploaded_file($file_loc, $folder.$final_file)) {
                    $land_image = $final_file;
                }

                $land_name = $this->test_form_input_data($data['land_name']);
                $land_description = $this->test_form_input_data($data['land_description']);
                $land_dimension = $this->test_form_input_data($data['land_dimension']);
                $activities = $this->test_form_input_data($data['activities']);
                // $land_image = $this->test_form_input_data($data['image']);


                try {
                    // Pour voir si le nom de la parcelle est disponible 
            
                    $sqlLandName = "SELECT land_name FROM land WHERE land_name = '$land_name' ";
                    $query_result_for_land_name = $this->manage_all_info($sqlLandName);
                    $total_land_name = $query_result_for_land_name->rowCount();
            
            
                    if ($total_land_name != 0 ) {
                        $message = "Ce Nom de Parcelle existe deja";
                        return $message;
                    } else {
            
            
                        $added_land = "INSERT INTO land (land_name, land_description, land_dimension, activities, land_image) VALUES (:x, :y, :z, :a, :b) ";
                        $add_land = $this->db->prepare($added_land);
            
                        $add_land->bindparam(':x', $land_name);
                        $add_land->bindparam(':y', $land_description);
                        $add_land->bindparam(':z', $land_dimension);
                        $add_land->bindparam(':a', $activities);
                        $add_land->bindparam(':b', $land_image);
            
            
                        $add_land->execute();
            
                    }
            
            
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

            // }
    // }
        


    // $user_role = 2;


    // close after this 


       

        
       
        

    }

    // Mise a jour des donnees Parcelle 

    public function update_land_data($data, $id) {

    
        $land_name = $this->test_form_input_data($data['land_name']);
        $land_description = $this->test_form_input_data($data['land_description']);
        $land_dimension = $this->test_form_input_data($data['land_dimension']);
        $activities = $this->test_form_input_data($data['activities']);
        // $land_image = $this->test_form_input_data($data['land_image']);



        try {

            $updated_land = "UPDATE land SET land_name = :x, land_description = :y, land_dimension = :z, activities = :a, land_image = :b WHERE land_id = :id";

            $update_land = $this->db->prepare($updated_land);

            $update_land->bindparam(':x', $land_name);
            $update_land->bindparam(':y', $land_description);
            $update_land->bindparam(':z', $land_dimension);
            $update_land->bindparam(':a', $activities);
            // $update_land->bindparam(':b', $land_image);
            $update_land->bindparam(':id', $id);

            $update_land->execute();

            $_SESSION['update_land'] = 'update_land';

            header("Location: admin-manage-land.php");


        } catch (PDOException $e) {
            echo $e -> getMessage();
        }

    }



    // creation des Parcelles  


    // Gestion des taches 

    public function add_new_task($data) {
        // Insertion de donnees 
        $task_title = $this->test_form_input_data($data['task_title']);
        $task_description = $this->test_form_input_data($data['task_description']);
        $t_start_time = $this->test_form_input_data($data['t_start_time']);
        $t_end_time = $this->test_form_input_data($data['t_end_time']);
        $assign_to = $this->test_form_input_data($data['assign_to']); 

        try {
            $add_task = $this->db->prepare("INSERT INTO task_info (t_title, t_description, t_start_time, t_end_time, t_user_id) vALUES (:x, :y, :z, :a, :b) ");


            $add_task->bindparam(':x', $task_title);
            $add_task->bindparam(':y', $task_description);
            $add_task->bindparam(':z', $t_start_time);
            $add_task->bindparam(':a', $t_end_time);
            $add_task->bindparam(':b', $assign_to);

            $add_task->execute();

            $_SESSION['task_msg'] = 'Tàche ajoutée avec succes';

            header("Location: task-info.php");

        } catch (PDOexception $e) {
            echo $e->getMessage();
        }

        

    }

    // Gestion des presences 

    public function add_punch_in($data) {
        // Insertion des donnees 
        $date = new DateTime('now', new DateTimeZone('Africa/Dakar'));

        $user_id = $this->test_form_input_data($data['user_id']);
        $punch_in_time = $date->format('d-m-y H:i:s');

        try {

            $add_attendance = $this->db->prepare("INSERT INTO attendance_info (atn_user_id, in_time) VALUES ('$user_id', '$punch_in_time') ");
            $add_attendance->execute();

            header("Location: attendance-info.php");

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function add_punch_out($data) {
        $date = new DateTime('now', new DateTimeZone('Africa/Dakar'));
        $punch_out_time = $date->format('d-m-Y H:i:s');

        $punch_in_time = $this->test_form_input_data($data['punch_in_time']);

        $dteStart = new Datetime($punch_in_time);
        $dteEnd = new DateTime($punch_out_time);
        $dteDiff = $dteStart->diff($dteEnd);
        $total_duration = $dteDiff->format("%H:%I:%S");

        $attendance_id = $this->test_form_input_data($data['aten_id']);

        try {

            $update_user = $this->db->prepare("UPDATE attendance_info SET out_time = :x, total_duration = :y WHERE aten_id = :id ");

            $update_user->bindparam(':x', $punch_out_time);
            $update_user ->bindparam(':y', $total_duration);
            $update_user->bindparam(':id', $attendance_id);

            $update_user->execute();

            header("Location: attendance-info.php");

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Suppression des donnees 

    public function delete_data_by_this_method($sql, $action_id, $sent_po) {
        
        try {

            $delete_data = $this->db->prepare($sql);

            $delete_data->bindparam(':id', $action_id);

            $delete_data->execute();

            header("Location: ". $sent_po);


        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Gerer toutes les infos 

    public function manage_all_info($sql) {
        try {
            $info = $this->db->prepare($sql);
            $info->execute();

            return $info;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }







}

?>


<script type="text/javascript">

function validate()
    {
        var extensions = new Array("jpg","jpeg", "png");
        var image_file = document.regform.image.value;
        var image_length = document.regform.image.value.length;
        var pos = image_file.lastIndexOf('.') + 1;
        var ext = image_file.substring(pos, image_length);
        var final_ext = ext.toLowerCase();
        for (i = 0; i < extensions.length; i++)
        {
            if(extensions[i] == final_ext)
            {
            return true;
            
            }
        }
        alert("Image Extension Not Valid (Use Jpg,jpeg)");
        return false;
    }
    
</script>