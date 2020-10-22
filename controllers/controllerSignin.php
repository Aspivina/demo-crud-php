<?php
    include("../database/db.php");

     echo 'controladora Signin';

    if(isset($_POST['signin'])){
        $alias = $_POST['alias'];
        echo "\n".$alias;
        $password= $_POST['password'];
        echo "\n".$password;
        
        $query = "INSERT INTO personas(alias, password) VALUES('$alias','$password')";
        $result = mysqli_query($conn, $query);

        
        if(!$result){
            // die("Query Failed!");
            $_SESSION['message'] = 'El usuario ya existe!';
            $_SESSION['message_type'] = 'warning';
            header('Location: ../index.php?signin=true');        

        }else{
            $_SESSION['message'] = 'Registrado correctamente';
            $_SESSION['message_type'] = 'success';
            header('Location: ../index.php?login=true');        

        }

    }

?>