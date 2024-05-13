<?php
   session_start();

   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/historic.tl.php');
   require_once('database/connection.php');
   require_once('database/historic.php');

   $db = getDatabaseConnection();

   $purchases = getPurchasesByUserId($db, $_SESSION['userID']);
   $sales = getSalesByUserId($db, $_SESSION['userID']);

   printHeader('Bazinga!');
   printPurchasesSection($purchases);
   printSalesSection($sales);
   printFooter();
?>