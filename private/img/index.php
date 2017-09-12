<?php
$site = "../";
$repertoire = 'img';
$title = "Mes images";
$_POST['repertoire'] = $repertoire;//je place la variable dans une superglobale qui me servira plus tard
$origine = $_SERVER['HTTP_REFERER'];
$controle = '';



	
///////// INCLUSION DU HEADER /////////////////////	

if($_SERVER['HTTP_HOST'] == 'localhost')
{
  $url = "C:\wamp64\www";
}
else{
  $url = "/home/marcharnss/www";
}
include($url.'/private/inc/header.php');
/////////////// fin du header ///////////////////////

$h_vign = '';


// url du fichier qui contient les images
$chemin = $site.$repertoire;//on cherche le chemin du dossier
$urlphoto = $chemin;//on efface le nom du fichier de gestion des img


// nom du répertoire qui contient les images
$repertoire = $_POST['repertoire'];
$nomRepertoire = '../' . $repertoire;
if (is_dir($nomRepertoire))
   {
   $dossier = opendir($nomRepertoire);
   while ($Fichier = readdir($dossier))
       {
      if ($Fichier != "." AND $Fichier != ".." AND (stristr($Fichier,'.gif') OR stristr($Fichier,'.jpg') OR stristr($Fichier,'.png') ))//OR stristr($Fichier,'.bmp')
        {
        // Hauteur de toutes les images
        $taille = getimagesize($nomRepertoire."/".$Fichier);
		$largeur = $taille[0];// $taille[0] c'est la largeur de l'image
		$hauteur = $taille[1]; // taille [1] c'est la hauteur de l'image
        $reduc  = floor(($h_vign*100)/($taille[1]));// on réduit la largeur proportionnellement à la nouvelle hauteur
        $l_vign = floor(($taille[0]*$reduc)/100);
      if ($hauteur < $h_vign)//si la hauteur de l'image est trop petite, on affiche tout en taille réelle
	  {
          echo '<p><a href="' . $Fichier . '">';
          echo '<img style="border:none;"  alt="' . $Fichier . '" src="', $urlphoto, '/',$Fichier, '" ';
          //echo "width='$largeur' height='$hauteur'";
          echo "><br /><br />";
		  echo $Fichier . '<br /></a>';
	   }
		else
		{
          echo '<p><a href="', $urlphoto, '/',$Fichier, '">';
          echo '<img style="border:none;"  alt="' . $Fichier . '" src="', $urlphoto, '/',$Fichier, '" ';
          //echo "width='$l_vign' height='$h_vign'";
          echo "><br /><br />";
		  echo $Fichier . '<br /></a> ';
		}		
	   }
        }    
		echo '</p>';
   closedir($dossier);
   }
   else{
   echo' Le répertoire spécifié n\'existe pas, il faut correctement renseigner la ligne 23';
   }

   
   







// INCLUSION DU FOOTER  ////////////////
if($_SERVER['HTTP_HOST'] == 'localhost')
{
  $url = "C:\wamp64\www";
}
else{
  $url = "/home/marcharnss/www";
}
include($url.'/private/inc/footer.php');
// FIN DU FOOTER ///////////////////////
?>
