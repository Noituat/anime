<?php
  session_start();
  include '../php/conn.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>
    <link rel="stylesheet" href="../css/allvids.css">
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
          echo "<a href=\"account.php\">Mon compte</a>\n";
          echo "<a href=\"deconnexion.php\">Déconnexion</a>\n";
        }
       ?>
      <p id="bottom_nav">Site créé par Noituat</p>
    </div>
    <div class="main_body">


      <?php
        $requete = 'select distinct dispName, meta_name, picture_link from videos;';
        $result = $db->query($requete);
        $links = $result->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class=\"flex-container \">\n";
        for($cptAnime = 0; $cptAnime <= count($links)-1; $cptAnime ++){
          echo "\t\t<div class=\"column\">\n";
          echo "\t\t<h2 class=\"header-anime\">".$links[$cptAnime]["dispName"]."</h2>\n";
          echo "\t\t<a href=\"http://noituat.fr/pages/reader.php?meta_name=".$links[$cptAnime]["meta_name"]."\"><img id=\"".$links[$cptAnime]["meta_name"]."\" src=\"".$links[$cptAnime]["picture_link"]."\" alt=\"Image ".$links[$cptAnime]["meta_name"]."\"></a>\n";
          echo "\t\t</div>\n";
        }
        echo "</div>";

       ?>
    </div>
  </body>
</html>
