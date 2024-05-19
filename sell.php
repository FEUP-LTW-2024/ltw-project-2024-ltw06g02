<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/upload.tl.php');
   require_once('database/filters.php');
   require_once('models/session.php');

   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $categories = getAllCategories();
   $sizes = getAllSizes();
   $conditions = getAllConditions();

   printHeader('Bazinga!', $session);
   printUploadSection();
   printInfoSection($categories, $sizes, $conditions);
   printFooter();
?>