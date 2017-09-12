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
  'table'     => 'player'
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
  'table'     => 'player'
  );
}
// I.2 Include de header with the right path !
include('../inc/header.php');
	
//I.3 Variables for header
$title ="Supprimer une ligne de l'échéancier des entrées"; // Page title for header and else


//I.4 SQL INFORMATIONS (See above I.1.3 $config[db])
//I.4.1 SQL colonnes names
// Later: learn no read the titles in DB with php code ?????????????????????????
$name1 ="id";
$name2 ="name";
$name3 ="life";
$name4 ="mission";
$name5 ="agility";
$name6 ="born";
$name7 ="password";
$name8 ="lastconnection";
$name9 ="nowconnection";
$name10 ="totalconnection";
$name12 ="lastquestion";
	
//I.5 FORMULAR INFORMATIONS
//I.5.1 Formular colonnes titles
$title1 ="N°";

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
/*   Affichage des superglobales en cas de besoin
     echo 
     "<pre>",
     print_r($GLOBALS);
     "</pre>";
*/
?>		
		
		
<!-- My page -->
<?php
$confirm = $data1 = ""; // $data1 = id several times


// Get formular datas
if(ISSET($_POST['anchor']))
{//Anchor for comeback-link on the right line.
  $anchor=$_POST['anchor']-1;
}
// echo  "anchor=$anchor<br/>";
if(ISSET($_POST['data1']))
{
  $data1=htmlspecialchars($_POST['data1']);
}
// echo "data1=$data1<br/>";
if(ISSET($_POST['confirm']))
{
  $confirm=$_POST['confirm'];
}
// echo "confirm=$confirm<br/>";
if($confirm == "yes") // Have we confirm delete ?
{
  $req = $db->prepare('DELETE FROM '.$config['db']['table'].' WHERE id = :id');
  $req->execute(array(
    'id' => $data1,
    ));
  $url="index.php#$anchor"; //$data1 est l'anchor de retour...
  header("Location:$url");
} // Close: if($confirm == "yes")... on line 71
else
{
// echo "SELECT $name2, $name3, $name4, $name5 FROM ".$config['db']['table']." WHERE id=$data1";
  $reponse = $db->query("SELECT $name1, $name2, $name3, $name4, $name5 FROM ".$config['db']['table']." WHERE id=$data1");
  while ($donnees = $reponse->fetch())
  {
    $a = $donnees[$name1];
    $b = $donnees[$name2];
    $c = $donnees[$name3];
    $d = $donnees[$name4];
    $e = $donnees[$name5];
  }
  $b=ucfirst($b);
  $name1=ucfirst($name1);
  $name2=ucfirst($name2);
  $name3=ucfirst($name3);
  $name4=ucfirst($name4);
  $name5=ucfirst($name5);
  $question = "$name1: $a <br /> $name2: $b <br /> $name3: $c <br/ > $name4: $d <br/ > $name5: $e ?";
  ?>
 
  <h3 class="warning">Attention ! Cette suppression sera définitive.</h3>
 
  <h4>Etes-vous sur de vouloir supprimer l'entrée suivante:</h4>
  
  <?php

   echo "<p>$question</p>"; 

   $anchor_une = $anchor;	
   // $anchor_une = $anchor_une-5;	
   // RETURN TO PAGE_URL -1
   $url = $_SERVER['HTTP_REFERER']; // Car on peut venir de plusieurs endroit du site !
   $url.="#$anchor"; //$anchor serves for comeback-anchor-link
   // echo "<a href=\"$url\">Return ! </a>";
   // header ("location:$url");
   // $url_de_retour_en_arriere = "rule.php#$anchor_une";
   $url_de_retour_en_arriere = $url;
  ?>
  
  <form method="post" action="">
  <input type="hidden" name="confirm" value="yes" />
  <input type="hidden" name="data1" value="<?php echo $data1;?>" />
  <input type="hidden" name="anchor" value="<?php echo $anchor;?>" />
  <input class="nombre"  type="submit" value="Oui, je confirme la suppression." />
  </form>
  
  <form method="post" action="<?php echo $url_de_retour_en_arriere;?>">
  <input class="nombre"  type="submit" value="ANNULER" />
  </form>
  
  
  <?php
} // Close else on line 68.
?>

  
  
<!-- Pied de page ------------------------------>
<?php  

// Affichage des superglobales en cas de besoin
  // echo "<pre>",
  // print_r($GLOBALS);
  // "</pre>";

include('..//inc/footer.php');?>