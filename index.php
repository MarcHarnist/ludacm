<?php
$www_real_path = "/home/ludacmfrif/www";//On line path
if($_SERVER['HTTP_HOST'] == 'localhost'){
  $www_real_path = "C:\wamp64\www\ludacm\www"; //For WAMP
}
else{
include_once("model/security/htaccess_ok.php");
}
include_once('model/error/OvhErrorMessage.php');
include_once("model/config/config.php"); 

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once("controller/accueil/index.php");//include controller/ludacm/index.php
}

// Tools:
// var_dump();
// exit();
// include_once('model/show/SuperGlobal.php');