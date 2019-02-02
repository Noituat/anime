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
    <link rel="stylesheet" href="../css/import.css">
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

    <div class="videos-import">
      <form class="form_saison" action="../php/import_table.php" method="post">
        <fieldset>
          <h3>Combien de saison souhaitez vous importer ?</h3>
          <select class="select_saison" name="nbr_saison">
            <option selected disabled>Nombre de saisons :</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>

          <label for="nbr_episode">Nombre d'épisodes par saison :</label>
          <input id="nbr_episode" type="number" name="nbr_episode" value="">

          <label for="dispName">Nom de l'anime :</label>
          <input id="dispName" type="text" name="dispName" value="">
          <input id="submit" type="submit" name="submit" value="Je valide et et passe à la suite ->">

        </fieldset>
      </form>




    </div>

  </body>
</html>
