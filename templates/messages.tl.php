<?php 
   function printMessagesBlock($chats) {
?>

   <section class="box">
      <div class="chats-box">
         <?php foreach($chats as $chat) { ?>
            <div class="chat" sender-id="<?= $chat['senderID'] ?>">
               <div class="chat-info">
                  <img src="../assets/goiana.jpg" alt=""/>
                  <h3><?= $chat['username']?></h3>
               </div>
               <h4 class="chat-message"><?= $chat['lastAction']?></h4>
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
      let lastMessage = document.querySelector('.chat-message');

      const chats = document.querySelectorAll(".chat");
      for (const chat of chats)
         chat.addEventListener('click', function() {
            currentSenderID = this.getAttribute('sender-id');
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

            const messageText = inputForm.value;

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