<?php
  if (isset($perso)){  // if connected
	?>
	<h2>
	Bienvenue <?=$name;?> !
	</h2>
	<p class = "p_rule">
	Vous démarrez avec  <?=$lifeStart;?> vies.<br />
	Chaque bonne réponse vous permet d'accomplir une mission, et
	vous fait gagner <?=$agilityPoint;?> point d'agilité.<br />
	<?=$agilityPointFor1Life;?> points d'agilité vous donnent doit
	à une vie supplémentaire.<br /> 
	Une mauvaise réponse vous coûte une vie, vous pouvez réessayer
	la même question.<br /> 
	Bonne partie!</p>
	<p><a class = "BigPinkButton" href = "<?=PAGE_URL;?>game">Jouer</a></p>
	<?php
	}
    else { 		// Connect
		?>
        <h2>
			Créez votre personnage
		</h2>
        <form action="" method="post">
          <p>
			Choisissez un pseudo:<br />
			<input class = "input_blanc" type="text" name="name" maxlength="50" value="<?=$save_pseudo;?>" />
		  </p>
          <p>
            Puis un mot de passe:<input class = "input_blanc" type="password" name="password" maxlength="250" /><br />
			<input class = "submit"  type="submit" value="S'enregistrer" name="creer" />
          </p>
        </form>
		<?php
	}
	if(($message->Red()) != ""){
	  ?>	
	  <p class = "messageRed">
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
?>