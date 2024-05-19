<?php 
   require_once(__DIR__ . '/../models/session.php');
   require_once(__DIR__ . '/../database/filters.php');

   $session = new Session();

   if(isset($_POST['category']) && isset($_POST['size']) && isset($_POST['condition'])){
      if(!updatePreferences($_POST['category'], $_POST['size'], $_POST['condition'])){
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