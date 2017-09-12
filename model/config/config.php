<?php
ini_set('display_errors',1); // Display OVH errors messages

if($_SERVER['HTTP_HOST'] == 'localhost'){ // If we are on WAMP
$website_url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
}
else{     // We are online on the web
$website_url = $_SERVER['SCRIPT_URI'];
}
$webmaster       =  "Marc Harnist";
$website_owner   =  "Isabelle Harnist";
$webmaster_mail  =  "harnist.marc@gmail.com";
$owner_mail      =  "harnist.isabelle@gmail.com";
define('WEBSITE_NAME', "Lud'ACM");

// Real path
define('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME'])); 
      //ROOT online  = /home/ludacmfrif/www/  
      //ROOT on wamp = C:/wamp64/www/MVC/www/
define('VIEW', ROOT . 'view/');
define('MODEL', ROOT . 'model/');
define('CONTROLLER', ROOT . 'controller/');
define('INC', VIEW . 'inc/');
define('HEAD', INC . 'header.php');// HEADER is reserved
define('MENU', INC . 'menu.php');
define('FOOT', INC . 'footer.php');

// URL
define('WEBSITE_URL', str_replace('index.php','',$website_url));
define('ADMIN_URL', WEBSITE_URL . 'private/');
define('PAGE_URL', WEBSITE_URL . 'index.php?page=');
define('CSS_URL', WEBSITE_URL . 'css/');
define('VIEW_URL', WEBSITE_URL . 'view/');
define('IMG_URL', WEBSITE_URL . 'view/img/');