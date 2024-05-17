<?php 
   require_once(dirname(__DIR__) . "/models/session.php");
   require_once(dirname(__DIR__) . "/database/filters.php");
   require_once(dirname(__DIR__) . "/database/connection.php");

   $session = new Session();

   $db = getDatabaseConnection();

   if(isset($_POST['category']) && isset($_POST['size']) && isset($_POST['condition'])){
      if(!updatePreferences($db, $_POST['category'], $_POST['size'], $_POST['condition'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      };

      $session->addMessage('success', 'Preferences saved');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }
   exit();
?>