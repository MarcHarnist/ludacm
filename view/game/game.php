<?php

// The HTML view of the charged page start at 225th line
function chargerClasse($classname)//enregistre l'autoload qui va charger les classes
{
  require $classname.'.php'; // names of each class
}
spl_autoload_register('chargerClasse'); //maintenant les class sont chargées
session_start(); //Call session_start() after autoload 

// Create value: // AFTER: CREATE OBJECT !
$agilityPoint = 1; // Point for a good answer
$lifeStart = 5; // Number of lives at starting game
$agilityPointFor1Life = 7; // Number of agility point to win a life
$duree_connexion_de_ce_joueur = ""; // déplacer dans les classes
$NombreDeQuestion = count($question_save);
$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist

$save_pseudo = ""; // WHY NOT $perso->name(); ?

if (isset($_GET['deconnexion']))// Le player s'est déconnecté?
{
  $manager = new PersonnagesManager($db); // Second fichier !
  $perso = $_SESSION['perso']; // recovered object

  $nowconnection = $perso->nowconnection(); // $today BETTER name?
  echo "Connexion aujourd'hui (\$nowconnection)= ", date('d/m/Y h:m:s ', $nowconnection),"<br />";// $today_connection better?
  echo "\$totalconnection avant calcul=",$perso->totalconnection(),"<br />";
  $time = (time()+7200);// corriger dans une classe class.time.php !
  echo "\$time avant calcul=",date('d/m/Y h:m:s', $time),"<br />";
  $totalconnection = $time-$nowconnection;
  echo "\$totalconnection = \$nowconnection-\$time = ",$totalconnection;
  echo "<br />vous avec joué (\$totalconnection) : ", $totalconnection,' secondes <br />';
  $perso->setTotalconnection($totalconnection);
  $time = (time()+7200);
  $perso->setLastconnection($time);// informe the lastconnection in db before quit

  $manager->update($perso);// IMPORTANT: HERE THE DB IS UPDATED !
  session_destroy(); // The session is closed
  header('Location: ./'); // The link "deconnexion" sent you there
}

$manager = new PersonnagesManager($db); // Object created: Data base manager

if (isset($_SESSION['perso'])){ // If session perso exists, restore object
  $perso = $_SESSION['perso'];
}

  // include_once('model/show/SuperGlobal.php');

