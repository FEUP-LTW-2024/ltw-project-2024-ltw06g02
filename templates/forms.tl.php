<?php
   function buildRegisterForm() {
?>

   <dialog id="registerDialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>CRIA UMA CONTA COM O E-MAIL</p>
      <form id="registerForm" action="../actions/register.php" method="POST">
         <input type="text" id="username" name="username" placeholder="Username" required><br>
         <input type="email" id="email" name="email" placeholder="Email" required><br>
         <input type="password" id="password" name="password" placeholder="Password" required><br>
         <button idtype="submit" id="registerBtn">Continuar</button>
      </form>
   </dialog>

<?php 
   }
?>

<?php
   function buildLoginForm() {
?>
    <dialog id="loginDialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>JUNTA-TE A NÓS E VENDE ROUPA EM SEGUNDA MÃO SEM PAGAR TAXAS!</p>
      <form id="loginForm" action="../actions/login.php" method="POST">
         <input type="text" id="username" name="username" id="username" placeholder="Username" required><br>
         <input type="password" id="password" name="password" placeholder="Password" required><br>
         <button type="submit" id="loginBtn">Login</button>
      </form>
      <p>Não tens uma conta? <a href="#" id="registerLink">Cria uma</a>.</p>
   </dialog>

<?php
   }
?>