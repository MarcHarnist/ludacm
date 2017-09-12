<?php
/**
*  Hy,
*  Trying to show the MVC of my project. I'll need several days to install all files.  
*  This fill is installed in "controller"  directory
*  Thanks for all reviews.
*  Marc Harnist 2017/08/31
*/

include_once("model/get_player.php"); // include model/ludacm/get_player.php
$players = get_player(0,500);//500 = all players !

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($players as $cle => $player)
{
	// name, life, mission, agility, born, password, lastconnection, nowconnection, totalconnection
	
    $players[$cle]['id'] = nl2br(htmlspecialchars($player['id']));
    $players[$cle]['name'] = nl2br(htmlspecialchars($player['name']));
    $players[$cle]['life'] = htmlspecialchars($player['life']);
    $players[$cle]['mission'] = htmlspecialchars($player['mission']);
    $players[$cle]['agility'] = htmlspecialchars($player['agility']);
    $players[$cle]['born'] = htmlspecialchars($player['born']);
    $players[$cle]['password'] = htmlspecialchars($player['password']);
    $players[$cle]['lastconnection'] = htmlspecialchars($player['lastconnection']);
    $players[$cle]['nowconnection'] = htmlspecialchars($player['nowconnection']);
    $players[$cle]['totalconnection'] = htmlspecialchars($player['totalconnection']);
}

function chargerClasse($classname) {
//enregistre l'autoload qui va charger les classes
  require ROOT . 'classes/' . $classname.'.php'; // names of each class
}
spl_autoload_register('chargerClasse'); //maintenant les class sont chargées
session_start(); //Call session_start() after autoload

// Create value: // AFTER: CREATE OBJECT !
$agilityPoint = 1; // Point for a good answer
$lifeStart = 5; // Number of lives at starting game
$agilityPointFor1Life = 7; // Number of agility point to win a life
$duree_connexion_de_ce_joueur = ""; // déplacer dans les classes
$save_pseudo = ""; // WHY NOT $perso->name(); ?

$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist
$manager = new PersonnagesManager($db); // Object created: Data base manager

if (isset($_SESSION['perso'])){ // If session perso exists, restore object
  $perso = $_SESSION['perso'];
}

if(isset($perso)){
  // LAST QUESTION ? GAME END ? ### Do here a constant class ::
  $mission=$perso->mission();
}
// On affiche la page (vue)
	include(HEAD); // defined in config.php
	include(MENU); // defined in config.php
	include(PAGE); // defined in ROOT/index.php
	include(FOOT); // defined in config.php 
	
		// Affichage des superglobales en cas de besoin
		echo "<pre>",
		print_r($GLOBALS);
		"</pre>";
