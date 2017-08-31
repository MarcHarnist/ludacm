<?php
 /*
           ______________
          |              |     
          |   Lud'ACM    |    
          |   9/8/2017   |  
          |______________|    


Je renseigne le titre de la page dans une variable qui servira plusieurs fois.*/
$title ="Formulaire de contact";
//Inclusion of config.php    
include_once("model/path/real_path.php");
include($www_real_path.'/model/config/config.php');
         // Useful variables are in config.php
if(isset($title)){
$titre = "<title>" . $title . "</title>";
}
else {
$title ="";
}
?>
<!doctype html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="<?php echo $website_url; ?>/style.css">
  <link rel="stylesheet" href="<?php echo $website_url; ?>/view/contact/contact.css">
  <?=$titre;?>
	<meta name="viewport" content="width=device-width"/>
</head>
  
<body>
  
  <!-- Page > hauteur mini: séparer menus haut et bas -->
  <div id="page">
	
<?php 

//<!-- Fin de l'entête ------------------>

$capcha = rand(1,5); // on prépare $capcha
?>

  <?php
  $file = $www_real_path . "/inc/menu_game.php";
  if(file_exists($file)){
      include($file);
      }
      else{
          echo "Le fichier $file est introuvable... ";
      }
  ?>
  <h2 class="white center break top50">Contactez-nous!</h2>
  <form action="view/contact/verif.php" method="post">
    <p class = "white center">
      Votre email : <br />
      <input size="30" name="email" type="text" />
    </p>
    <p class = "white center">
      Le message : <br />
      <textarea name="message" rows="5" cols="30"></textarea>
    </p>
    <p class = "white center">
      Je ne suis pas un robot: <?php $capcha = rand(1,5); echo $capcha;?> + 1 =<input name="capcha_reponse" size="3" />
    <input type="hidden" name="capcha" value="<?php $capcha++; echo $capcha;?>" />
    </p>
    <p class = "white center">
      <input class="start" type="submit" value="Envoyer" /> 
    </p>
  </form>
<!-- Pied de page                             -->
<?php include($www_real_path.'/inc/footer.php');?>