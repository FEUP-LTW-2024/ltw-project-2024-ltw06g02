<?php
   require_once('forms.tl.php');
   function printNavBar(){
      buildLoginForm();
      buildRegisterForm();
?>

<div class="navbar">
  <h1>Bazinga</h1>
      <?php if(isset($_SESSION['username'])){ ?>
         <a href="../wishlist.php" class="favorite-btn">
            <img src="../assets/coracao.png" alt="Coração">
         </a>
         
         <div class="dropdown">
            <button class="dropbtn"><?= $_SESSION['username'] ?></button>
            <div class="dropdown-content">
               <a href="../actions/logout.php">Logout</a>
            </div>
         </div>

      <?php 
         } else { ?>

         <a class="register" href="#" id="showLogin">
            Register / Login
         </a>

      <?php } ?>

</div>

<?php
   }
?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const loginDialog = document.getElementById("loginDialog");
      const registerDialog = document.getElementById("registerDialog");
      const showLoginBtn = document.getElementById("showLogin");
      const closeLoginBtn = loginDialog.querySelector(".close-button");
      const closeRegisterBtn = registerDialog.querySelector(".close-button");
      const registerLink = document.getElementById("registerLink");

      showLoginBtn.addEventListener("click", () => {
         loginDialog.showModal();
      });

      closeLoginBtn.addEventListener("click", () => {
         loginDialog.close();
      });

      closeRegisterBtn.addEventListener("click", () => {
         registerDialog.close();
      });

      registerLink.addEventListener("click", (event) => {
         event.preventDefault();
         loginDialog.close();
         registerDialog.showModal();
      });
   });
</script>
