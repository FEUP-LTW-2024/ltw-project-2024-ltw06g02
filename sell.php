<?php
   session_start();
   
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/upload.tl.php');
   require_once('database/connection.php');
   require_once('database/filters.php');

   $db = getDatabaseConnection();
   $filters = getAllFilters($db);

   printHeader('Bazinga!');
   printUploadSection();
   printInfoSection($filters);
   printFooter();
?>