<?php
  session_start();
  if(isset($_SESSION) && !empty($_SESSION)){
    header('Location: http://noituat.fr/index.php');
    exit();
  }
    include '../php/conn.php';
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
    <a href="connexion.php">Connexion</a>
    <p id="bottom_nav">Site créé par Noituat</p>
  </div>

  <div class="connexion">
    <h1 id="msg"></h1>
    <form class="connexion" action="connexion.php" method="post" >
      <input id="pseudo" class="ipt_up" type="text" name="pseudo" value="" placeholder="Pseudo..." autocomplete="new-password">
      <input id="pass" type="password" name="password" value="" placeholder="Mot de passe..." autocomplete="new-password">
      <button id="btn_left" type="submit" value="submit" name="button" >Me connecter</button>
    </form>
    <button type="button" onclick="window.location.href='inscription.php'" name="button">Inscription</button>
    <?php
      if(isset($_POST) && (!empty($_POST["pseudo"]) && !empty($_POST["password"]))){
        try{
          $check = "select rank, pass from `users` where (`pseudo` like \"".$_POST["pseudo"]."\");";
          $result = $db->query($check);
          $check = $result->fetch();


          if(!empty($check)){

            $var1 = $_POST["password"];
            if(password_verify($var1, $check["pass"])){
              $_SESSION["pseudo"] = $_POST["pseudo"];
              $_SESSION["rank"] =  $check["rank"];
              header('Location: http://noituat.fr/index.php');
              exit();
            }
            else{
              echo "<script>";
              echo "\n\t\tdocument.getElementById('msg').textContent=\"Identifiants de connexion incorrects !\";";
              echo "\n\t\tdocument.getElementById(\"msg\").style.opacity=\"100%\";";
              echo "\n\t</script>\n";
            }
          }
          else{
            echo "<script>";
            echo "\n\t\tdocument.getElementById('msg').textContent=\"Identifiants de connexion incorrects !\";";
            echo "\n\t\tdocument.getElementById(\"msg\").style.opacity=\"100%\";";
            echo "\n\t</script>\n";
          }

        }
        catch (\Exception $e) {
          die('Erreur : ' . $e->getMessage());
        }
    }
   ?>
  </div>
 </body>
</html>
