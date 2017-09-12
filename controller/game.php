<?php
/**
*  Hy,
*  Trying to show the MVC of my project. I'll need several days to install all files.  
*  This fill is installed in "controller"  directory
*  Thanks for all reviews.
*  Marc Harnist 2017/08/31
*/

include_once("model/get_question.php"); // include model/ludacm/get_question.php
$question_save = get_question(0,500);//500 = all questions !

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($question_save as $cle => $question)
{
    $question_save[$cle]['id'] = nl2br(htmlspecialchars($question['id']));
    $question_save[$cle]['question'] = nl2br(htmlspecialchars($question['question']));
    $question_save[$cle]['juste'] = nl2br(htmlspecialchars($question['juste']));
    $question_save[$cle]['faux'] = htmlspecialchars($question['faux']);
    $question_save[$cle]['faux_bis'] = htmlspecialchars($question['faux_bis']);
}
//register autoload which will load the classes
function chargerClasse($classname) {  // Upload OOP classes
  require ROOT . 'classes/' . $classname.'.php'; // names of each class
}
spl_autoload_register('chargerClasse'); //maintenant les class sont chargées
session_start(); //Call session_start() after autoload 

// Create value: // AFTER: CREATE OBJECT !
$agilityPoint = 1; // Point for a good answer
$lifeStart = 5; // Number of lives at starting game
$agilityPointFor1Life = 7; // Number of agility point to win a life
$duree_connexion_de_ce_joueur = $messager = $question_number = ""; // create var

$NombreDeQuestion = count($question_save);
$message = new Message();// My first class self made ! 08/2017 MarcL.Harnist
$manager = new PersonnagesManager($db); // Object created: Data base manager

if (isset($_SESSION['perso'])){ // If session perso exists, restore object
  $perso = $_SESSION['perso'];
  $question_number = $perso->lastquestion();
}
else {
	header('Location: ' . PAGE_URL . 'connection');
}
      /** SOMEONE ANSWERED TO A QUESTION ? in view/game.php  */
if (isset($_POST['answer'])){           // the player loged started to play
    $mission = $perso->mission();
	if($_POST['answer'] == 1){ // 1 = GOOD ANSWER

		//TOOL
		// echo '<h3>Ligne: ' . __LINE__ . '$ = ' . $  . '</h3>';
	  
        $lastquestion = $perso->lastquestion(); // last question answered
        $question_number = $lastquestion+1;
        $agility = $perso->agility(); // how much agility in the object?
		$agility = $agility+$agilityPoint; // player win agility points 
		$perso->setAgility($agility);
		
		if($agility >= $agilityPointFor1Life){ // A life win?
			$message->setNormal('BONNE REPONSE<br />
			+ 1 <img src = "' . IMG_URL . 'agility.png" alt = "Jongleur logo agilité" title = "Agilité"  />');
			$messager .= "Bonne réponse et vous avez gagné $agilityPointFor1Life points d'agilité: Vous gagnez une vie! Bravo!";
			$message->setGreen($messager); // replace if($agility >= $agilityPointFor1Life) by constant class and a ::(see TP-mini-jeu--de-combat-OpenClassRoom.php at root
			$message->setGreen($messager);
			$life = $perso->life(); // read how much lifes has the player
			$life++;// life + 1
			$perso->setLife($life); // update data base
			$perso->setAgility(0); //set agility to 0. (Else = to much lives !)
        } // close if($agility >= $agilityPointFor1Life) on line 
        $mission++; // The player win a mission point
		$perso->addLastquestion();
        $perso->setMission($mission); // informe mission attribut
		$file = PAGE_URL . 'bonne_reponse';
		// exit($file);
		header('Location: ' . $file);
	} // Close if($answer == 1) // 1 = GOOD ANSWER on line 53
    else {  // bad answer: no mission upgraded...
        $message->setRed("
        Désolé: mauvaise réponse, vous perdez 1 vie. Ne perdez pas courage: rééssayez!");
        $life = $perso->life(); // how much life in object?
        $life--; // Bad question= one life lost
        $perso->setLife($life);
        		
        switch ($life) {
            case Personnage::PERDU :
			$message->setNormal('<img class = "img_after_answer" src = "' . IMG_URL . 'game_over.jpg" alt = "Chat roux qui lève les pattes au ciel" title = "Perdu!" />');
        	$message->setRed('Désolé ! Vous n\'avez plus de vie.
        	Vous avez perdu.<br />
            Il faut recommencer à la mission 1.<br />
        	Nous vous offrons à nouveau ' . $lifeStart . ' vies !');
            $perso->setMission(0);
            $perso -> setAgility(0); // When game ower, all agility lost ?
            $perso->setLife($lifeStart);// Gamer receive lives to retry 
            $life = $perso->life();
            $perso->setLife($life); // update object...
			$perso->setLastquestion(0);
            break;
        } // close switch
    } // close else  // bad answer line 95 
	$manager->update($perso);// IMPORTANT: here is db updated with all information of the object. Admire the simplicity and power of this line. All glory to God!
}
if(isset($perso)){
  // LAST QUESTION ? GAME END ? ### Do here a constant class ::
  $mission=$perso->mission();
  $NombreDeQuestion--;
  $lastquestion = $perso->lastquestion();
  $cle = $lastquestion;
  if($question_number == $NombreDeQuestion){ // game is finished?
    $message->setGreen("
    Bravo, le jeu est terminé!");
    // Vous avez: vies: agilité: missions:
    $perso->setLastquestion(0);
    $EndGame = "Yes";// Questions are no more showed
   } 
}
//Prepare the next question
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
// On affiche la page (vue)
	include(HEAD); 
	include(MENU); 
	include(PAGE);
	include(FOOT); 