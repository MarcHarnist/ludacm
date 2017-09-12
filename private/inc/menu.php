<p>
<?php // Since php5: "[" = array !
  $liens = [
        "<a href=\" $url_admin/\">Private</a>",
        "<a href=\"$url_admin/formulaire/\"formulaire/>Questions</a>",
        "<a href=\"$url_admin/player/\"//>Joueurs</a>",
        "<a href=\"$url_admin/journal.php\">Journal</a>",
        "<a href=\"$$website_url\"  target=\"_blank\">Site web publique</a>"
  ];  
  foreach ($liens as $liens) : // foreach do something for each var off $liens !
  echo " - $liens";
  endforeach;
?>
