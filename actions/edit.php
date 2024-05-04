<?php 
   require_once("../models/session.php");
   require_once("../models/user.php");
   require_once("../database/user.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $new_username = empty($_POST['username']) ? retrieveUser($session->getUserId())['username'] : $_POST['username'];
      $new_password = empty($_POST['password']) ? retrieveUser($session->getUserId())['password'] : password_hash('bazinga'.$_POST['password'].'bazinga', PASSWORD_DEFAULT);
      $new_email = empty($_POST['email']) ? retrieveUser($session->getUserId())['email'] : $_POST['email'];;

      if(empty($new_username) && empty($new_password) && empty($new_email)){
         die(header('Location: ../profile.php'));
      }

      updateUser($new_username, $new_password, $new_email, $session->getUserId());
      $session->setUsername($new_username);

      die(header('Location: ../profile.php'));
   }
?>