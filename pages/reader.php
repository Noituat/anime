<?php
  session_start();
  include '../php/conn.php';
  $_SESSION["meta_name"] = $_GET["meta_name"];
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow"/>

    <link rel="stylesheet" href="../css/video.css">
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
          session_destroy();
          echo "<script>";
          echo "alert('Vous devez être connecté pour accéder à cette page !');\n";
          echo "window.location = \"http://noituat.fr/index.php\";";
          echo "</script>";
        }
        else{

          echo "\n\n";
          echo "<script>";
          echo "\n\t\tdocument.getElementById('msg_bvn').textContent=\"Bienvenue ".$_SESSION["pseudo"]." !\";";
          echo "\n\t</script>\n";
          echo "<a href=\"account.php\">Mon compte</a>";
          echo "<a href=\"deconnexion.php\">Déconnexion</a>";

        }

       ?>
      <p id="bottom_nav">Site créé par Noituat</p>
    </div>

    <?php
      $request = 'select distinct picture_link, dispName from videos where (meta_name like "'.$_SESSION["meta_name"].'");';
      $result = $db->query($request);
      $picture_link = $result->fetch();

      echo "<h1 id=\"picture_link\">".$picture_link["dispName"]."</h1>\n";
      echo "\t<img id=\"picture_img\" src=\"".$picture_link["picture_link"]."\">\n";

      echo "<form action=\"reader.php?meta_name=".$_SESSION["meta_name"]."\" method=\"post\" name=\"selectSaison\">\n";

      echo "\t<select id=\"saison\" name=\"video_select\">\n";

      $requete = 'select distinct saison from videos where meta_name like "'.$_SESSION["meta_name"].'";';
      $result = $db->query($requete);
      $saison = $result->fetchAll(PDO::FETCH_ASSOC);
      $requete = 'select id, link, episode, saison from videos where meta_name like "'.$_SESSION["meta_name"].'";';
      $result = $db->query($requete);
      $episode = $result->fetchAll(PDO::FETCH_ASSOC);

      for($cptSaison = 0; $cptSaison <= count($saison)-1; $cptSaison ++){
        echo "\t\t<optgroup label=\"Saison ".$saison[$cptSaison]["saison"]."\">\n";
        for($cptEpisode = 0; $cptEpisode <= count($episode)-1; $cptEpisode++){
          if($episode[$cptEpisode]["saison"] == $saison[$cptSaison]["saison"]){
            echo "\t\t\t<option value=\"S".$saison[$cptSaison]["saison"]."_EP".$episode[$cptEpisode]["episode"]."\">Episode ".$episode[$cptEpisode]["episode"]."</option>\n";
          }
        }
        echo "\t\t</optgroup>\n";
      }
      echo "\t</select>\n";
      echo "\t<input id=\"readonly\" type=\"text\" name=\"meta_name\" value=\"".$_SESSION["meta_name"]."\" readonly>";
      echo "\t\t<input id=\"submit\" type=\"submit\" value=\"J'ai choisi mon épisode ->\" onclick=\"hideImg()\">\n";
      echo "\t</form>\n";
    ?>
    </div>
    <?php
    if(isset($_SESSION["meta_name"]) && isset($_POST) && !empty($_POST["video_select"])){
      $request = 'select link from videos where ((meta_name like "'.$_SESSION["meta_name"].'") && (name like "'.$_POST["video_select"].'"));';

      $result = $db->query($request);
      $video = $result->fetch();

      $name = $_POST["video_select"];
      $link = $video["link"];
      $picture = $video["picture_link"];
      echo "<h1 id=\"video_title\">".$name."</h1>";

      echo "<video  id=\"video\" src=\"".$link."\" poster=\"".$picture."\" controls width=\"900\" height=\"500\"></video>\n";
      echo "<script> document.getElementById(\"picture_img\").style.display=\"none\"; </script>\n";
    }

     ?>

    <script src="../js/video.js" charset="utf-8"></script>
    </body>
  </body>
</html>
