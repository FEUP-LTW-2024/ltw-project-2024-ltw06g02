<?php 
   function printMessagesBlock($chats) {
?>

   <section class="box">
      <div class="chats-box">
         <?php foreach($chats as $chat) { ?>

            <div class="chat" chat-id="<?= $chat['chatID'] ?>">
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
         
      </div>
   </section>

<?php 
   }
?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const chats = document.querySelectorAll(".chat");
      for (const chat of chats)
         chat.addEventListener('click', function() {
            const chatID = this.getAttribute('chat-id');
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
               document.getElementById("message-box").innerHTML = this.responseText;
            }
            console.log(chatID);
            xhttp.open("GET", "../actions/chat.php?q=" + chatID);
            xhttp.send();
         }) 
   })
</script>