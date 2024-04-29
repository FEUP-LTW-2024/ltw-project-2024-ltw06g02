<?php 
   require_once('connection.php');

   function getUserChats($db){
      $stmt = $db->prepare(
         "SELECT * FROM chat LEFT JOIN users ON users.userID = chat.senderID WHERE receiverID = ?"
      );

      $stmt->execute(array($_SESSION['userID']));
      $chats = $stmt->fetchAll();

      return $chats;
   }

   function getSpecificChat($id){
      $db = getDatabaseConnection();
      $stmt = $db->prepare("SELECT * FROM chat LEFT JOIN users ON users.userID = chat.senderID WHERE chatID = ?");
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $chat = $stmt->fetch();
      return $chat;
   }
?>