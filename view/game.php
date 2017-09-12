<?php	 
    if(($message->Normal()) != ""){
      ?>	
      <p class = "messageNormal p_pinkButton">
    	<?php echo $message->Normal();?>
      </p>
      <?php
    }
	if(($message->Red()) != ""){
      ?>	
      <p class = "messageRed p_pinkButton">
    	<?php echo $message->Red();?>
      </p>
      <?php
    }
    if(($message->Green()) != ""){
      ?>
      <p class = "messageGreen">
    	<?php echo $message->Green();?>
      </p>
      <?php
    }
    if (isset($perso)) // Si on utilise un personnage (nouveau ou pas).
    {
        ?>
      <fieldset>
        <legend>
          <h4>Pseudo: <?= htmlspecialchars($perso->name());?>
          </h4>
        </legend>
        <h4>
          <img class="logo" src="<?=IMG_URL;?>heart.png" alt="coeur représentants les vies" /> Vies: <span class = "pink"><?= $perso->life() ?></span>
          <img class="logo"  src="<?=IMG_URL;?>mission.png" alt="symbole de mission" />  Missions: <span class = "pink"><?= $perso->mission() ?></span>
          <img class="logo"  src="<?=IMG_URL;?>agility.png" alt="symbole d'agilité" />  Agilité: <span class = "pink"><?= $perso->agility() ?></span>
        </h4>
      </fieldset>
	  <?php
             if(!isset($EndGame)){
				 ?>
	<fieldset>
        <legend>
          <h2>
            <?php
			echo $id;
	// var_dump($id);		
			?> <!-- Affiche numéro de la question -->
          </h2>
        </legend>
        <p>
          <?=$question;?>
        </p>
        <form class="" method="post" action="" />
          <p >
            <label for="firstAnswer">
              <input id="firstAnswer" type="radio" name="answer" value="<?=$bool1;?>" >
                <?=$reponse1;?>
              </input>
            </label>
          </p>
          <p >
            <label for="secondAnswer">
              <input id="secondAnswer" type="radio" name="answer" value="<?=$bool2;?>">
                    <?=$reponse2;?>
              </input>
            </label>
          </p>
          <p>
            <label for="thirdAnswer">
              <input id="thirdAnswer" type="radio" name="answer" value="<?=$bool3;?>">
                <?php echo $reponse3;?>
              </input>
            </label>
          </p>
            <input type="submit" value="valider" />
        </form>
      </fieldset> 
      <?php
        } // close if($EndGame != "Yes"){ on line 205
      }
	  ?>