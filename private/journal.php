<?php    
/*           _________________
            |                 |         
            |     LOGBOOK     |
            |         BY      |        
            |   Marc Harnist  | 
            |                 |
            |    09/08/2017   |    
            |_________________|        


            
            
<h3>En essayant de créer un formulaire adaptable à n'importe quel site. Ensuite dans le while, utiliser des chiffres pour récupérer les données  afin de faire un formulaire utilisable  pour d'autres pages.</h3>

Help on https://stackoverflow.com/questions/13462606/make-pdo-connection-variable-accessible-throughout-site

I. INFORME ALL VARIABLES
II. Let's go on program !
III READ AND COLLECT DATA IN DATA BASE

  
*/

if($_SERVER['HTTP_HOST'] == 'localhost')// if on WAMP...
{
  $www_real_path = "C:\wamp64\www\ludacm/www";  //real path for includes on WAMP
}
else{
  $www_real_path = "/home/ludacmfrif/www";  //real path for includes online
}
$title ="The NEWS !"; // Page's title for header and else

include('inc/header.php');//Include head with right path !
?>

<p>Vendredi 11 août 2017<br />
Le formulaire des questions du jeu est fonctionnel. Bravo à Marc.<br />
- Merci merci !</p>

<p>Jeudi 10 août 2017<br />
Isa change le nom du site. Merci. Je dois corriger toutes les pages et tous les fichiers inclus dans les pages.<br />
Page 1 du formulaire du backoffice du jeu ludACM, ludACM/private/formulaire/index.php, est terminée, ainsi que la page update__.php. La page delete__.php est commencée mais ne fonctionne pas encore.<br />
J'ai envoyé le backoffice en ligne mais la connexion bugue...
</p>

<p>Mercredi 9 août Première page...</p>

<?php
include(ROOT . "/private/inc/footer.php");
?>
