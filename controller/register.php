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
	// name, life, mission, agility, born, password, lastconnection, nowconnection, totalconnection, lastquestion
	
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
    $players[$cle]['lastquestion'] = nl2br(htmlspecialchars($player['lastquestion']));
}

//register autoload which will load the classes
function chargerClasse($classname) {  // Upload OOP classes
  require ROOT . 'classes/' . $classname.'.php'; // names of each class
}
spl_autoload_register('chargerClasse'); //maintenant les class sont chargées
session_start(); //Call session_start() after autoload

// Create vars and values
$agilityPoint = 1; // Point for a good answer
$lifeStart = 5; // Number of lives at starting game
$agilityPointFor1Life = 7; // Number of agility point to win a life
$duree_connexion_de_ce_joueur = $save_pseudo = ""; // create var
// Create OOP objects
$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist
$manager = new PersonnagesManager($db); // Object created: Data base manager

if (isset($_SESSION['perso'])) // Si la session perso existe, on restaure l'objet.
{
  $perso = $_SESSION['perso'];
}
if (isset($_POST['creer']) && isset($_POST['name']) && isset($_POST['password'])) // Si on a voulu créer un personnage à la page
{
  $save_pseudo=($_POST['name']);// To conserve the value in form
  $perso = new Personnage(['name' => $_POST['name']]); // On crée un nouveau personnage.
  $password = $_POST['password'];
  $perso->setPassword($password);
  // echo $perso->password(); // return: $password
  // var_dump($password);
  $hash = hash('ripemd160',$password);// the password is crypted for security!
  if (!$perso->nameValide()) // cannot be empty
  {
    $message->setRed("La case pseudo est vide: choisissez un pseudo.");
    unset($perso);
  }
  elseif ($manager->exists($perso->name()))// go read in the dbtable if name is free
  {
    $message->setRed("Le nom du personnage est déjà pris. Merci de choisir un autre pseudo.");
    unset($perso);
  }
  elseif(!$perso->passwordValide()) // cannot be empty
  {
    $message->setRed("Vous avez oublié de choisir un mot de passe ! Il sera utile pour protéger vos gains dans la partie...");
    unset($perso);        
  }
  else // Everythings are ok.  The player can be registered
  { 
    // Here the player is registered. He receive lifes (set above on top: .
    $life = $lifeStart; // $lifeStart informed on top at var creations
    $mission=0; // the player starts with 0 mission done.
    $agility=0; // the player starts with 0 mission done.
    $lastconnection=(time());
    $datee=date('d/m/Y h:m:s', $lastconnection);
    $nowconnection=(time()+(2*3600));
    $totalconnection=0;
    $born=(time()+((2*3600)));// date of register (creation)
    $perso->setBorn($born); // register date. The player is born
    $date=date('d/m/Y h:m:s ', $born);
    $perso->setLife($life); // $life = $lifeStart for begin a good play. Life is ISABELLE idea !
    $life = $perso->life();
    $perso->setAgility($agility); // register date. The player is born
    $perso->setPassword($hash);// hashed password registered in data base player
    $perso->setLastconnection($lastconnection);
    $show=$perso->lastconnection();
    $perso->setMission($mission); // 0 mission yet!
    $perso->setNowconnection($born);//cannot be null
    $perso->setTotalconnection($totalconnection);//cannot be null
	$perso->setLastquestion(0);
    $manager->add($perso); // The name is free: create a new player in data base
    $name = htmlspecialchars($perso->name());
    $jour=$perso->born();
    $jour=date('d/m/Y à h:m:s ', $jour);
    // $message.= "<p>Vous êtes bien enregistré le $jour. Merci.</p>";
  }
}
if(isset($perso)){
  $mission=$perso->mission();// Which level has reached the gamer?
}

// On affiche la page (vue)
	include(HEAD); 
	include(MENU); 
	include(PAGE);
	include(FOOT); 
