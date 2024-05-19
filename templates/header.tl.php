<?php 
  require_once(__DIR__ . '/navbar.tl.php');
  
  function printHeader($title, $session){
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?=$title?></title>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/navbar.css" rel="stylesheet">
    <link href="../css/footer.css" rel="stylesheet">
    <link href="../css/forms.css" rel="stylesheet">
    <link href="../css/landing.css" rel="stylesheet">
    <link href="../css/productPage.css" rel="stylesheet">
    <link href="../css/wishlist.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="../css/sell.css" rel="stylesheet">
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/messages.css" rel="stylesheet">
    <link href="../css/cart.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
  </head>
  <body>
    <main>
      <header>
        <?php printNavBar() ?>
        <section id="messages">
          <?php foreach ($session->getMessages() as $messsage) { ?>
            <article class="<?=$messsage['type']?>">
              <?=$messsage['text']?>
            </article>
          <?php } ?>
      </section>  
      </header>

<?php
   }
?>