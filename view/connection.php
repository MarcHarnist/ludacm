<?php
if (isset($perso)){ // If connected, go to profil page
	header('Location: ' . PAGE_URL . 'profil');
}
else {    // Else: connect
    ?>
    <h2>Se connecter</h2>
        <form action="" method="post">
			<p>Votre pseudo
			<input class = "input_blanc" type="text" name="name" maxlength="50" value="<?=$save_pseudo;?>" />
			</p>
			<p>Votre mot de passe 
			<input class = "input_blanc" type="password" name="password" maxlength="250"/><br />
            <input class = "submit" type="submit" value="Se connecter" name="utiliser" />
			</p>
        </form>
		<?php
	if(($message->Red()) != ""){
		?>	
		<p class = "messageRed">
		<?php echo $message->Red();?>
		</p>
		<?php
	}
	elseif(($message->Green()) != ""){
		?>
		<p class = "messageGreen">
		<?= $message->Green();?>
		</p>
		<?php
	}
}