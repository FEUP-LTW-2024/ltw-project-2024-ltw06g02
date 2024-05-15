<?php
   function buildRegisterForm() {
?>

   <dialog id="registerDialog" class="dialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>CRIA UMA CONTA COM O E-MAIL</p>
      <form class="form" action="../actions/register.php" method="POST">
         <input type="text" name="fullName" placeholder="Full Name" required>
         <input type="text" name="username" placeholder="Username" required>
         <input type="email" name="email" placeholder="Email" required>
         <input type="password" name="password" placeholder="Password" required>
         <button idtype="submit" class="form-button">Continuar</button>
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
      <form class="form" action="../actions/login.php" method="POST">
         <input type="text" name="username" placeholder="Username" required>
         <input type="password" name="password" placeholder="Password" required>
         <button type="submit" class="form-button">Login</button>
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
   <form class="form" action="../actions/edit.php" method="POST">
      <input type="text" name="username" placeholder="New Username">
      <input type="password" name="password" placeholder="New Password">
      <input type="email" name="email" placeholder="New Email">
      <button type="submit" class="form-button">Edit</button>
   </form>
</dialog>      

<?php 
   } 

   function buildUploadPhoto() {
?>

<dialog id="uploadPhotoDialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>Upload new photo</p>
   <form action="../actions/upload_avatar.php" method="post" enctype="multipart/form-data">
      <input type="file" name="image" required>
      <button type="submit" class="form-button">Upload</button>
   </form>
</dialog>  

<?php
   }

   function buildEditArticle($id) {
?>

<dialog id="editArticleDialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>Edit Product</p>
   <form class="form" action=<?= "../actions/edit_article.php?q=" . $id ?> method="POST">
      <input type="text" name="price" placeholder="New price">
      <input type="text" name="name" placeholder="New name">
      <button type="submit" class="form-button">Edit</button>
   </form>
</dialog> 

<?php } ?>