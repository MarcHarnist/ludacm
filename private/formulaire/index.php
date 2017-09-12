<?php
/*           _________________
            |                 |         
            |   FORMULAR BY   |        
            |   Marc Harnist  | 
			|                 |
            |    09/08/2017   |    
            |_________________|        

/* Perfectionner ce programme en regardant la dernière version de formulaire du jeu chez Isa: ludacm/private/formulaire grace au code de 

marcharnist/private/toolbox/SQL_columns_name_reader_for_WAMP (existe le même on line : faire un seul)</a> grâce à Dieu bien sûr et au site: <a href="https://www.w3schools.com/php/func_mysqli_fetch_field.asp">w3schools</a>			
<h3>Continuer le formulaire. Régler les pages suivantes: delete__;  update__; apparemment il y a un problème avec la methode POST. S'inspirer du fichier http://localhost/www/private/budget/rule/rule.php tout en essayant de créer un formulaire adaptable à n'importe quel site. Ensuite dans le while, utiliser des chiffres pour récupérer les données  afin de faire un formulaire utilisable  pour d'autres pages?</h3>

Help on https://stackoverflow.com/questions/13462606/make-pdo-connection-variable-accessible-throughout-site

I. INFORME ALL VARIABLES
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
	
//I.2 Variables for header
$title ="Formulaire des questions du jeu"; // Page title for header and else

// I.3 Include de header with the right path !
include('../inc/header.php');

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
?>
  <table>
    <!-- My table first line -->
    <tr>
      <th><?=$title1;?></th>
      <th><?=$title2;?></th>
      <th><?=$title3;?></th>
      <th><?=$title4;?></th>
      <th><?=$title5;?></th>
	  <th><?=$title6;?></th>
      <!--
      <th><?=$title7;?></th>
      <th><?=$title8;?></th>
      <th><?=$title9;?></th>
      <th><?=$title10;?></th>
	  -->
    </tr>
  <?php
// II. Program somes either the contents of variables !
// II.1 Connect to data base (db) which vars above

// echo "<h1>-";
// echo $config['db']['dbname'];
// echo "-</h1>";
// echo "<h1>-";
// echo $config['db']['host']. ';dbname=' .$config['db']['dbname'], $config['db']['username'], $config['db']['password'];
// echo "-</h1>";

// echo  'mysql:host=marcharnssmarc.mysql.db;dbname=marcharnssmarc;charset=utf8','marcharnssmarc','Bumiere753');
try {
    $db = new PDO('mysql:host=' .$config['db']['host']. ';dbname=' .$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
	$DBerrorMessage = "Sorry there is a problem with the database connection :"; 
    echo $DBerrorMessage . $e->getMessage();
}
// II.2 Create a counter for html anchors links names (a number)
$anchor = $count=1;

// III READ AND COLLECT DATA IN DATA BASE
  $reponse = $db->query("SELECT * FROM ".$config['db']['table']."");
  // Langage moderne en POO avec paanaim Nekudetaïm (::) et FETCH_ASSOC 
  while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
  { /*
    $data0 = 'new_id';      in case of id's change */
    $data1=$donnees[$name1]; // $data1 receive value of $name1 from db (id)
    $data2=$donnees[$name2]; // $data2 receive value of $name1 from db (question)
    $data3=$donnees[$name3]; // $data3 receive value of $name1 from db (reponse just)
    $data4=$donnees[$name4]; // $data4 receive value of $name1 from db (reponse fausse)
    $data5=$donnees[$name5]; // $data5 receive value of $name1 from db (2éme rép faus.)

    ?>
	<!-- Second line -->
    <tr id="<?php $anchor=$count; echo $anchor; $count++;?>">
    <!-- formular id deleted: 2 ids != valid html5 --> 

	
	<!-- A tenter plus tard... -->	
	    <form method="post" action="update__.php">
    <!-- Essayer de déplacer la ligne 96:
<form method="post" action="update__.php">
avant <table> car html 5 n'aime pas et peut-être qu'on pourra edité pluseurs lignes à la fois ? -->
	
	
	
	
	
	
    <td>
	  <!--     data0 = new_id    (in case id is edited) -->
      <input type="text" size="1" name="data0" value="<?php echo $data1; /*if no change print and save old id */ ?>" />
	  <!-- we save the value of the old $id-->
	  <!-- we create an anchor: id = anchor = $count, to come back to this line -->
	  <!-- data1 = id (old id) -->
      <input type="hidden" name="data1" value="<?php echo $data1;?>" />
    </td>
    <td>
	  <!-- data =  -->
      <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data2"><?php echo $data2;?></textarea>
      <!--<input type="text" size="5" name="data2" value="<?php //echo $data2;?>" />-->
    </td>
    <td>
	  <!-- data =  -->
      <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data3"><?php echo $data3;?></textarea>
      <!--<input type="text" size="5" name="data2" value="<?php //echo $data2;?>" />-->
    </td>
    <td>
	  <!-- data =  -->
      <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data4"><?php echo $data4;?></textarea>
    </td>
    <td>
	  <!-- data =  -->
      <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data5"><?php echo $data5;?></textarea>
    </td>
    <td class="center">
      <input type="hidden" name="operation" value="update" />
      <input type="hidden" name="anchor" value="<?php echo $anchor;?>" />
      <input type="submit" value="Edit" />
    <!--</td>-->
    
    </form>
    
    <!--<td class="center">-->
	<span class="center">
    <form method="post" action="delete__.php">
      <input type="submit" value="del" />
      <input type="hidden" name="data1" value="<?php echo $data1;?>" />
      <input type="hidden" name="anchor" value="<?php echo $anchor;?>" />
      <input type="hidden" name="operation" value="delete" />
      </form>
    </td>
</tr>
  <?php 
    }   // ferme "while($donnees=$reponse->fetch())" ci-dessus
  ?>
<tr>
      <form method="post" action="update__.php">
        <!-- Id du formulaire supprimés: 2 ids != valide html5 --> 
        <td>
		  <input type="text" size="1" /><!-- For id not to inform (autoincrement)-->
        </td>
		<td>      
		  <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data2">
		  </textarea>
		  <!--<input type="text" size="1" />-->
        </td>
		<td>
          <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data3">
		  </textarea>
        </td>
        <td>
          <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data4">
		  </textarea>
		  <!--<input type="text" size="5" name="data2" />-->         
        </td>
        <td>
		  <textarea class="left" cols="<?php echo $rols;?>" rows="<?php echo $rows;?>" name="data5">
		  </textarea>
        </td>		  
        <td class="center">
          <input type="hidden" name="anchor" value="<?php echo $anchor;?>" />
          <input type="hidden" name="operation" value="creation" />
          <input class="right"  type="submit" size="300" value="Enregistrer" />
        </td>
      </form>
    </tr>
  </table>
  
  <!-- Pied de page                                      -->
  <?php include('..//inc/footer.php');?>