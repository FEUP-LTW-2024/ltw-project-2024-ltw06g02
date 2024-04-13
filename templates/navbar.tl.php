<?php
   function printNavBar(){
?>

<div class="navbar">
  <h1>Bazinga</h1>
      <?php if(isset($_SESSION['username'])){ ?>

         <div class="dropdown">
            <button class="dropbtn"><?= $_SESSION['username'] ?></button>
            <div class="dropdown-content">
               <a href="../actions/logout.php">Logout</a>
            </div>
         </div>

      <?php 
         } else { ?>

         <a class="register" href="../login.mock.php">
            Register / Login
         </a>

      <?php } ?>

</div>

<?php
   }
?>