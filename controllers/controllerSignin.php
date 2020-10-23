<?php
  session_start();
  include("../database/db.php");

  if (isset($_POST['signin'])) {
    $alias = $_POST['alias'];
    $password = $_POST['password'];
    $query = "INSERT INTO personas(alias, password) VALUES('$alias','$password')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      // die("Query Failed!");
      $_SESSION['message'] = 'El usuario ya existe!';
      $_SESSION['message_type'] = 'warning';
      header('Location: ../index.php?signin=true');
    } else {
      $_SESSION['message'] = 'Registrado correctamente';
      $_SESSION['message_type'] = 'success';
      header('Location: ../index.php?login=true');
    }
  }
?>
