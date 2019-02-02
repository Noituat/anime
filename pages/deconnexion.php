<?php
  session_start();
  session_destroy();
  header('Location: http://noituat.fr/index.php');
  exit();
 ?>
