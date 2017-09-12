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
    $players[$cle]['lastquestion'] = htmlspecialchars($player['lastquestion']);
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

if (isset($_POST['utiliser']) && isset($_POST['name']) && isset($_POST['password'])) // Si on a voulu utiliser un personnage.
{
  $save_pseudo=($_POST['name']);// To conserve the value in form
  if(empty($_POST['name']))
  {
    $message->setRed("Choisissez un pseudo");
    unset($perso);
  }
  elseif ($manager->exists($_POST['name'])) // Si celui-ci existe.
  {  
    if(empty($_POST['password'])) {
      $message->setRed("Vous avez oublié le mot de passe !");
      unset($perso);    
    }
    else {
      $perso = new Personnage(['name' => $_POST['name']]); // On crée un nouveau personnage.
      // $perso->setLastconnection($born);
      $password = $_POST['password'];
      $hash = hash('ripemd160',$password);
      $perso = $manager->get($save_pseudo);
      $hash_db = $perso->password();
      if($hash_db === $hash) // If the player had informe
      {        //the good password we continue
        // THE PLAYER IS WELL CONNECTED  //  
        $perso->setNowconnection(time());// informe value for calcul at deconnection
        $perso = $manager->get($_POST['name']);
        $name = $perso->name();
        $life = $perso->life();
        $mission = $perso->mission(); // Where did the player leave last time?
        
        $cle = $mission;
        
        $totalconnection = $perso->totalconnection();
        $heure = intval(abs($totalconnection / 3600));
        $totalconnection = $totalconnection - ($heure * 3600);
        $minute = intval(abs($totalconnection / 60));
        $totalconnection = $totalconnection - ($minute * 60);
        $seconde = $totalconnection;
        $duree_connexion_de_ce_joueur= " $heure H : $minute min : $seconde sec. "; 
      }
      else
      {
        $message->setRed("Mot de passe érroné...</h3>");
        unset($perso);
        // exit();
      }
    }
  }
  else
  {
    $message->setRed("Ce pseudo n'existe pas ! Une erreur dans le nom? ou  <a href=\" " . PAGE_URL . "register\">S'enregistrer avec ce pseudo</a>"); // S'il n'existe pas, on affichera ce message.
  }
}

if(isset($perso)){
  // LAST QUESTION ? GAME END ? ### Do here a constant class ::
  $mission=$perso->mission();
  $lastquestion = $perso->lastquestion();
}
// Display the page (view)
	include(HEAD); 
	include(MENU); 
	include(PAGE);
	include(FOOT); 
