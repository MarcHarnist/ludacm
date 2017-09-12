<!-- Header (en-tête) -->

<?php

  //////////////////////////////////////////////////////////////
  //                              //
  //  Site démo pour une formation ou une embauche avec CV  //
  //                              //
  //////////////////////////////////////////////////////////////
  $url = "/home/ludacmfrif/www"; 
if($_SERVER['HTTP_HOST'] == 'localhost') {
	// we are on WAMP
  $url = "C:\wamp64\www\ludacm/www";
}
$url .= "/private/config.php";
include($url);



//provisoire à supprimer pour vamp
// include("/home/ludacmfrif/www/private/config.php");


  
if(isset($title) == false){
$title ="";
}
?>
<!doctype html>
<html lang="fr">

<head>
 	<link rel="stylesheet" href="<?php echo $website_url; ?>/private/style_private.css">
    <title><?=$title;?></title>
</head>
  
<body>
<?php echo "<h3><a href=\"\">$title</a></h3>";
$file = "/home/ludacmfrif/www/private/inc/menu.php";//$www_real_path informed in .php
include($file);
?>
<!-- Fin du header (en-tête) -->
