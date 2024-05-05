<?php 
   require_once('../database/connection.php');
   require_once('../database/messages.php');
   require_once('../database/user.php');
   require_once('../models/session.php');

   $session = new Session();

   $messages = joinMessages($_GET['q']);

   $user = retrieveUser($_GET['q']);

   echo '<div class="chat-info">
            <img src="../assets/goiana.jpg" alt=""/>
            <h3>' . $user['username'] . '</h3>
         </div>
         <div class="messages">';

         foreach($messages as $message){
            $chat = getSpecificChat($message['chatID']);

            $isSenderMessage = $_GET['q'] != $chat['senderID'];

            $messageClass = $isSenderMessage ? 'message-sent' : 'message-received';

            echo '<div class="' . $messageClass . '">
                  <p>' . $message['messageText'] . '</p></div>';
         }

   echo  '</div>
         <form class="message-input" id="message-form">
            <input type="text" class="input-field" placeholder="Type a message..."/>
            <button type="submit" class="send-button">send</button>
         </form>';
?>
