<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/historic.tl.php');
   require_once('database/connection.php');
   require_once('database/historic.php');
   require_once('models/session.php');

   $db = getDatabaseConnection();
   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $purchases = getPurchasesByUserId($db, $_SESSION['userID']);
   $sales = getSalesByUserId($db, $_SESSION['userID']);

   printHeader('Bazinga!', $session);
   printPurchasesSection($purchases);
   printSalesSection($sales);
   printMetrics($sales);
   printFooter();
?>