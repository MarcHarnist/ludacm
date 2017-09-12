<?php
/*           _________________
            |                 |         
            |   FORMULAR BY   |        
            |   Marc Harnist  | 
			|                 |
            |    09/08/2017   |    
            |_________________|        

		
		
		
		( o-o)
	       /  
		   |--
		   |
		  / \
		  Robot by Little Franky
		
		
   INDEX

I.INFORME ALL VARIABLES
  I.1 First: are we on WAMP or online?
  I.1.1 Inform real path for includes on WAMP
  I.1.2 Inform vars for db connexion on WAMP
  I.1.3 Inform real path for includes online
  I.1.4 Inform vars for db connexion online
  I.2 Include de header with the right path !
  I.3 Variables for header
  I.4.SQL INFORMATIONS (See I.1.3 $config[db])
    I.4.1 Names of the SQL colonnes
  I.5  VARIABLES OF THE FORMULARY
    I.5.1 Titles of the formulary
    I.5.2 Text areas sizes of the formular
II. Let's go on program !
  II.1 Let's connect us to data base (db) whith vars above
  II.2 Create a counter for the names of  anchors ( numbers)
III READ AND COLLECT DATA IN DATA BASE

  
*/
// I.1 First: are we on WAMP or online?
if($_SERVER['HTTP_HOST'] == 'localhost')
{
  //(We are on WAMP)
  //I.1.1 Inform real path for includes on WAMP
  $www_real_path = "C:\wamp64\www\ludacm/www";

  //I.1.2 Informe vars for db connexion on WAMP
  //Later in config.php?
  $config['db'] = array(
  'host'      => 'Localhost',
  'username'  => 'root',
  'password'  => '',
  'dbname'    => 'ludacm',
  'table'     => 'question'
  );
}
else{
  // (We are online)
  //I.1.3 Inform real path for includes online
  $www_real_path = "/home/ludacmfrif/www";   //for includes  

  //Later in config.php?
  //I.1.4 Informe vars for db connexion online
  $config['db'] = array(
  'host'      => 'marcharnssmarc.mysql.db',
  'dbname'    => 'marcharnssmarc',
  'username'  => 'marcharnssmarc',
  'password'  => 'Bumiere753',
  'table'     => 'question'
  );
}
// I.2 Include de header with the right path !
include('..//inc/header.php');
 	
//I.3 Variables for header
$title ="Formulaire"; // Page title for header and else

//I.4 SQL INFORMATIONS (See above I.1.3 $config[db])
//I.4.1 SQL colonnes names
// Later: learn no read the titles in DB with php code ?????????????????????????
$name1 ="id";
$name2 ="question";
$name3 ="juste";
$name4 ="faux";
$name5 ="faux_bis";


	
//I.5 FORMULAR INFORMATIONS

//I.5.1 Formular colonnes titles
$title1 ="N°";
$title2 ="Question";
$title3 ="Réponse juste";
$title4 ="Réponse fausse";
$title5 ="Réponse fausse";
$title6 ="Action !!!";
$title7 ="";
$title8 ="";
$title9 ="";
$title10 ="";

//I.5.2 Formular textareas sizes
$rols = "30";
$rows = "10";

// II. Program somes either the contents of variables !
// II.1 Connect to data base (db) which vars above
try {
    $db = new PDO('mysql:host=' .$config['db']['host']. ';dbname=' .$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
	$DBerrorMessage = "Sorry there is a problem with the database connection :"; 
    echo $DBerrorMessage . $e->getMessage();
}





		// echo "<pre>",
		// print_r($GLOBALS);
		// "</pre>";
		// Affichage des superglobales en cas de besoin
		
		
		
		
		
		
		
		
		
		
		
		
		
		
// Get formular datas

//$operation: creation? Updating? Delete?
if(ISSET($_POST['operation'])){
  $operation=htmlspecialchars($_POST['operation']);
}
// Je récupère les données du formulaire
if(ISSET($_POST['anchor']))
{//Anchor for comeback-link on the right line.
  $anchor=$_POST['anchor'];
}
// data0 = new_id if id is changed
if(ISSET($_POST['data0'])){
  $data0=htmlspecialchars($_POST['data0']);
}
// data1 = id (old id)
if(ISSET($_POST['data1'])){
$data1=htmlspecialchars($_POST['data1']);
}
// data2 = question
if(ISSET($_POST['data2'])){
$data2=htmlspecialchars($_POST['data2']);
}
// data3 = juste (good answer)
if(ISSET($_POST['data3'])){
$data3=htmlspecialchars($_POST['data3']);
}
// data4 = faux (false answer)
if(ISSET($_POST['data4'])){
$data4=($_POST['data4']);
}
// data5 = faux_bis (second false answer) 
if(ISSET($_POST['data5'])){
$data5=($_POST['data5']);
}
  
// UPDATES
if($operation == "update"){
  // It's an update (mise à jour)

if($data0 == ''){
  $data0 = $data1;
}

  
  $req = $db->prepare('UPDATE '.$config['db']['table'].' SET id = :new_id, question = :question, juste = :juste,  faux = :faux, faux_bis = :faux_bis WHERE id = :id');
  $req->execute(array(
   'new_id' => $data0, // new id ($data1 = old id)
   'question' => $data2, // 
   'juste' => $data3,
   'faux' => $data4,
   'faux_bis' => $data5,
   'id' => $data1,
   ));
} // Close: if($operation == "update"){ // C'est une modification? (Line 39)

	
// CREATIONS
elseif($operation == "creation")
{
  $req = $db->prepare('INSERT INTO '.$config['db']['table'].'(question, juste, faux, faux_bis) VALUE (:question, :juste, :faux, :faux_bis)');
  $req->execute(array(
                      'question' => $data2, // 
                      'juste' => $data3,
                      'faux' => $data4,
                      'faux_bis' => $data5,
                     ));
} 


// RETURN TO PAGE_URL -1
$url = $_SERVER['HTTP_REFERER']; // Car on peut venir de plusieurs endroit du site !
$url.="#$anchor"; //$anchor serves for comeback-anchor-link

// echo "<a href=\"$url\">Return ! </a>";
header ("location:$url");

?>

<!-- Pied de page ------------------------------>
<?php include('..//inc/footer.php');?>