/** SOMEONE ANSWERED TO A QUESTION ?  // Post in line 288 */
if (isset($_POST['answer'])){ // the player loged started to play
  $mission = $perso->mission();
  if($_POST['answer'] == 1){ // 1 = GOOD ANSWER
    $message->setGreen(
    "Bravo ! C'était la bonne réponse !<br />
    Vous gagnez $agilityPoint point d'agilité !<br />
    ($agilityPointFor1Life points = 1 vie).<br />
    Vous avez accompli 1 mission.");
    $agility = $perso->agility(); // how much agility get the object?
    $agility = $agility+$agilityPoint; // the player win agility points 
    $perso->setAgility($agility);
    if($agility >= $agilityPointFor1Life){ // A life win?
      $message->setGreen(
      "Bonne réponse et vous avez gagné $agilityPointFor1Life points d'agilité: Vous gagnez une vie! Bravo!"); // replace if($agility >= $agilityPointFor1Life) by constant class and a ::(see TP-mini-jeu--de-combat-OpenClassRoom.php at root
      $life = $perso->life(); // read how much lifes has the player
      $life++;// life + 1
      $perso->setLife($life); // update data base
      $perso->setAgility(0); //set agility to 0. (Else = to much lives !)
      } // close if($agility >= $agilityPointFor1Life) on line 
    $mission++; // The player win a mission point
    $perso->setMission($mission); // informe mission attribut
    } //       if($answer == 1) // 1 = GOOD ANSWER on line 128
    else {  // bad answer: no mission upgraded...
      $message->setRed("
      Désolé: mauvaise réponse, vous perdez 1 vie. Ne perdez pas courage: rééssayez!");
      $life = $perso->life(); // how much life in object?
      $life--; // Bad question= one life lost
      $perso->setLife($life);
      if($life <= 0){         // the lost all is lives 
        // do an :: constant classwith if($life <= 0) */
        $message->setRed("Désolé ! Vous n'avez plus de vie.<br />
        Il faut recommencer à la mission 1.<br />
        Nous vous offrons à nouveau $lifeStart vies !");         
        $perso->setMission(0);
        $perso -> setAgility(0); // When game ower, all agility lost ?
        $perso->setLife($lifeStart);// Gamer receive lives to retry 
        $life = $perso->life();
        $perso->setLife($life); // update object...
        } // close line 80: if($life <= 0) no more lives
      } // close line 74      else  // bad answer
    } // close    if (isset($_POST['answer'])) line 52

   //Prepare the next question

   include_once("view/game/register.php");//include controller/ludacm/index.php
   include_once("view/game/connection.php");//include controller/ludacm/index.php

if(isset($perso)){
  // LAST QUESTION ? GAME END ? ### Do here a constant class ::
  $mission=$perso->mission();
  if($mission == $NombreDeQuestion){ // game is finished?
    $message->setGreen("
    Bravo, le jeu est terminé!");
    // Vous avez: vies: agilité: missions:
    $perso->setMission(0);
    $EndGame = "Yes";// Questions are no more showed
   } 
   else {    
     $cle = $perso->mission();
  }
}
$id = $question_save[$cle]['id'];
$question = htmlspecialchars_decode($question_save[$cle]['question']);
$reponse1 = htmlspecialchars_decode($question_save[$cle]['juste']);
$reponse2 = htmlspecialchars_decode($question_save[$cle]['faux']);
$reponse3 = htmlspecialchars_decode($question_save[$cle]['faux_bis']);

function getArray(){
    return array("juste","faux","faux_bis");
}
   $reponse = [
   $reponse1 => "juste",
   $reponse2 => "faux",
   $reponse3 => "faux_bis",
];
$reponse = [
          "juste",
          "faux",
          "faux_bis",
];
// la question juste doit etre mélangée aléatoirement à chaque rechargement de la page
$rand1 = rand(0,2); // Randoming the answer !
if($rand1 == 0){
    $rand2 = 1;
    $rand3 = 2;
}elseif($rand1 == 1){
    $rand2 = 2;
    $rand3 = 0;
}elseif($rand1 == 2){
    $rand2 = 0;
    $rand3 = 1;
}
$choix1 = $reponse[$rand1];
$choix2 = $reponse[$rand2];
$choix3 = $reponse[$rand3];
$bool = $bool1 = $bool2 = $bool3 = 0;

$reponse1 = htmlspecialchars_decode($question_save[$cle]["$choix1"]);
if ($choix1 == "juste") {
$bool1 = 1; 
}
$reponse2 = htmlspecialchars_decode($question_save[$cle]["$choix2"]);
if ($choix2 == "juste") {
$bool2 = 1; 
}
$reponse3 = htmlspecialchars_decode($question_save[$cle]["$choix3"]);
if ($choix3 == "juste") {
$bool3 = 1; 
}
?>
<!doctype html>
<html lang="fr">
  <head>
        <link rel="stylesheet" href="<?=$website_url;?>/style.css">
		<link rel="stylesheet" href="<?php echo $website_url; ?>/view/game/game.css"><!-- second stylesheet priority -->
        <meta charset="UTF-8" />
        <title>Lud'ACM Game</title>
  </head>
  <body>
    <div id="page">
      <?php
      $file = "inc/menu_game.php";
      if(file_exists($file)){
      	include($file);
      	}
      	else{
      		echo "Le fichier $file est introuvable... ";
      	}
    echo $message->Green();
    echo $message->Red();
    if (isset($perso)) // Si on utilise un personnage (nouveau ou pas).
    {
        if(!isset($EndGame)){
      ?>
      <fieldset>
        <legend>
          <h2 class="white">
            <?=$id;?> 
          </h2>
        </legend>
        <p class = "white">
          <?=$question;?>
        </p>
        <form class="" method="post" action="" />
          <p  class = "white">
            <label for="firstAnswer">
              <input id="firstAnswer" type="radio" name="answer" value="<?=$bool1;?>" >
                <?=$reponse1;?>
              </input>
            </label>
          </p>
          <p  class = "white">
            <label for="secondAnswer">
              <input id="secondAnswer" type="radio" name="answer" value="<?=$bool2;?>">
                    <?=$reponse2;?>
              </input>
            </label>
          </p>
          <p class = "white">
            <label for="thirdAnswer">
              <input id="thirdAnswer" type="radio" name="answer" value="<?=$bool3;?>">
                <?php echo $reponse3;?>
              </input>
            </label>
          </p>
          <!--
            <input type="hidden" name="key" value="<?//=$key;?>" />-->
            <input type="submit" value="valider" />
        </form>
      </fieldset>
      <?php
        } // close if($EndGame != "Yes"){ on line 205
        ?>
      <fieldset>
        <legend class = "white">
          <h4>Pseudo: <?= htmlspecialchars($perso->name());?>
          </h4>
        </legend>
        <h4 class = "white">
          <img class="logo" src="img/__heart.svg.png" alt="coeur représentants les vies" />Vies: <?= $perso->life() ?><br />
          <img class="logo"  src="img/__mission.png" alt="symbole de mission" />Missions accomplies: <?= $perso->mission() ?><br />
          <img class="logo"  src="img/__agility.png" alt="symbole d'agilité" />Agilité: <?= $perso->agility() ?>
        </h4>
      </fieldset>
      <p  class = "white">
        <a href="?deconnexion=1">Déconnexion</a>
      </p>
      <?php
    }
    else // Se connecter ou créer un personnage
    {
      ?>
	  <!doctype html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="<?php echo $website_url; ?>/style.css">
    <link rel="stylesheet" href="<?php echo $website_url; ?>/view/accueil/accueil.css"><!-- second stylesheet priority -->
	<meta charset="UTF-8" />
    <title>Lud'ACM HomePage</title>
	<meta name="viewport" content="width=device-width"/>
  </head>
  <body>
    <!--<div id="page">-->
      <?php
      // $file = "inc/menu_game.php";
      // if(file_exists($file)){
      	// include($file);
      	// }
      	// else{
      		// echo "Le fichier $file est introuvable... ";
      	// }
      	?>

      <h1 class="white center">LUD'ACM</h1>
       
      <h2 class="white center size50 breakGreat">L'accueil de loisirs dont vous êtes le héros...</h2>
      <fieldset>
        <legend><h3 class = "white">Votre personnage</h3> </legend>
          <form action="" method="post">
            <p  class = "white"><!-- The view of the page starts here !-->
              Pseudo:<input type="text" name="name" maxlength="50" value="<?=$save_pseudo;?>" /><br />
              Mot de passe:<input type="password" name="password" maxlength="250" /><br />
              <input type="submit" value="Se connecter" name="utiliser" />
              <input type="submit" value="S'enregistrer" name="creer" /><!-- ->line 22 -->
            </p>
          </form>
      </fieldset>
      <?php
    }
    ?>
	</body>
</html>
<?php
  if (isset($perso)) // Si on a créé un personnage,
  {        //  on le stocke dans une variable session afin d'économiser une requête SQL.
    $_SESSION['perso'] = $perso;
  }