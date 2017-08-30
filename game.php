<?php
$www_real_path = "/home/marcharnss/www/ludacm";//On line path
if($_SERVER['HTTP_HOST'] == 'localhost'){
  $www_real_path = "C:\wamp64\www\www\ludacm"; //For WAMP
}
else{
include_once("model/security/htaccess_ok.php");
}
$file_name_ext= basename($_SERVER['PHP_SELF']);//return this file file's name.php
$file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name_ext);//return: file
$dir=$file_name; // dir = file
include_once('model/error/OvhErrorMessage.php');
include_once("model/config/config.php"); //connect with connexion_sql_ludacm.php
include_once("model/connexion_sql/connexion_sql_$file_name_ext"); //connect with connexion_sql_ludacm.php

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once("controller/$dir/index.php");//include controller/ludacm/index.php
}

// Tools:
// var_dump();
// exit();
// include_once('model/show/SuperGlobal.php');