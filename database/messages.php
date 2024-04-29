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

   function getUserSenderChatID($senderID) {
      $db = getDatabaseConnection();
      $stmt = $db->prepare("SELECT chatID FROM chat WHERE senderID = ? AND receiverID = ?");
      $stmt->execute(array($_SESSION['userID'], $senderID));
      $chat = $stmt->fetch();
      return $chat['chatID'];
   }

   function getUserReceiverChatID($senderID){
      $db = getDatabaseConnection();
      $stmt = $db->prepare("SELECT chatID FROM chat WHERE senderID = ? AND receiverID = ?");
      $stmt->execute(array($senderID, $_SESSION['userID']));
      $chat = $stmt->fetch();
      return $chat['chatID'];
   }

   function joinMessages($senderID){
      $db = getDatabaseConnection();
      $stmt = $db->prepare("SELECT chatID FROM chat WHERE (receiverID = ? AND senderID = ?) OR (senderID = ? AND receiverID = ?)");
      $stmt->execute(array($_SESSION['userID'], $senderID, $_SESSION['userID'], $senderID,));
      $chats = $stmt->fetchAll();

      $stmt = $db->prepare("SELECT * FROM message WHERE chatID = ? or chatID = ?");
      $stmt->execute(array($chats[0]['chatID'], $chats[1]['chatID']));
      $messages = $stmt->fetchAll();
      return $messages;
   }

   function getChatFromMessage($messageID){
      $db = getDatabaseConnection();
      $stmt = $db->prepare("SELECT chatID FROM message WHERE messageID = ?");
      $stmt->bindParam(1, $messageID);
      $stmt->execute();
      $chat = $stmt->fetch();

      $chat = getSpecificChat($chat['chatID']);
      return $chat['chatID'];
   }
   function insertMessage($message, $senderID) {
      $db = getDatabaseConnection();
      $chatID_1 = getUserSenderChatID($senderID);
      $chatID_2 = getUserReceiverChatID($senderID);
      $stmt = $db->prepare(
         "INSERT INTO message(chatID, messageText) VALUES(?, ?)"
      );
      $stmt->execute(array($chatID_1, $message));
   
      $stmt = $db->prepare(
         "UPDATE chat SET lastAction = ? WHERE (chatID = ? or chatID = ?)"
      );
      $stmt->execute(array($message, $chatID_1, $chatID_2));
   }
?>