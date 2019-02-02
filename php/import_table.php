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
  <link rel="stylesheet" href="../css/import_script.css">
</head>
<body>

  <form class="" action="import_table.php" method="post">
    <label for="meta_name">Meta de l'anime :</label>
    <input type="text" name="meta_name" value="">
    <!--
    <label for="picture_link">Lien vers l'image :</label>
    <input type="text" name="picture_link" value=""> -->

    <input type="hidden" name="nbr_saison" value="<?php echo $_POST["nbr_saison"]; ?>">
    <input type="hidden" name="nbr_episode" value="<?php echo $_POST["nbr_episode"]; ?>">

    <input type="hidden" name="dispName" value="<?php echo $_POST["dispName"]; ?>">
    <input type="submit" name="submit" value="Je valide et je termine">

    <?php

    for ($cptSaison=1; $cptSaison <= $_POST["nbr_saison"] ; $cptSaison++) {
      echo "<fieldset>";
      echo "<legend>Saison ".$cptSaison."</legend>";
      for ($cptEpisode=1; $cptEpisode <= $_POST["nbr_episode"]; $cptEpisode++) {
        echo "<div>";

        // echo "<label>Saison : </label>";
        echo "<input class=\"saison\"  type=\"hidden\" name=\"saison".$cptSaison."\" value=\"".$cptSaison."\">";

        // echo "<label>Episode : </label>";
        echo "<input class=\"episode\" type=\"hidden\" name=\"episode".$cptEpisode."\" value=\"".$cptEpisode."\">";

        echo "</div>";
      }
      echo "</fieldset>";
    }
    ?>
  </form>

  <?php
  if(isset($_POST) && !empty($_POST["meta_name"])){
    // var_dump($_POST);

    for ($cptSaison=1; $cptSaison <= $_POST["nbr_saison"] ; $cptSaison++) {

      for ($cptEpisode=1; $cptEpisode <= $_POST["nbr_episode"] ; $cptEpisode++){
        $episode = "S".$cptSaison."_EP".$cptEpisode;
        $name = "link-s".$cptSaison."-ep".$cptEpisode;
        $picture = "http://noituat.fr/pictures/picture_".$_POST["meta_name"].".jpg";
        $link = "http://noituat.fr/videos/".$_POST["meta_name"]."/".$episode.".mp4";
        // var_dump($link, $picture);
        try {
          $request = "insert into videos (dispName, meta_name, saison, episode, name , picture_link, link) values (\"".$_POST["dispName"]."\", \"".$_POST["meta_name"]."\", ".$cptSaison.", ".$cptEpisode.", \"".$episode."\", \"".$picture."\", \"".$link."\");";
          // var_dump($request, "\n");
          $db->query($request);
        }
        catch (\Exception $e) {
          var_dump($e);
        }
      }
    }
    header('Location: http://noituat.fr/pages/videos.php');
    exit();  }

  ?>


</body>
</html>
