<?php
if(isset($url_du_site)){
$count = 0;
	
echo "
  <p>
  <a href=\"$url_du_site\">Accueil</a> - 
  <a href=\"$url_du_site/private/\">Private</a> - 
  ";  
 $dir = "./";
  //  si le dossier pointe existe
  if (is_dir($dir)) {
  
     // si il contient quelque chose
     if ($dh = opendir($dir))
     {
      // boucler tant que quelque chose est trouve
      while (($file = readdir($dh)) !== false) 
      {
        $count++;
        
        // affiche le nom et le type si ce n'est pas un element du systeme
        $type = filetype($dir.$file);
        
        $signe_caracteristique_d_un_programme = "__";
        
        // Voyons si le fichier ou le repertoire est un programme:
        if (stripos($file, $signe_caracteristique_d_un_programme) == TRUE)
        {
        


        
          //on veut tout afficher ici pour le moment 
          //sinon oter les // devant $file = 'programme';
        
          // C'est un programme
          $file = 'programme'; 
          


        
        }
        
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if( $file != '.' && $file != '..' && $file !== 'programme' && $extension !== 'sql'  && $extension !== 'htaccess' ) 
        {
          // Est-ce un repertoire ou un fichier? Si oui l'affichage sera différent
          if($type == 'dir')
          {
            {
            $url = $file;
            $file = ucfirst($file);//On met une majuscule. Plus joli.
            $texte = "<a href=\"./$url\">$file</a> - ";
            }
          }
          else
          // Ce n'est pas un repertoire mais un fichier
          {          
            /* si le fichier ne contient pas __ on l'afiche dans le menu.*/
            $url = $file;
            $file = ucfirst($file);//On met une majuscule. Plus joli.
            $texte = "<a href=\"./$url\">$file</a> - ";
          }
          echo " $texte ";
         }
      }
       // on ferme la connection
       closedir($dh);
     }
  }
} ?>
</p>

