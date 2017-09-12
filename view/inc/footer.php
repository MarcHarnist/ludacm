
 </div> <!-- close div "page" from header-->
    <div class = "footer"><!-- www/view/inc/footer  -->  
      <h6><!-- ->style.css -->
        Réalisation: 
		<a href="<?=WEBSITE_URL;?>"><?=$website_owner;?></a> - 
		<a href="http://validator.w3.org/check/referer">HTML5</a> - 
		<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS3
		</a>
		<?php
		// store perso in session var to economyse a SQL request.
		if (isset($perso)) $_SESSION['perso'] = $perso;
		?>
	
      </h6>    
    </div> <!-- close div footer -->
  </body>
</html>