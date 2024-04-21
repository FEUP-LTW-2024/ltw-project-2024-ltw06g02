<?php
   require_once("article.tl.php");
   function printInfoSection($user){
?>
   <div class="info">
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
         <button>Edit Profile</button>
      </section>
<?php 
   }

   function printProfileArticleSection($articles) {
?>


      <section class="right-side">
         <div class="article-profile-grid">
               <?php
                  foreach ($articles as $article) {
                     getSingleArticle($article['name'], $article['price'], $article['images'], $article['avatar']);
                  }
               ?>
         </div>
      </section>
   </div>

<?php
   }
?>