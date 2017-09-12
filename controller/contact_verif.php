<?php 
 /*
           ______________
          |              |     
          |   Lud'ACM    |    
          |   9/8/2017   |  
          |______________|    
*/
session_start(); // if connected, display profil icon in menu
if (isset($_SESSION['perso'])){
  $perso = $_SESSION['perso'];
}
function chargerClasse($classname){
	require ROOT . 'classes/' . $classname . '.php';
}
spl_autoload_register('chargerClasse');
$messager = new Message();
$erreur = false;		

// Email du destinataire 
$destinataire = "harnist.marc@gmail.com"; // for tests 
$destinataire = $owner_mail; // $mail_du_site in config.php
$objet = "Mail du site web Lud'ACM";

// Récupération
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$capcha = htmlspecialchars($_POST['capcha']);
$capcha_reponse = $_POST['capcha_reponse'];
$header = "From: " . $_POST['email'];


// Vérifications

// Vérification du mail 
if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) {
  $messager->setRed(" Veuillez indiquer un email valide.");
  $erreur = true;
}	
if ( $email == "") {
  $messager->setRed(" Veuillez indiquer un email valide.");
  $erreur = true;
}
if ( $capcha == "" ) {
  $messager->setRed(' Vous avez oublié de répondre à la question "Je ne suis pas un robot".');
  $erreur = true;
} elseif ( $capcha != $capcha_reponse ){
  $messager->setRed(" Vous vous êtes trompé à la question \"Je ne suis pas un robot.\"");
  $erreur = true;
}
if ( $message == "" ) {
  $messager->setRed(" Vous avez oublié d'écrire un message !");
  $erreur = true;
}
//Il ne reste plus qu'à envoyer le mail si 0 erreur a été trouvée
if (!$erreur) {
  mail( $destinataire , $objet , $message , $header );
}

include(HEAD); 
include(MENU); 
include(PAGE);
include(FOOT); 