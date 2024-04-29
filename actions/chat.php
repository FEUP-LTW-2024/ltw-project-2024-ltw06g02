<?php 
   require_once('../database/connection.php');
   require_once('../database/messages.php');
   require_once('../database/user.php');
   require_once('../models/session.php');

   $session = new Session();

   $db = getDatabaseConnection();

   $messages = joinMessages($_GET['q']);

   $user = retrieveUser($_GET['q']);

   echo '<div class="chat-info">
            <img src="../assets/goiana.jpg" alt=""/>
            <h3>' . $user['username'] . '</h3>
         </div>
         <div class="messages">';

         foreach($messages as $message){
            $isSenderMessage = $_GET['q'] == getChatFromMessage($message['messageID']);

            $messageClass = $isSenderMessage ? 'message-sent' : 'message-received';

            echo '<div class="' . $messageClass . '">
                  <p>' . $message['messageText'] . '</p></div>';
         }

   echo  '</div>
         <input type="text"/>';
   exit;
?>