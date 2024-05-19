<?php 
   require_once(__DIR__ . '/connection.php');
   require_once(__DIR__ . '/articles.php');

   $db = getDatabaseConnection();

   function getUserChats(){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM chat LEFT JOIN users ON users.userID = chat.senderID WHERE receiverID = ?"
      );

      $stmt->execute(array($_SESSION['userID']));
      $chats = $stmt->fetchAll();

      return $chats;
   }

   function getSpecificChat($id){
      global $db;

      $stmt = $db->prepare("SELECT * FROM chat LEFT JOIN users ON users.userID = chat.senderID WHERE chatID = ?");
      $stmt->execute(array($id));
      $chat = $stmt->fetch();
      return $chat;
   }

   function getUserSenderChatID($senderID) {
      global $db;

      $stmt = $db->prepare("SELECT chatID FROM chat WHERE senderID = ? AND receiverID = ?");
      $stmt->execute(array($_SESSION['userID'], $senderID));
      $chat = $stmt->fetch();
      return $chat['chatID'];
   }

   function getUserReceiverChatID($senderID){
      global $db;

      $stmt = $db->prepare("SELECT chatID FROM chat WHERE senderID = ? AND receiverID = ?");
      $stmt->execute(array($senderID, $_SESSION['userID']));
      $chat = $stmt->fetch();
      return $chat['chatID'];
   }

   function joinMessages($senderID){
      global $db;

      $stmt = $db->prepare("SELECT chatID FROM chat WHERE (receiverID = ? AND senderID = ?) OR (senderID = ? AND receiverID = ?)");
      $stmt->execute(array($_SESSION['userID'], $senderID, $_SESSION['userID'], $senderID,));
      $chats = $stmt->fetchAll();

      $stmt = $db->prepare("SELECT * FROM message WHERE chatID = ? or chatID = ?");
      $stmt->execute(array($chats[0]['chatID'], $chats[1]['chatID']));
      $messages = $stmt->fetchAll();
      return $messages;
   }

   function insertMessage($message, $senderID) {
      global $db;

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

   function removeChat($id) : bool{
      $db = getDatabaseConnection();
      $stmt = $db->prepare("DELETE FROM chat WHERE productID = ?");
      $stmt->execute(array($id));

      return true;
   }

   function verifyChatExists($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT chatID from chat WHERE (senderID = ? and receiverID = ?)"
      );
      $stmt->execute(array($id, $_SESSION['userID']));
      $chat = $stmt->fetch();
      return $chat;
   }

   function createChat($productID){
      global $db;

      $article = getArticleById($productID);

      if(empty(verifyChatExists($article['userID']))){
         $stmt = $db->prepare(
            "INSERT INTO chat(receiverID, senderID, productID) VALUES (?,?,?)"
         );
         $stmt->execute(array($_SESSION['userID'], $article['userID'], $productID));

         $stmt = $db->prepare(
            "INSERT INTO chat(receiverID, senderID, productID) VALUES (?,?,?)"
         );
         $stmt->execute(array($article['userID'], $_SESSION['userID'], $productID));

         return true;
      }

      return false;
   }
?>