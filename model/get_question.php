<?php

// File: www/model/ludacm/get_question.php

function get_question($offset, $limit)
{
    global $db;
    $offset = (int) $offset;
    $limit = (int) $limit;
        
    $req = $db->prepare('SELECT * FROM question ORDER BY id LIMIT :offset, :limit'); // LIMIT will serve for 5 first easy questions
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $question = $req->fetchAll();
    
    
    return $question;
// var_dump($question);
// exit();
	}