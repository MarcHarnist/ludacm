<?php
/*           ________________
            |                |         
            |    PRIVATE     |        
            |    09/8/2017   |    
            |________________|        

Usefull variables */
$title ="Lud'ACM-Private";/*

Inclusion of the header*/    
$www_real_path = "/home/ludacmfrif/www";
if($_SERVER['HTTP_HOST'] == 'localhost'){
   $www_real_path = "C:\wamp64\www\ludacm/www"; //For WAMP
}  include('inc/header.php');
?>
<!-- Header -->

<div class = "page">
<!-- The page -->

<h3>Welcome at Lud'ACM backoffice !</h3>

<p><a href="/private/formulaire">You can full des game formulary right now: it's ready!</a></p>
<p><a href="journal.php">Read the diairy if you want more information.</a></p>
<p>Have fun !</p>
<p>Marc</p>



</div><!-- ferme id=Page -->

  <!-- Pied de page                                      -->
  <?php include('inc/footer.php');?>
