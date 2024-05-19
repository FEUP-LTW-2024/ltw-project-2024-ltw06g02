<?php 
   require_once(__DIR__ . '/../database/articles.php');
   require_once(__DIR__ . '/../database/user.php');
   function printMessagesBlock($chats) {
?>

   <section class="box">
      <div class="chats-box">
         <?php foreach($chats as $chat) { 
               $product = getArticleById($chat['productID']);
               $user = retrieveUser($chat['senderID']);
            ?>
            <div class="chat" sender-id="<?= $chat['senderID'] ?>" product-id="<?= $chat['productID'] ?>">
               <div class="chat-info">
                  <img src=<?= $user['avatar'] ?> alt=""/>
                  <h3><?= $chat['username']?></h3>
                  <h3 style="color: #344e41"><?= "(" . $product['name'] . ")" ?></h3>
               </div>
               <h4 class="chat-message" id=<?= $chat['productID'] . $chat['senderID'] ?>><?= $chat['lastAction']?></h4>
            </div>

         <?php } ?>
      </div>
      <div class="vertical-bar">
      </div>
      <div class="message-box" id="message-box">
         <h3>No messages here!</h3>
      </div>
   </section>

<?php 
   }
?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      let currentSenderID = null;
      let lastMessage = null;

      const chats = document.querySelectorAll(".chat");
      for (const chat of chats)
         chat.addEventListener('click', function() {
            currentSenderID = this.getAttribute('sender-id');
            lastMessage = document.getElementById(this.getAttribute('product-id') + this.getAttribute('sender-id'));
            console.log(this.getAttribute('sender-id'));
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
               document.getElementById("message-box").innerHTML = this.responseText;
            }
            xhttp.open("GET", "../actions/chat.php?q=" + currentSenderID);
            xhttp.send();
         })

      document.addEventListener('submit', function(e) {

         if(e.target.matches('.message-input')){
            e.preventDefault();

            const form = document.getElementById('message-form');
            const formData = new FormData(form);
            const inputForm = this.querySelector('.input-field');

            const messageText = (inputForm.value).replace(/[^a-zA-Z0-9\s]/g, '');

            formData.append('messageText', messageText.trim());
            formData.append('senderID', currentSenderID);

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
               const messagesDiv = document.querySelector('.messages');

               if(messageText.trim() != ''){
                  messagesDiv.innerHTML += `<div class="message-sent">
                                             <p>${messageText}</p>
                                             </div>`;
                  messagesDiv.scrollTop = messagesDiv.scrollHeight;
                  inputForm.value = '';
                  lastMessage.innerHTML = messageText;
               }
            }

            xhttp.open("POST", "../actions/message.php", true);
            xhttp.send(formData);
      }
   });
   })
</script>