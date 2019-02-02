<?php
  session_start();

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>

    <link rel="stylesheet" href="../css/PC_1920x1080_min.css">
  </head>
  <body>
    <div class="nav">
      <h2 id="msg_bvn">Bienvenue</h4>
      <a href="../index.php">Accueil</a>
      <!-- <a href="last_adds.php">Derniers Ajouts</a> -->
      <!-- <a href="categories.php">Catégories</a> -->
      <a href="videos.php">Tous les Animes</a>
      <?php
        if(!isset($_SESSION) || empty($_SESSION)){
          echo "<a href=\"connexion.php\">Connexion</a>";
        }
        else{
          echo "<script>";
          echo "\n\t\tdocument.getElementById('msg_bvn').textContent=\"Bienvenue ".$_SESSION["pseudo"]." !\";";
          echo "\n\t</script>\n";
          echo "<a href=\"account.php\">Mon compte</a>";
          echo "<a href=\"deconnexion.php\">Déconnexion</a>";
        }
       ?>
      <p id="bottom_nav">Site créé par Noituat</p>
    </div>
  </body>
</html>
