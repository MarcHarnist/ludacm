<?php
//register autoload which will load the classes
function chargerClasse($classname) {  // Upload OOP classes
  require ROOT . 'classes/' . $classname.'.php'; // names of each class
}
spl_autoload_register('chargerClasse'); //maintenant les class sont chargées
session_start(); //Call session_start() after autoload 
if (isset($_SESSION['perso'])){ // If session perso exists, restore object
  $perso = $_SESSION['perso'];


$duree_connexion_de_ce_joueur = $save_pseudo = ""; // create var

$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist

// must be deplaced in a page deconnection.php

  $manager = new PersonnagesManager($db); // Second fichier !
  $perso = $_SESSION['perso']; // recovered object

  $nowconnection = $perso->nowconnection(); // $today BETTER name?
  // echo "Connexion aujourd'hui (\$nowconnection)= ", date('d/m/Y h:m:s ', $nowconnection),"<br />";// $today_connection better?
  // echo "\$totalconnection avant calcul=",$perso->totalconnection(),"<br />";
  $time = (time()+7200);// corriger dans une classe class.time.php !
  // echo "\$time avant calcul=",date('d/m/Y h:m:s', $time),"<br />";
  $totalconnection = $time-$nowconnection;
  // echo "\$totalconnection = \$nowconnection-\$time = ",$totalconnection;
  // echo "<br />vous avec joué (\$totalconnection) : ", $totalconnection,' secondes <br />';
  $perso->setTotalconnection($totalconnection);
  $time = (time()+7200);
  $perso->setLastconnection($time);// informe the lastconnection in db before quit

  $manager->update($perso);// IMPORTANT: HERE THE DB IS UPDATED !
  session_destroy(); // The session is closed
  // header('Location: ' . PAGE_URL . 'bienvenue'); // The link "deconnexion" sent you there
  
}
	include(HEAD); 
	include(MENU); 
	include(PAGE);
	include(FOOT); 
