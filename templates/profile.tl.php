<?php
   function printBioSection($user){
?>
   <div class="info">
      <div class="conjunction">
         <section class="left-side">
            <img src="../assets/goiana.jpg" >
            <div class="bios">
               <div>
                  <h2><?= $user['username'] ?></h2>
                  <h3>biografia</h3>
               </div>
               <div>
                  <h4>followed by</h4>
                  <h4>liked by</h4>
               </div>
            </div>
         </section>
         <div>
            <button class="nav-button">Edit Profile</button>
         </div>
      </div>

<?php 
   }

   function printProfileArticleSection($articles) {
?>

      <section class="right-side">
         <div class="article-profile-grid">
               <?php
                  foreach ($articles as $article) {
                     getSingleProfileArticle($article['name'], $article['price'], $article['images'], $article['avatar']);
                  }
               ?>
         </div>
      </section>
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