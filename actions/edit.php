<?php 
   require_once("../models/session.php");
   require_once("../models/user.php");
   require_once("../database/user.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

      if(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email'])){
         $session->addMessage('error', 'Fill out at least one camp');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      $new_username = empty($_POST['username']) ? retrieveUser($session->getUserId())['username'] : $_POST['username'];
      $new_password = empty($_POST['password']) ? retrieveUser($session->getUserId())['password'] : password_hash($_POST['password'], PASSWORD_DEFAULT);
      $new_email = empty($_POST['email']) ? retrieveUser($session->getUserId())['email'] : $_POST['email'];;

      updateUser($new_username, $new_password, $new_email, $session->getUserId());
      $session->setUsername($new_username);

      $session->addMessage('success', 'Profile edited');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }
?>