<?php
    session_start();
    include("../database/db.php");
    // echo 'controladora login';

    if(isset($_POST['login'])){
        $alias = $_POST['alias'];
        echo "\n".$alias;
        $password= $_POST['password'];
        
        $query = "SELECT * FROM personas WHERE alias='$alias' ";
        // $query = "SELECT * FROM personas";
        
        $result = mysqli_query($conn, $query);
        $row_cnt =mysqli_num_rows($result);
        echo "\nTotal encontrados: ".$row_cnt;
        
        if(mysqli_num_rows($result) == 1){
            $row= mysqli_fetch_array($result);
            $db_alias= $row['alias'];
            // echo "\n"."db_alias: ".$db_alias;
            $db_password= $row['password'];
            // echo "\ndb_password: ".$db_password;
            $db_id= $row['id'];
            // echo "\ndb_password: ".$db_password;

            if($db_password === $password){
                $_SESSION['message'] = 'Bienvenido '.$db_alias;
                $_SESSION['id'] = $db_id;
                $_SESSION['user'] = $db_alias;
                $_SESSION['message_type'] = 'success';
                 header('Location: ../includes/private.php');               
            }else{
                $_SESSION['message'] = 'Usuario o clave erroneos!';
                $_SESSION['message_type'] = 'danger';
                 header('Location: ../index.php?login=true');               
            }
        }else{
            $_SESSION['message'] = 'Usuario no encontrado!';
            $_SESSION['message_type'] = 'danger';
             header('Location: ../index.php?login=true');            
        }
    }

?>