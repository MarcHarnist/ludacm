<?php
session_start(); //Call session_start() after autoload 
/*	PAGE CREEE LE 5 SEPT 2017 
		PAR MARC HARNIST 61GrandRueMauzé 
*/
		if (!isset($_SESSION['perso'])){
			// If session perso doesn't exists: connect
            $perso = $_SESSION['perso'];
			header('Location: ' . PAGE_URL);
		} // close if isset $perso doesn't exists
		else {
			$perso = $_SESSION['perso'];
			?> 
			<h1 class = "h1Bottom260">Quitter</h1>
			<p class = "center">
				<a class = "BigPinkButton" href = "<?=PAGE_URL;?>contact">
				Laisser votre avis
				</a>
			</p>	
			<p class = "break">
			 <a class = "BigPinkButton"  href="<?=PAGE_URL;?>deconnection">
			 Se deconnecter</a>
			</p>
			<?php
		} // close else