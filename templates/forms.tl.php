<?php
   function buildRegisterForm() {
?>

   <dialog id="registerDialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>CRIA UMA CONTA COM O E-MAIL</p>
      <form id="registerForm" action="../actions/register.php" method="POST">
         <input type="text" name="fullName" placeholder="Full Name" required>
         <input type="text" name="username" placeholder="Username" required>
         <input type="email" name="email" placeholder="Email" required>
         <input type="password" name="password" placeholder="Password" required>
         <button idtype="submit" id="registerBtn">Continuar</button>
      </form>
   </dialog>

<?php 
   }
   function buildLoginForm() {
?>
    <dialog id="loginDialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>JUNTA-TE A NÓS E VENDE ROUPA EM SEGUNDA MÃO SEM PAGAR TAXAS!</p>
      <form id="loginForm" action="../actions/login.php" method="POST">
         <input type="text" name="username" placeholder="Username" required>
         <input type="password" name="password" placeholder="Password" required>
         <button type="submit" id="loginBtn">Login</button>
      </form>
      <p>Não tens uma conta? <a href="#" id="registerLink">Cria uma</a>.</p>
   </dialog>

<?php
   }

   function buildEditProfile() {
?>

<dialog id="editProfileDialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>Edit Profile</p>
      <form id="editProfileForm" action="../actions/edit.php" method="POST">
         <input type="text" name="username" id="" placeholder="New Username">
         <input type="password" name="password" id="" placeholder="New Password">
         <input type="email" name="email" id="" placeholder="New Email">
         <button type="submit" id="loginBtn">Edit</button>
      </form>
   </dialog>      

<?php } ?>