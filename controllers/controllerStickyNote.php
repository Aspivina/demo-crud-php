<?php
  session_start();
  include("../database/db.php");

  if (isset($_GET['all'])) {
    $user_id = $_SESSION['id'];
    $query ="SELECT * FROM notas WHERE user_id='$user_id' ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
      die("Query Failed.");
    }else{
      $_SESSION['notas'] = $result;
      print_r($result);
    }
  }

  if (isset($_POST['addNew'])) {
    $user_id = $_SESSION['id'];
    $titulo =$_POST['titulo'];
    $contenido =$_POST['contenido'];
    $query = "INSERT INTO notas(titulo, contenido, user_id) VALUES ('$titulo', '$contenido', '$user_id')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
      die("Query Failed.");
    }else{
      echo "\nOk";
    }
  }

  if(isset($_POST['update'])){
    $id= $_GET['id'];    
    $user_id = $_SESSION['id'];
    $titulo =$_POST['titulo'];
    $contenido =$_POST['contenido'];
    $query = "UPDATE notas set titulo='$titulo', contenido='$contenido'  WHERE id='$id' AND user_id='$user_id' ";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed!");
    }else{
      echo "\nOk";
    }    
  }

  if(isset($_POST['delete'])){
    $id= $_GET['id'];
    $user_id = $_SESSION['id'];
    $query = "DELETE FROM notas WHERE id='$id' AND user_id='$user_id' ";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed!");
    }else{
      echo "\nOk";
    }
  }

  header('Location: ../includes/private.php');    

?>
