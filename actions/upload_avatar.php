<?php
   session_start();

   require_once("../database/user.php");

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      if (isset($_FILES['image'])) {
         $files = $_FILES['image'];

         $filename = $files['name'];
         $tmp = $files['tmp_name'];

         $filepath = '../assets/users/' . $filename;
            

         $success = move_uploaded_file($tmp, $filepath);
         if(!$success) {
            echo("Error");
         }

         changePhoto($filepath, $_SESSION['userID']);
         die(header("Location: ../profile.php"));
      }
   }
?>