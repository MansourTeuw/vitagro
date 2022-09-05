<?php
class Admin_class {
    // Connexion à la base de données 

    public function __construct()
    {   
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $db_name = "task_manager";

        try {
            $connection = new PDO("mysql:host={$host_name}; dbname={$db_name}", $user_name, $password);
            $this->db = $connection;
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


    public function add_new_land($data) {

        if (isset($_POST['add_land'])) {


                $file = $_FILES['image']['name'];
                $file_loc = $_FILES['image']['tmp_name'];

                $folder = "uploads/";
                $new_file_name = strtolower($file);
                $final_file = str_replace(' ', '-', $new_file_name);

                $land_title = $this->test_form_input_data($data['land_title']);
                $land_description = $this->test_form_input_data($data['land_description']);
                $land_dimension = $this->test_form_input_data($data['land_dimension']);
                $land_type = $this->test_form_input_data($data['land_type']);

                if (move_uploaded_file($file_loc,$folder.$final_file)) {
                    $image = $final_file;
                }



                try {
                    // Pour voir si le nom de la parcelle est disponible 
            
                    $sqlLandTitle = "SELECT land_title FROM land WHERE land_title = '$land_title' ";
                    $query_result_for_land_title = $this->manage_all_info($sqlLandTitle);
                    $total_land_title = $query_result_for_land_title->rowCount();
            
            
                    if ($total_land_title != 0 ) {
                        $message = "Ce Nom de Parcelle existe deja";
                        return $message;
                    } else {
            
            
                        $added_land = "INSERT INTO land (land_title, land_dimension, land_description, type, image) VALUES (:x, :y, :z, :a, :b) ";
                        $add_land = $this->db->prepare($added_land);
            
                        $add_land->bindparam(':x', $land_title);
                        $add_land->bindparam(':z', $land_dimension);
                        $add_land->bindparam(':y', $land_description);
                        $add_land->bindparam(':a', $land_type);
                        $add_land->bindparam(':b', $image);
            
            
                        $add_land->execute();
            
                    }
            
            
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

    //         }
    } else {
        $message = "Probleme avec isset";
        return $message;
    }        

    }


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
        $punch_out_time = $date->format('d-m-y H:i:s');

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