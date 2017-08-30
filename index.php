<?php
// This file is in directory: /controller/ installed
// On demande toutes les questions (modèle)
// Asking all questions in /model/ ->data base mysql
// Cours OpenClassRoom - OOP
// We can construct an Object with questions

include_once("model/$dir/get_question.php"); // include model/ludacm/get_question.php
$question_save = get_question(0,500);//500 = all questions !

// Datas treatment. (Controller) and securing the display
foreach($question_save as $cle => $question)
{
    $question_save[$cle]['id'] = nl2br(htmlspecialchars($question['id']));
    $question_save[$cle]['question'] = nl2br(htmlspecialchars($question['question']));
    $question_save[$cle]['juste'] = nl2br(htmlspecialchars($question['juste']));
    $question_save[$cle]['faux'] = htmlspecialchars($question['faux']);
    $question_save[$cle]['faux_bis'] = htmlspecialchars($question['faux_bis']);
}

// Displaying page (view)
include_once("$www_real_path/view/game/game.php");
