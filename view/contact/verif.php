<?php 
/*             ______________
            |              |     
            |   Lud'ACM    |    
            |   9/8/2017   |  
            |______________|    
  
 /*
  
Je renseigne le titre de la page dans une variable qui servira plusieurs fois.*/
$title ="Formulaire de contact";

//Inclusion of config.php    
$www_real_path = "/home/ludacmfrif/www";
if($_SERVER['HTTP_HOST'] == 'localhost'){
  $www_real_path = "C:\wamp64\www\www\ludacm"; //For WAMP
}
// Useful variables are in config.php
include($www_real_path.'/model/config/config.php');
    
if(isset($title))
{
  $titre = "<title>" . $title . "</title>";
}
else
{
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
    $file = $www_real_path . "/inc/menu_game.php";
    if(file_exists($file)){
        include($file);
        }
        else{
            echo "Le fichier $file est introuvable... ";
        }

		
		
$erreur = "";		
// Email du destinataire 
$destinataire = $owner_mail; // $mail_du_site renseigné dans config.php
// Récupération
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$capcha = htmlspecialchars($_POST['capcha']);
$capcha_reponse = $_POST['capcha_reponse'];
$header = "From: " . $_POST['email'];

// Vérification 

// Vérification du mail 
if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email))
{
  echo " Veuillez indiquer un email valide.";
  $erreur = true;
}	

if ( $email == "")
{
  $erreur = true;
  echo " Veuillez indiquer un email valide.";
}

if ( $capcha == "" ) {
  echo ' Vous avez oublié de répondre à la question "Je ne suis pas un robot".';
  $erreur = true;
} elseif ( $capcha != $capcha_reponse ){
  echo " Nous sommes désolés: Vous vous êtes trompé à la question \"Je ne suis pas un robot.\"";
  $erreur = true;
}

if ( $message == "" ) {
  echo " Oups ! Vous avez oublié d'indiquer un message !";
  $erreur = true;
}

//Ceci fait, il ne nous reste plus qu'à envoyer le mail si aucune erreur a été trouvée :

$objet = "Mail du site web $website_name";
/* Envoi du mail */
if ( !$erreur ) {
  mail( $destinataire , $objet , $message , $header );
  echo "<h1 class=\"white \">Merci !</h1>
        <h2 class=\"white breakGreat\">Merci pour votre message, il a bien été envoyé: nous vous répondrons dans les meilleurs délai.</h2>
        <h2><form class=\"center\" method=\"post\" action=\"../index.php\">
    <input class=\"start\" type=\"submit\" value=\"Retourner à l'accueil\" />
   </form></h2>
   ";
}
else
{
?><div id="page">
  <p>Mes données ne sont pas perdues: <a href="#" onclick="history.go(-1);">J'y retourne en un clic !</a></p>
  </div>
<?php
}
?>
		
<!-- Pied de page                             -->
<?php include($www_real_path.'/inc/footer.php');?>	
