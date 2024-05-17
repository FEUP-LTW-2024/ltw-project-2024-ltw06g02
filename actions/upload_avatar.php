<?php
   require_once("../database/user.php");
   require_once('../models/session.php');

   $session = new Session();

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      if (isset($_FILES['image'])) {
         $files = $_FILES['image'];

         $filename = $files['name'];
         $tmp = $files['tmp_name'];

         $filepath = '../assets/users/' . $filename;
            

         $success = move_uploaded_file($tmp, $filepath);
         if(!$success) {
            $session->addMessage('error', 'Error occurred');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
         }

         changePhoto($filepath, $_SESSION['userID']);
         
         $session->addMessage('success', 'Avatar changed');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
   }
?>