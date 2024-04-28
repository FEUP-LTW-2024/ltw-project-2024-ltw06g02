<?php
   require_once('forms.tl.php');
   function printNavBar(){
      buildLoginForm();
      buildRegisterForm();
?>

<div class="navbar">
  <a style="text-decoration:none" href="../index.php"><h1>Bazinga</h1></a>
      <?php if(isset($_SESSION['username'])){ ?>
         <a href="../wishlist.php" class="favorite-btn">
            <img src="../assets/coracao.png" alt="Coração">
         </a>
         <div class="nav-buttons">
            <a class="nav-button" href="../sell.php">
               sell
            </a>
            <div class="dropdown">
               <button class="nav-button"><?= $_SESSION['username'] ?></button>
               <div class="dropdown-content">
                  <a href="../profile.php">Profile</a>
                  <a href="../messages.php">Messages</a>
                  <a href="../actions/logout.php">Logout</a>
               </div>
            </div>
         </div>

      <?php 
         } else { ?>

         <div class="nav-buttons">
            <a class="nav-button" href="#" id="showLogin">
               Login
            </a>

            <a class="nav-button" href="#" id="showRegister">
               Register
            </a>
         </div>

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
      const showRegisterBtn = document.getElementById("showRegister");
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

      showRegisterBtn.addEventListener("click", (event) => {
         registerDialog.showModal();
      });

      registerLink.addEventListener("click", (event) => {
         event.preventDefault();
         loginDialog.close();
         registerDialog.showModal();
      });

   });
</script>
