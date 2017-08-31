<?php

/**  A PLAYER COMES BACK !
*
*    This file: Connection.php is
*    included in game.php
*
***********************************/
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
    if(empty($_POST['password']))
    {
      $message->setRed("Vous avez oublié le mot de passe !");
      unset($perso);    
    }
    else
    {
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
    $message->setRed("Ce pseudo n'existe pas ! Vous pouvez vous enregistrer..."); // S'il n'existe pas, on affichera ce message.
  }
}
