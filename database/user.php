<?php
   require_once('connection.php');
   require_once(dirname(__DIR__) . '/models/user.php');

   function registerUser($user) : bool{
      $db = getDatabaseConnection();

      if(!checkUserExists($user)){
         $stmt = $db->prepare(
            "INSERT INTO users(username, email, password) VALUES(?,?,?)"
         );
         $stmt->bindParam(1, $user->username);
         $stmt->bindParam(2, $user->email);
         $stmt->bindParam(3, $user->password);
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

   function displayUserItems($userId) {
      $db = getDatabaseConnection();

      $stmt = $db->prepare("SELECT * FROM product WHERE userID = :userId");
      $stmt->execute(['userId' => $userId]);
      
      $userItems = $stmt->fetchAll();
      return $userItems;
   }

   function retrieveUser($id){
      $db = getDatabaseConnection();

      $stmt = $db->prepare("SELECT * FROM users WHERE userID = ?");
      $stmt->bindParam(1, $id);
      $stmt->execute();

      $user = $stmt->fetch();

      return $user;
   }

   function updateUser($username, $password, $email, $id){
      $db = getDatabaseConnection();

      $stmt = $db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE userID = ?");
      $stmt->execute(array($username, $email, $password, $id));
   }
?> 