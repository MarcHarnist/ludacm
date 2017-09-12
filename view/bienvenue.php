<?php
session_start();
/*	PAGE CREEE LE 5 SEPT 2017 
	PAR MARC HARNIST 61GrandRueMauzé 
*/
		if (!isset($_SESSION['perso'])){
			// If session perso doesn't exists: connect
			?>  
			<h1 class = "h1Bottom260">Bienvenue !</h1>
			
			<p class = "top50">
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>profil">
			  Se connecter <!-- PAGE_URL = constant: root/index?page= -->
			 </a>	
			</p>
			<p>
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>register">
			  Créer un compte
			 </a>	
			</p>
			<?php  
		} // close if isset $perso doesn't exists
		else {
			$perso = $_SESSION['perso'];
			?> 
			<h1>Menu</h1>
			
			<p class = "break">
			 <a class = "BigPinkButton"  href="<?=PAGE_URL;?>profil">
			 Voir mon profil
			 </a>
			</p>
			<p>
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>game">
			    Jouer
			 </a>
			</p>
			<p class = "break">
			 <a class = "BigPinkButton"  href="<?=PAGE_URL;?>quitter">
			 Déconnexion</a>
			</p>
			<?php
		} // close else