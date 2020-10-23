<?php
  session_start();

  session_unset(); //cleans all private data
  $_SESSION['message'] = 'Usuario deslogueado correctamente!';
  $_SESSION['message_type'] = 'success';
  header('Location: ../index.php?login=true');
?>
