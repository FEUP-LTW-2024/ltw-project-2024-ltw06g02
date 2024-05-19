<?php
   require_once(__DIR__ . '/../templates/footer.tl.php');
   require_once(__DIR__ . '/../templates/header.tl.php');
   require_once(__DIR__ . '/../templates/upload.tl.php');
   require_once(__DIR__ . '/../database/filters.php');
   require_once(__DIR__ . '/../models/session.php');

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