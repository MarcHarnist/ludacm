<?php

/** THE FILE GAME.PHP TO LONG:
*   Register.php created two
*    weeks after beginning...
*	Mauzé 61 M.L.Harnist.
*
*   This file is include in game.php
*
******************************
*/


/** NEW Personnage ?
*
*/

// $managermanager = new PersonnagesManager($db); // OBJECT CREATED ! Second file !

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
    $manager->add($perso); // The name is free: create a new player in data base
    
    $name = htmlspecialchars($perso->name());
	$message->setGreen("Bienvenue $name ! Vous démarrez avec $lifeStart vies."); // Welcome message will be show on line 118
    $jour=$perso->born();
    $jour=date('d/m/Y à h:m:s ', $jour);
    // $message.= "<p>Vous êtes bien enregistré le $jour. Merci.</p>";
  }
}
