<?php
/*   ______________
    |              |         
    |   Lud'ACM    |        
    |   9/8/2017   |    
    |______________|        
*/
session_start(); //Call session_start() after autoload 
if (isset($_SESSION['perso'])){
  $perso = $_SESSION['perso'];
  // echo "<h2 class=\"white\">A session perso exists: display profil icone in menu.</h2>";
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="<?php echo $website_url; ?>/style.css">
    <link rel="stylesheet" href="<?php echo $website_url; ?>/view/accueil/accueil.css"><!-- second stylesheet priority -->
	<meta charset="UTF-8" />
    <title>Lud'ACM HomePage</title>
	<meta name="viewport" content="width=device-width"/>
  </head>
  <body>
    <div id="page">
      <?php
      $file = "inc/menu_game.php";
      if(file_exists($file)){
      	include($file);
      	}
      	else{
      		echo "Le fichier $file est introuvable... ";
      	}
      	?>

      <h1 class="white center">LUD'ACM</h1>
       
      <h2 class="white center size50 breakGreat">L'accueil de loisirs dont vous êtes le héros...</h2>
      
      <form class="center" method="post" action="game.php">
          <input class="submit" type="submit" value="Commencer l'aventure" />
      </form>
      <form class="center" method="post" action="contact.php">
          <input class="submit" type="submit" value="Nous contacter" />
      </form>
      <!-- Pied de page                             -->
      <?php
	    include($www_real_path.'/inc/footer.php');

// Tools:
include_once('model/show/SuperGlobal.php');
	  ?>