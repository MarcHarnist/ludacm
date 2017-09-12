  <hr/>
  <p><a href="<?=$website_url;?>/private/toolbox__/SqlDownloader.php">Je sauvegarde ma base de données !</a> quand j'ai beaucoup travaillé sur mon site.</a>

</div> <!-- ferme div class = "page" du header - bien séparer menus du haut et du bas -->


<!-- Footer (pied de page) -->

<hr/>
	


<!--     Menu dans balise p, plus petit que dans l'en-tête   -->
<p>
<?php // Inclure le menu.html 
$file = "$www_real_path/private/inc/menu.php";//$www_real_path informed in .php
include($file);


//$url_admin informed in config.php

// echo "<h4>$website_url=$website_url</h4>";
// echo "config=$config<br />";
// echo "$url=url<br />";
// echo "/home/ludacmfrif/www/private/config.php=realpath";
  
  

?>
</p>

</body>

</html>