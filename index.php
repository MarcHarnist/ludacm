<?php

/*   MVC Ludacm.fr/index.php (See readme.txt) M. Harnist 2017 */

include_once("model/security.php");       // Verify private/.htaccess
include_once("model/config/config.php");     // all info about owners
include_once(MODEL . "connexion_sql/connexion_sql_game.php");   // db

if(!empty($_GET['page']) && is_file(ROOT . 'controller/' . $_GET['page'].'.php')){
	$page = $_GET['page'];//$_GET["page"] get written in url after "page"
	$title = ucfirst(str_replace("_"," ", $page));//in header
	$file = $page . '.php';
	$file_path = CONTROLLER . $file;
	define('PAGE', VIEW . $file);
	include($file_path);
} 
else {
	$title = "Accueil"; // in header
	$page = "accueil";// For link css in header
	define('PAGE', VIEW . 'accueil.php');
	include(CONTROLLER . 'accueil.php');
}