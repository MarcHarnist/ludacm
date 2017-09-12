<?php
if (isset($_SESSION['perso'])){ // If session perso exists, restore object
  $perso = $_SESSION['perso'];
}
?><!doctype html>      <!-- www/view/inc/header  -->
<html lang="fr">
 <head>
  <link rel="stylesheet" href="<?=CSS_URL;?>style.css">
  <link rel="stylesheet" href="<?=CSS_URL . $page;?>.css">
  <meta name="viewport" content="width=device-width"/>
  <meta charset="UTF-8" />
  <title><?php echo WEBSITE_NAME . ' ' . $title;?></title>
 </head>
 <body>
   <div class = "page"><!-- Page = Main -->
   <!-- Here comes the menu -->