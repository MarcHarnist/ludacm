	<?php
      if (isset($perso)){
        // Si on utilise un personnage.
        ?>
		<div class = "page_profil_colonne_droite">
        <h2>Votre profil</h2>
          <fieldset class = "fieldset_profil">
            <legend>
              <h3><?= htmlspecialchars($perso->name());?>
              </h3>
            </legend>
            <h3>
            <img class="logo" src="<?=IMG_URL;?>heart.png" alt="coeur représentants les vies" /> Vies: <span class = "pink right"><?= $perso->life() ?></span>
            </h3>
            <h3>
            <img class="logo"  src="<?=IMG_URL;?>mission.png" alt="symbole de mission" /> Missions:  <span class = "pink right"><?= $perso->mission() ?></span>
            </h3>
            <h3>
            <img class="logo"  src="<?=IMG_URL;?>agility.png" alt="symbole d'agilité" /> Agilité:  <span class = "pink right"><?= $perso->agility() ?></span>
            </h3>
            <h3>
             Dernière question répondue:<span class = "pink right"><?=$perso->lastquestion()?></span>
            </h3>
		  <p>
	        <a class = "BigPinkButton" href = "<?=PAGE_URL;?>game">
		      Jouer
		    </a>	
	      </p>
          </fieldset>
		  </div><!-- Close <div class = "page_profil_colonne_droite"> -->
        <?php
      }
      else {
		  // Se connecter ou créer un personnage
		  header('Location: ' . PAGE_URL . 'connection');
      }