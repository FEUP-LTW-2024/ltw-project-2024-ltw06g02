<?php
   require_once('connection.php');
   require_once('articles.php');
   require_once(dirname(__DIR__) . '/models/user.php');

   function registerUser($user) : bool{
      $db = getDatabaseConnection();

      if(!checkUserExists($user)){
         $stmt = $db->prepare(
            "INSERT INTO users(fullName, username, email, password, admin, followers, preferencesID) VALUES(?,?,?,?,?,?,?)"
         );
         $stmt->bindParam(1, $user->fullName);
         $stmt->bindParam(2, $user->username);
         $stmt->bindParam(3, $user->email);
         $stmt->bindParam(4, $user->password);
         $stmt->bindParam(5, $user->admin);
         $stmt->bindParam(6, $user->followers);
         $stmt->bindParam(7, $user->preferences);
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
         $sql = "UPDATE users SET admin = TRUE WHERE username = ?";
         $stmt = $db->prepare($sql);
         $stmt->bindParam(1, $username);
         $stmt->execute();

         return true;
      }
      return false;
   }

   function checkIfUserIsAdmin($username) : bool{
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT username FROM users WHERE admin=TRUE"
      );
      $stmt->execute();
      $users = $stmt->fetchAll();

      foreach($users as $user){
         if($user['username'] == $username) return true;
      }

      return false;
   }

   function getAllUsersRegistered(){
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT username, userID FROM users ORDER BY userID"
      );
      $stmt->execute();
      $users = $stmt->fetchAll();

      return $users;
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

   function changePhoto($filepath, $id){
      $db = getDatabaseConnection();

      $stmt = $db->prepare("UPDATE users SET avatar = ? WHERE userID = ?");
      $stmt->execute(array($filepath, $id));
   }

   function getUserFollowers($userId){
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT followers FROM users WHERE userID=?"
      );
      $stmt->bindParam(1, $userId);
      $stmt->execute();
      $followers = $stmt->fetchColumn();

      return $followers;
   }

   function getUserTotalLikes($userId){
      $db = getDatabaseConnection();

      $articles = getUserArticles($db, $userId);

      $totalLikes = 0;
      foreach($articles as $article){
         $totalLikes += $article['likes'];
      }

      return $totalLikes;
   }

   function checkNameExists($name) : bool{
      $users = getAllUsersRegistered();

      foreach($users as $user){
         if($user['username'] == $name){
            return true;
         }
      }
      
      return false;
   }

   function getUserIdByName($name){
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT userID FROM users WHERE username=?"
      );
      $stmt->bindParam(1, $name);
      $stmt->execute();

      $result = $stmt->fetchColumn();
      return $result;
   }
?> 