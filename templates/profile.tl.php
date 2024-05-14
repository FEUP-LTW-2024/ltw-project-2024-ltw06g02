<?php
   require_once('forms.tl.php'); 
   require_once('database/addFollow.php');
   require_once('database/user.php');
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
                  <h3><?= $user['username'] ?></h3>
                  <hr class="separatorName">
                  <h4>Portugal</h4>
               </div>
               <div>
                  <h4>followed by <?= getUserFollowers($user['userID']);?></h4>
                  <h4>total likes : <?= getUserTotalLikes($user['userID']);?></h4>
               </div>
            </div>
         </section>
         <div class="profileButtons-container">
            <?php
            if($user['userID'] == $_SESSION['userID']){?>
               <button class="nav-button" id="editProfile">Edit Profile</button>
            <?php
            }
            else{
               if(!checkIfFollows($user['userID'], $_SESSION['userID'])){
               ?>   
               
               <form action="../actions/follow.php" method="post">
                  <input type="hidden" name="userId" value="<?=$user['userID']?>">
                  <input type="hidden" name="requesterId" value="<?=$_SESSION['userID']?>">
                  <button type="submit" name="follow" id="follow" class="<?php if(!isset($_SESSION['username'])) echo "disabled"?>">Follow</button>
               </form>
               <?php
               }
               else{
               ?>
               
               <form action="../actions/remove_follow.php" method="post">
                  <input type="hidden" name="userId" value="<?=$user['userID']?>">
                  <input type="hidden" name="requesterId" value="<?=$_SESSION['userID']?>">
                  <button type="submit" name="notFollow" id="notFollow" class="<?php if(!$user['userID']) echo "disabled"?>">Not follow</button>
               </form>
               <?php   
               }
            }   
            ?>
         </div>
      </div>
      <script>
         document.querySelectorAll('button.disabled').forEach((button) =>
            button.addEventListener('click', (e) => {
               e.preventDefault()
               loginDialog.showModal();
            }
         ))
      </script>
<?php 
   }
?>



<?php
   require_once('article.tl.php');
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

      editProfile.addEventListener("click", () => {
         editProfileDialog.showModal();
      })

      closeBtn.addEventListener("click", () => {
         editProfileDialog.close();
      });
   })

   document.querySelectorAll('button.disabled').foreach((button) =>
      button.addEventListener('click', (e) => {
         e.preventDefault()
         loginDialog.showModal();
      }
   ))
</script>
