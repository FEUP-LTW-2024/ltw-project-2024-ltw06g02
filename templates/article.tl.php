<?php
   function getSingleArticle($name, $price, $image){
?>

   <article class="article">
    <img src=<?= $image ?> alt="" class="product-img">
    <h3><?= $name ?></h3>
    <p><?= $price ?>€</p>
   </article>

<?php
   }
?>

<?php
   function printArticleSection($articles){
?>
   <div class="product-section">
      <h3 class="products-title">Produtos recomendados</h3>
      <section class="article-grid">
         <?php foreach($articles as $article){
            getSingleArticle($article['name'], $article['price'], $article['images']);
         } 
         ?>
      </section>
   </div>
<?php
   }
?>

