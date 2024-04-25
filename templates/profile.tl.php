<?php
   require_once('forms.tl.php'); 
   function printBioSection($user){
      buildEditProfile();
?>
   <div class="info">
      <div class="conjunction">
         <section class="left-side">
            <img src="../assets/goiana.jpg" >
            <div class="bios">
               <div>
                  <h1><?= $user['fullName'] ?></h1>
<<<<<<< HEAD
                  <h3><?= $user['username'] ?></h3>
                  <hr class="separatorName">
                  <h4>Portugal</h4>
=======
<<<<<<< HEAD
                  <h3><?= $user['username'] ?></h2>
                  <h4>biografia</h3>
=======
                  <h3><?= $user['username'] ?></h3>
                  <hr class="separatorName">
                  <h4>Portugal</h4>
>>>>>>> f9db73c (Fixing CSS)
>>>>>>> badb1dc (Fixing CSS)
               </div>
               <div>
                  <h4>followed by</h4>
                  <h4>liked by</h4>
               </div>
            </div>
         </section>
         <button class="nav-button" id="editProfile">Edit Profile</button>
      </div>

<?php 
   }

   function printProfileArticleSection($articles) {
?>
      <div class="right-side">
         <section class="article-grid">
            <?php
               if (empty($articles)) {
                  ?>
                  <h5>Sell a product!</h5>
                  <?php
               } else {
                  foreach ($articles as $article) {
                     getSingleProfileArticle($article['name'], $article['price'], $article['images'], $article['avatar']);
                  }
               }
            ?>
         </section>
      </div>
   </div>
   
<?php
   }
   function getSingleProfileArticle($name, $price, $image, $avatar){
      $images = explode(",", $image);
?>

   <article class="profile-article">
      <a href="#"><img src=<?= $images[0] ?> alt="" class="product-img"></a>
      <div class="article-details">
         <div>
            <h3><?= $name ?></h3>
            <p><?= $price ?>€</p>
         </div>
         <img src=<?= $avatar ?>>
      </div>
   </article>

<?php
   }
?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const editProfileDialog = document.getElementById("editProfileDialog");
      const editProfile = document.getElementById("editProfile");
      const closeBtn = editProfileDialog.querySelector(".close-button");

      editProfile.addEventListener("click", () => {
         editProfileDialog.showModal();
      })

      closeBtn.addEventListener("click", () => {
         editProfileDialog.close();
      });
   })
</script>
