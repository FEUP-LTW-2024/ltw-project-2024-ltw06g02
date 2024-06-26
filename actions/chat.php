<?php 
   require_once(__DIR__ . '/../database/connection.php');
   require_once(__DIR__ . '/../database/messages.php');
   require_once(__DIR__ . '/../database/user.php');
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   $messages = joinMessages($_GET['q']);

   $user = retrieveUser($_GET['q']);

   echo '<div class="chat-info">
            <img src=' . $user['avatar'] .  ' alt=""/>
            <h3>' . $user['username'] . '</h3>
         </div>
         <div class="messages">';

         foreach($messages as $message){
            $chat = getSpecificChat($message['chatID']);

            $isSenderMessage = $_GET['q'] != $chat['senderID'];

            $messageClass = $isSenderMessage ? 'message-sent' : 'message-received';

            $m = preg_replace ("/[^a-zA-Z0-9\s]/", '', $message['messageText']);

            echo '<div class="' . $messageClass . '">
                  <p>' . $m . '</p></div>';
         }

   echo  '</div>
         <form class="message-input" id="message-form">
            <input type="text" class="input-field" placeholder="Type a message..."/>
            <button type="submit" class="send-button">send</button>
         </form>';
?>
