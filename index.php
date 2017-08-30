<?php
// On demande toutes les questions (modèle)
// Cours OpenClassRoom sur OOP
// Hey Mattew! Why didn't you construct an Object with question????

include_once("model/$dir/get_question.php"); // include model/ludacm/get_question.php
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

// On affiche la page (vue)
include_once("$www_real_path/view/game/game.php");
