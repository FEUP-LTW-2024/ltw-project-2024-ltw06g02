<?php
   require_once(__DIR__ . '/../templates/footer.tl.php');
   require_once(__DIR__ . '/../templates/header.tl.php');
   require_once(__DIR__ . '/../templates/historic.tl.php');
   require_once(__DIR__ . '/../database/historic.php');
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $purchases = getPurchasesByUserId($_SESSION['userID']);
   $sales = getSalesByUserId($_SESSION['userID']);

   printHeader('Bazinga!', $session);
   printPurchasesSection($purchases);
   printSalesSection($sales);
   printMetrics($sales);
   printFooter();
?>