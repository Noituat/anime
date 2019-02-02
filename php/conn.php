<?php
  try {
    $db = new PDO('mysql:host=localhost; dbname=anime; charset=utf8', 'noituat', 'xebvekul1997');
  }
  catch (\Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
?>
