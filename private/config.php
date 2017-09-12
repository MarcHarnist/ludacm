<?php
  
$website_name   = "Lud'ACM";
// $domaine        = "ludacm";
$website_owner  = "Isabelle Harnist";
$webmaster      = "Marc Harnist";
$webmaster_mail = "harnist.marc@gmail.com";
$owner_mail     = "harnist.isabelle@gmail.com";
  
// Are-we working with WAMP ?
if($_SERVER['HTTP_HOST'] == 'localhost')
{ 
  // Yes. Url contains localhost
  $$website_url = "http://$_SERVER[SERVER_NAME]/ludacm/www";
  // exit($website_url);
  define('$website_url', $$website_url);
  define('ROOT','C:/wamp64/www/ludacm/www/'); 

}

  $url_admin = $$website_url . "/private/";
  ?>
  <!--<h1>Config is here</h1>-->