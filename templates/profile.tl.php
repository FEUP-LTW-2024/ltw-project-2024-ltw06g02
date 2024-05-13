<?php
   require_once('forms.tl.php'); 
   function printBioSection($user){
      buildEditProfile();
      buildUploadPhoto();
?>
   <div class="info">
      <div class="conjunction">
         <section class="left-side">
            <img src=<?= isset($user['avatar']) ? $user['avatar'] : "../assets/user.jpg"?> >
            <div class="bios">
               <div>
                  <h1><?= $user['fullName'] ?></h1>
                  <h3><?= $user['username'] ?></h3>
                  <hr class="separatorName">
                  <h4>Portugal</h4>
               </div>
               <div>
                  <h4>followed by</h4>
                  <h4>liked by</h4>
               </div>
            </div>
         </section>
         <div class="buttons">
            <button class="nav-button" id="editProfile">Edit Profile</button>
            <button class="nav-button" id="editPhoto">Change Photo</button>
         </div>
      </div>

<?php 
   }
   require_once('article.tl.php');
   function printProfileArticleSection($articles) {
?>
      <div class="right-side">
         <section class="article-grid">
            <?php
               if (empty($articles)) {
                  ?>
                  <h5 style="margin: auto auto; font-weight: normal;">Não tens nenhum artigo à venda!</h5>
                  <?php
               } else {
                  foreach ($articles as $article) {
                     getSingleProfileArticle($article['productID'] ,$article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
                  }
               }
            ?>
         </section>
      </div>
   </div>
   
<?php
   }
   function getSingleProfileArticle($productID ,$name, $price, $image, $avatar, $likes){
      $images = explode(",", $image);
?>

   <article class="profile-article">
      <a href="product.php?id=<?=$productID?>"><img src=<?= $images[0] ?> alt="" class="product-img"></a>
      <div class="article-details">
         <div>
            <h3><?= $name ?></h3>
            <p><?= $price ?>€</p>
         </div>
         <div class="like-container">
            <i class="material-icons heart-icon">favorite</i>
            <p class="number"><?= $likes ?></p>
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

      const uploadPhoto = document.getElementById("editPhoto");
      const photoUploadDialog = document.getElementById("uploadPhotoDialog");

      editProfile.addEventListener("click", () => {
         editProfileDialog.showModal();
      })

      closeBtn.addEventListener("click", () => {
         editProfileDialog.close();
         photoUploadDialog.close();
      });

      uploadPhoto.addEventListener("click", () => {
         photoUploadDialog.showModal();
      })
   })
</script>
