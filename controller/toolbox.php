<?php
	//  My Toolbox 26/07/2017

$count = $count_sql = $count_dir = $count_php= 1;
$autres_fichiers = $repertoires = $fichiers_sql = $fichiers_php = "";
$dir = "./view/toolbox/";

if (is_dir($dir)) { // is_dir: if the directory exists...
   if ($dh = opendir($dir)) // if the directory contains something
   {
        // boucler tant que quelque chose est trouve
        while (($file = readdir($dh)) !== false) {
			// affiche le nom et le type si ce n'est pas un element du systeme
            $type = filetype($dir.$file);
			
			$signe_caracteristique_d_un_programme = "__";
			
			// Voyons si le fichier ou le repertoire est un programme:
			if (stripos($file, $signe_caracteristique_d_un_programme) == TRUE){
				//display every files. If not decomment next line
				// $file = 'programme'; 
			}
            if( $file != '.' && $file != '..' && $file !== 'programme') 
			{
				$url = $dir.$file;
				// Est-ce un repertoire ou un fichier? Si oui l'affichage sera différent
				if($type == 'dir')
				{
					{
					$file = ucfirst($file);//On met une majuscule. Plus joli.
					$repertoires .= "<br />$count_dir. <a href=\"./$url\">$file</a> ";
					$count_dir++;
					}
				}
				else
				// Ce n'est pas un repertoire mais un fichier
				{					  // Récupération de l'extension
                  $extension = pathinfo($file, PATHINFO_EXTENSION);
				  if($extension == 'sql')
				  {
					  $file = ucfirst($file);//On met une majuscule. Plus joli.
					  $fichiers_sql .= "<br />$count_sql. <a href=\"./$url\">$file</a> ";
                      $count_sql++;						  
				  }
				  elseif($extension == 'php')
				  {
					/* si le fichier ne contient pas __ on l'afiche dans le menu.*/
					$file = ucfirst($file);//On met une majuscule. Plus joli.
					$fichiers_php .= "<br />$count_php. <a href=\"./$url\">$file</a> ";
                    $count_php++;
				  }
				  else // tous les autres fichiers
					{
					/* si le fichier ne contient pas __ on l'afiche dans le menu.*/
					$file = ucfirst($file);//On met une majuscule. Plus joli.
					$autres_fichiers .= "<br />$count. <a href=\"./$url\">$file</a> ";
                    $count++;
				  }
				}
           }
        }
       closedir($dh); // connection
   }
}

include(HEAD);
include(MENU); 
include(PAGE);
// include(FOOT);