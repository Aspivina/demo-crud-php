<?php
    session_start();
    include("../database/db.php");

     if (isset($_SESSION['user'])) {
        $session_alias = $_SESSION['user'];
        $session_id = $_SESSION['id'];
    }
    
    if(isset($_POST['update'])){
        $alias = $_POST['alias'];
        $password= $_POST['password'];
        $new_password= $_POST['new_password'];
        $new_password_check= $_POST['new_password_check'];

        if($new_password===$new_password_check){
            //busco el usuario a actualizar
            $query = "SELECT * FROM personas WHERE id='$session_id' ";
            $result = mysqli_query($conn, $query);
            $row_cnt =mysqli_num_rows($result);
            
            if(mysqli_num_rows($result) == 1){
                $row= mysqli_fetch_array($result);
                $db_alias= $row['alias'];
                $db_password= $row['password'];
                $query = "UPDATE personas set password = '$new_password' WHERE id=$session_id";
                $update_result = mysqli_query($conn, $query);

                $_SESSION['message'] = 'Actualizado correctamente';
                $_SESSION['message_type'] = 'success';
            }else{
                //no pude encontrar el usuario o.O";
                $_SESSION['message'] = 'No se pudo actualizar';
                $_SESSION['message_type'] = 'danger';                
            }    
        }else{
            //no coinciden las nuevas contraseñas
            $_SESSION['message'] = 'Las nuevas contraseñan no coinciden';
            $_SESSION['message_type'] = 'danger';             
        }
    }
    header('Location: ../includes/private.php');        
?>
