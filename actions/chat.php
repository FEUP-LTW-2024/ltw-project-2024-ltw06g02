<?php 
   require_once('../database/connection.php');
   require_once('../database/messages.php');

   $db = getDatabaseConnection();

   $stmt = $db->prepare("SELECT * FROM message WHERE chatID = ?");
   $stmt->bindParam(1, $_GET['q']);
   $stmt->execute();
   $messages = $stmt->fetchAll();

   $chat = getSpecificChat($_GET['q']);

   echo '<div class="chat-info">
      <img src="../assets/goiana.jpg" alt=""/>
      <h3>' . $chat['username'] . '</h3>
   </div>
   <input type="text"/> ';
   exit;
?>