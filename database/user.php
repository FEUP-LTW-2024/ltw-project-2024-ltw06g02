<?php
   require_once('connection.php');
   function registerUser($user) : bool{
      $db = getDatabaseConnection();

      if(!checkUserExists($user)){
         $stmt = $db->prepare(
            "INSERT INTO users(username, email, password, admim) VALUES(?,?,?,?)"
         );
         $stmt->bindParam(1, $user->username);
         $stmt->bindParam(2, $user->email);
         $stmt->bindParam(3, $user->password);
         $stmt->bindParam(4, $user->admin);
         $stmt->execute();
         return true;
      }
      return false;
   }

   function loginUser($username, $password) : bool {
      $db = getDatabaseConnection();
      $stmt = $db->prepare(
         "SELECT username, password FROM users WHERE username=?"
      );
      $stmt->bindParam(1, $username);
      $stmt->execute();
      $credentials = $stmt->fetch();

      if($credentials) {
         if(password_verify('bazinga' . $password . 'bazinga', $credentials['password'])) {
             return true;
         }
     }
      return false;
   }

   function checkUserExists($user) : bool{
      $db = getDatabaseConnection();
      $stmt = $db->prepare(
         "SELECT username FROM users WHERE username=? OR email=?"
      );
      $stmt->bindParam(1, $user->username);
      $stmt->bindParam(2, $user->email);
      $stmt->execute();
      $user = $stmt->fetch();

      if($user){
         return true;
      }
      return false;
   }

   function checkUserExistsByName($username) : bool{
      $db = getDatabaseConnection();
      $stmt = $db->prepare(
         "SELECT username FROM users WHERE username=?"
      );
      $stmt->bindParam(1, $username);
      $stmt->execute();
      $user = $stmt->fetch();

      if($user){
         return true;
      }
      return false;
   }

   function elevateUser($username) : bool {
      $db = getDatabaseConnection();

      if(checkUserExistsByName($username)){
         $sql = "UPDATE users SET admim = TRUE WHERE username = ?";
         $stmt = $db->prepare($sql);
         $stmt->bindParam(1, $username);
         $stmt->execute();

         return true;
      }
      else{
         return false;
      }

   }

   function checkIfUserIsAdmin($username) : bool{
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT username FROM users WHERE admim=TRUE"
      );
      $stmt->execute();
      $users = $stmt->fetchAll();

      foreach($users as $user){
         if($user['username'] == $username) return true;
      }

      return false;
   }
?> 