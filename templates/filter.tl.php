<?php
   function printFilterButton($filter){
?>

   <button class="filter-btn" onclick="updateArticles('<?=$filter['categoryID']?>')"><?= $filter['name'] ?></button>

<?php
   }
?>

<?php
   function printFiltersSection($filters){
?>

   <div class="product-section">
      <h3 class="products-title">Procura por filtros</h3>
      <section>
         <?php
            foreach($filters as $filter){
               printFilterButton($filter);
            }
         ?>
      </section>
   </div>

<?php
   }
?>

<script>
   function updateArticles(str){
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
         document.getElementById("grid").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../actions/filter.php?q="+ str);
      xhttp.send();
   }
</script>