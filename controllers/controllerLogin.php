<?php
  session_start();
  include("../database/db.php");

  if (isset($_POST['login'])) {
    $alias = $_POST['alias'];
    $password = $_POST['password'];
    $query = "SELECT * FROM personas WHERE alias='$alias' ";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      $db_alias = $row['alias'];
      $db_password = $row['password'];
      $db_id = $row['id'];

      if ($db_password === $password) {
        $_SESSION['message'] = 'Bienvenido ' . $db_alias;
        $_SESSION['id'] = $db_id;
        $_SESSION['user'] = $db_alias;
        $_SESSION['message_type'] = 'success';
        header('Location: ../includes/private.php');
      } else {
        $_SESSION['message'] = 'Usuario o clave erroneos!';
        $_SESSION['message_type'] = 'danger';
        header('Location: ../index.php?login=true');
      }
    } else {
      $_SESSION['message'] = 'Usuario no encontrado!';
      $_SESSION['message_type'] = 'danger';
      header('Location: ../index.php?login=true');
    }
  }

?>
