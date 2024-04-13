<?php
   session_start();

   require_once('templates/forms.tl.php');

   if (isset($_SESSION['username'])){
      header('Location: index.php');
      die(0);
   }

   buildRegisterForm();
   buildLoginForm();
?>