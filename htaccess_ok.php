<?php
if($_SERVER['HTTP_HOST'] !== 'localhost'){
  // $page = "$www_real_path.'/private/.htaccess";
  $page = "$www_real_path/private/z__/.htaccess";
  if (file_exists($page) == FALSE){
    /* Email du destinataire (mettez ici votre email) */
    $destinataire = "mymail@yahoo.fr"; // $mail_du_site renseigné dans config.php
    $objet = "Alerte ! Mail automatique du site web $website_name";
    $message = "Alerte ! Private est en danger: .htaccess est absent ! Il devrait se trouver ici: $page";
    $header = "From: " . $destinataire;
    /* Envoi du mail */
    mail( $destinataire , $objet , $message , $header );  
    }
  $mail_du_site = "harnist.marc@gmail.com";
  $proprietaire_du_site = "Marc Harnist";
  $url_admin = "$url_du_site/private"; // Called in menu of the footer
}
/* Code which was in config.php:
  // private is protected?
  $file = "$www_real_path/private/.htaccess";
  if (file_exists($file) == FALSE) 
  {
    $destinataire = $webmaster_mail;
    $objet = "Alerte ! Mail automatique du website web $website_name";
    $message = "Alerte ! Private est en danger: .htaccess est absent ! Il devrait se trouver ici: $file";
    $header = "From: " . $destinataire;
    // Envoi du mail
    mail( $destinataire , $objet , $message , $header );  
  }
  */
?>