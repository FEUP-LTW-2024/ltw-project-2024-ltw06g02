<?php
   require_once(__DIR__ . '/forms.tl.php');
   require_once(__DIR__ . '/../database/user.php');
   function printNavBar(){
      buildLoginForm();
      buildRegisterForm();
?>

<div class="navbar">
  <a style="text-decoration:none" href="../index.php"><h1 class="playfair-display-font">bazinga.</h1></a>
  <form action="../actions/search.php" method="POST" class="search-form">
    <input type="text" name="query" style="outline:none;" placeholder="search a user...">
    <button type="submit">Search</button>
  </form>
  <div class="nav-buttons">
   <div class="dropdown">
         <button class="nav-button" style="margin-right: 1em;"><?php echo(isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ? 'dol' : 'eur') ?></button>
         <div class="dropdown-content">
            <?php 
               $currency = isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ? 'eur' : 'dol';
            ?>
            <a href=<?= "../actions/change_currency.php?q=" . $currency?> ><?=$currency?></a>
         </div>
   </div>
      <?php if(isset($_SESSION['username'])){ ?>
            <div class="not-dropdown-icons">
            <?php
            if(checkIfUserIsAdmin($_SESSION['username'])){
            ?>   
               <a href="../pages/admin.php" class="nav-icon">
               <i class="material-icons">settings</i>
               </a>
            <?php
            }
            ?>
            <a href="../pages/shopping_cart.php" class="nav-icon">
               <i class="material-icons">shopping_cart</i>
            </a>
            <a href="../pages/wishlist.php" class="nav-icon">
              <i class="material-icons">favorite</i>
            </a>
            <a class="nav-button" href="../pages/sell.php">
               sell
            </a>
            </div>
            <div class="dropdown">
               <button class="nav-button"><?= $_SESSION['username'] ?></button>
               <div class="dropdown-content">
                  <?php if(checkIfUserIsAdmin($_SESSION['username'])){ ?><a class="responsive" href="../pages/admin.php">Admin</a> <?php } ?>
                  <a class="responsive" href="../pages/shopping_cart.php">Cart</a>
                  <a class="responsive" href="../pages/wishlist.php">Wishlist</a>
                  <a href="../pages/profile.php">Profile</a>
                  <a href="../pages/messages.php">Messages</a>
                  <a href="../pages/historic.php">Historic</a>
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

      if(showLoginBtn){
         showLoginBtn.addEventListener("click", () => {
            loginDialog.showModal();
         });
      }

      if(closeLoginBtn){
         closeLoginBtn.addEventListener("click", () => {
            loginDialog.close();
         });
      }

      if(closeRegisterBtn){
         closeRegisterBtn.addEventListener("click", () => {
            registerDialog.close();
         });
      }

      if(showRegisterBtn){
         showRegisterBtn.addEventListener("click", (event) => {
            registerDialog.showModal();
         });
      }

      if(registerLink){
         registerLink.addEventListener("click", (event) => {
            event.preventDefault();
            loginDialog.close();
            registerDialog.showModal();
         });
      }
   });
</script>
