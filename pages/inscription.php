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
    <form class="connexion" action="inscription.php" method="post">
      <input class="ipt_up" id="pseudo" type="text" name="pseudo" value="" placeholder="Pseudo..." autocomplete="off">
      <input class="ipt_up" id="pass" type="password" name="password" value="" placeholder="Mot de passe..." autocomplete="off">
      <input class="ipt_up" id="rwpass" type="password" name="rw_password" value="" placeholder="Répétez le mot de passe..." autocomplete="off">
      <input class="ipt_up" id="email" type="email" name="email" value="" placeholder="Email..." autocomplete="off">
      <button id="btn_reg" type="submit" value="submit" name="button">Je m'inscris</button>
    </form>
    <?php
    if(isset($_POST) && !empty($_POST)){ //Si la variable POST existe et qu'elle n'est pas nulle (1er démarrage de la page)
      if(!empty($_POST["pseudo"]) && !empty($_POST["password"]) && !empty($_POST["rw_password"]) && !empty($_POST["email"])){
        // On vérifie que chacun des champs ont été remplis !-----------------------------------------------------------------------
        $check = "select * from `users` where (`pseudo` like \"".$_POST["pseudo"]."\") OR (`email` like \"".$_POST["email"]."\");";
        $result = $db->query($check);
        $check = $result->fetch();
        if(empty($check)){ // Si il n'y a pas de compte deja présents dans la bdd avec le meme pseudo ou la meme adresse mail :
          if($_POST["password"] == $_POST["rw_password"]){ // On vérifie que les 2 mots de passes sont identiques !
            try {
              $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
              if($hash == FALSE){
                echo "<script>";
                echo "alert(\"Problème lors de la création du mot de passe !\")";

                echo "</script>";

                header('Location: http://noituat.fr/pages/connexion.php');
                exit();
              }
              else{
                $insert = "insert into users (`pseudo`, `pass`, `email`) values ('".$_POST["pseudo"]."', '".$hash."', '".$_POST["email"]."');";
                if($db->query($insert) == true){ // Si l'insert a reussi
                  header('Location: http://noituat.fr/pages/connexion.php');
                  exit();

                }
                else{
                  echo "<script>";
                  echo "\n\t\tdocument.getElementById('msg').textContent=\"Une erreur coté serveur est survenue, réessayez plus tard !\";";
                  echo "\n\t\tdocument.getElementById(\"msg\").style.opacity=\"100%\";";
                  echo "\n\t</script>\n";
                }
              }
            }
            catch (Exception $e) {
              die('Erreur : ' . $e->getMessage());
            }
          }
          else{ //Si les 2 mots de passes ne correspondent pas !
            echo "<script>";
            echo "\n\t\tdocument.getElementById('msg').textContent=\"Les 2 mots de passes ne correspondent pas !\";";
            echo "\n\t\tdocument.getElementById(\"msg\").style.opacity=\"100%\";";
            echo "\n\t\tdocument.getElementById(\"pass\").style.border=\"2px solid red\";";
            echo "\n\t\tdocument.getElementById(\"rwpass\").style.border=\"2px solid red\";";
            echo "\n\t</script>\n";
          }
        }
        else{
          echo "<script>";
          echo "\n\t\tdocument.getElementById('msg').textContent=\"Il y a deja un comtpe avec ce pseudonyme ou cette adresse mail !\";";
          echo "\n\t\tdocument.getElementById(\"msg\").style.opacity=\"100%\";";
          echo "\n\t</script>\n";

        }
      }
      else{
        echo "<script>";
        echo "\n\t\tdocument.getElementById('msg').textContent=\"Vous n'avez pas remplis tous les champs !\";";
        echo "\n\t\tdocument.getElementById(\"msg\").style.opacity=\"100%\";";
        echo "\n\t</script>\n";

        //On vérifie que tous les champs ont été remplis, si ce n'est pas le cas, on encadre en rouge les champs non renseignés !
        if(empty($_POST["pseudo"])){
          echo "<script>";
          echo "\n\t\tdocument.getElementById(\"pseudo\").style.border=\"2px solid red\";";
          echo "\n\t</script>\n";
        }
        if(empty($_POST["password"])){
          echo "<script>";
          echo "\n\t\tdocument.getElementById(\"pass\").style.border=\"2px solid red\";";
          echo "\n\t</script>\n";
        }
        if(empty($_POST["rw_password"])){
          echo "<script>";
          echo "\n\t\tdocument.getElementById(\"rwpass\").style.border=\"2px solid red\";";
          echo "\n\t</script>\n";
        }
        if(empty($_POST["email"])){
          echo "<script>";
          echo "\n\t\tdocument.getElementById(\"email\").style.border=\"2px solid red\";";
          echo "\n\t</script>\n";
        }
        // ---------------------------------------------------------------------------------------------------------------------------
      }
    }
    ?>
  </div>
</body>
</html>
