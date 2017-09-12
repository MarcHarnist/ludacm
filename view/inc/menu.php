<?php
// $connected = False;
// if (isset($_SESSION['perso'])){ // If session perso exists, restore object
  // $connected = True;
// }
?>

<p class = "menu">
	<a class = "nu" title = "Accueil" href="<?=PAGE_URL;?>">
	 <img src="<?=IMG_URL;?>home.png" alt="maison" />
	</a> 
	<a class = "nu" title = "Page contact" href="<?=PAGE_URL;?>contact">
	 <img src="<?=IMG_URL;?>logoMail.png" alt="enveloppe" />
	</a> 
	<a class = "nu" title = "Voir son Profil" href="<?=PAGE_URL;?>profil">
	 <img src="<?=IMG_URL;?>child.png" alt="têtes d'enfants logo du profil" />
	</a>
</p>
<!--<span class="floatRight right hamburger">-->
<div id = "menu_hamburger">
	<div id="hamburger" class="niveau1">
		<img src="<?=IMG_URL;?>hamburger.png" alt="Menu hamburger" />
		<div id="SOUShamburger" class="niveau2">
				<span>
					<h2>Menu</h2>
						<?php
						if(isset($_SESSION['perso']) & $page !== "connection" & $page !== "register" & $page !== "deconnection"){ 
						// If the player is connected
						?>

			<p>
			 <a class = "BigPinkButton"  href="<?=PAGE_URL;?>profil">
			 Voir mon profil
			 </a>
			</p>
			<p>
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>game">
			    Jouer
			 </a>
			</p>
			<p class = "center">
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>contact">
				Nous contacter
			 </a>
			</p>
			<p>
			 <a class = "BigPinkButton"  href="<?=PAGE_URL;?>quitter">
			 Déconnexion</a>
			</p>






						<?php
} else {
?>
			<p>
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>profil">
				Se connecter
			 </a>	
			</p>
			<p>
			 <a class = "BigPinkButton" href = "<?=PAGE_URL;?>register">
				S'enregistrer
			 </a>	
			</p>
			<p>
				<a class = "BigPinkButton" href = "<?=PAGE_URL;?>contact">
				Nous contacter
				</a>
			</p>	
<?php	
}
?>
</div>
</span>
				</div>	
			</div>	
<!--</span>-->
	