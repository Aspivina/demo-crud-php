<?php
    session_start();
    include("../database/db.php");

     echo 'controladora Delete';

     if (isset($_SESSION['user'])) {
        $alias = $_SESSION['user'];
         echo "\n".$alias;
        $id = $_SESSION['id'];
         echo "\n".$id;
    }


    if( isset($_GET['id']) & isset($_SESSION['user'])){
        $id =  $_GET['id'];
        $alias = $_SESSION['user'];
        echo "\n".$alias;
        
        $query = "DELETE FROM personas WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        
        if(!$result){
            die("Query Failed!");
        }
        session_unset();
        $_SESSION['message'] = 'Eliminado correctamente';
        $_SESSION['message_type'] = 'danger';
        header('Location: ../index.php?signin=true');        
    }



?>