<?php 
  require_once('templates/navbar.tl.php');
  function printHeader($title){
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?=$title?></title>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <link href="css/landing.css" rel="stylesheet">
    <link href="css/productPage.css" rel="stylesheet">
    <link href="css/wishlist.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="css/sell.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <?php printNavBar() ?>  
    </header>

<?php
   }
?>