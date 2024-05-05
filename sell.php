<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/upload.tl.php');
   require_once('database/connection.php');
   require_once('database/filters.php');
   require_once('models/session.php');

   $session = new Session();

   $db = getDatabaseConnection();
   $categories = getAllCategories($db);

   printHeader('Bazinga!');
   printUploadSection();
   printInfoSection($categories);
   printFooter();
?>