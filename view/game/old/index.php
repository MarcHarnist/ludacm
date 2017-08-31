<?php
/*           ______________
            |              |         
            |   Lud'ACM    |        
            |   9/8/2017   |    
            |______________|        

*/

//Usefull variables
$title ="Lud'ACM";
//Inclusion of the header    
$www_real_path = "/home/ludacmfrif/www";
if($_SERVER['HTTP_HOST'] == 'localhost'){
   $www_real_path = "C:\wamp64\www\www\ludacm"; //For WAMP
}  include($www_real_path.'/inc/header.php');?>

<h1 class="bleu_ciel center">
  <img class="center" src="img/__banner.png" alt="Ma bannière: ronde d'enfants" />
  <?=$title;?>
</h1>
 
<div class="cadre">

<h2 class="center">
    L'accueil de loisirs dont vous êtes le héros...
</h2>

<form class="center" method="post" action="game/register.php">
    <input class="start" type="submit" value="COMMENCER" />
</form>
</div>
<!-- Pied de page                             -->
<?php include($www_real_path.'/inc/footer.php');?>
