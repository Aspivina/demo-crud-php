<?php
  session_start();
  include("../database/db.php");

  if (isset($_SESSION['user'])) {
    $alias = $_SESSION['user'];
    $id = $_SESSION['id'];
  }

  if (isset($_GET['id']) & isset($_SESSION['user'])) {
    $id =  $_GET['id'];
    $alias = $_SESSION['user'];
    $query = "DELETE FROM personas WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
      die("Query Failed!");
    }
    session_unset(); //cleans all private data
    $_SESSION['message'] = 'Ususario eliminado correctamente';
    $_SESSION['message_type'] = 'danger';
    header('Location: ../index.php?signin=true');
  }
?>
