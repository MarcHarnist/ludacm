<?php 
/**   File view/contact.php: just html and
*     a little php. 07/09/2017 M.Harnist
**/   $capcha = rand(1,5);// Prepare $capcha
?>
 <h2>Contactez-nous!</h2>
  <form action="<?=PAGE_URL . 'contact_verif';?>" method="post">
    <p class = "white center">
      Votre email : <br />
      <input size="30" name="email" type="text" /><br />
      Le message : <br />
      <textarea name="message" rows="5" cols="30"></textarea><br />
      Je ne suis pas un robot: <?php $capcha = rand(1,5); 
	  echo $capcha;?> + 1 =<input name="capcha_reponse" size="3" />
      <input type="hidden" name="capcha" value="<?php $capcha++;
	  echo $capcha;?>" />
      </p>
     <p class = "white center">
     <input class="submit"  type="submit" value="Envoyer" /> 
    </p>
  </form>
  