<?php
   function printFilterButton($filter){
?>

   <button class="filter-btn" onclick="updateArticles('<?=$filter['categoryID']?>', 'category')"><?= $filter['name'] ?></button>

<?php
   }

   function printConditionButton($condition) {
?>

   <button class="condition-btn" style="display: none;" onclick="updateArticles('<?=$condition['conditionID']?>', 'condition')"><?= $condition['name'] ?></button>

<?php } ?>

<?php
   function printFiltersSection($filters, $conditions){
?>

   <div class="filter-choose filter-section">
      <button onclick="showFilters('filter-btn', this)" class="choose active">category</button>
      <button onclick="showFilters('price', this)" class="choose">price</button>
      <button onclick="showFilters('condition-btn', this)" class="choose">condition</button>
   </div>

   <div class="product-section filter-section">
      <?php
         foreach($filters as $filter){
            printFilterButton($filter);
         }
      ?>
      <?php
         foreach($conditions as $condition){
            printConditionButton($condition);
         }
      ?>
      
      
      <input class='price' style="display: none" type="range" min="0" max="500" onchange="updateArticles(this.value, 'price'); document.getElementById('priceValue').innerHTML = '<?= (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol') ? '$' : '€' ?>' + this.value">
      <span id="priceValueMin" class="price-label-min price" style="display: none; font-size: 1em;"><?= isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ? '$' : '€' ?>0 -</span>
      <span id="priceValue" class="price-label price" style="display: none; font-size: 1em;"><?= isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ? '$' : '€' ?>250</span>
   </div>

<?php
   }
?>

<script>
   function updateArticles(str, filter){
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
         document.getElementById("grid").innerHTML = this.responseText;
      }
      xhttp.open("GET", "../actions/filter.php?q="+ str + "&filter=" + filter);
      xhttp.send();
   }

   function showFilters(filterType, clickedButton) {
      const filters = document.querySelectorAll('.filter-btn, .price, .condition-btn');
      const chooseButtons = document.querySelectorAll('.choose');

      filters.forEach(filter => {
         filter.style.display = "none";
      });

      const selectedFilter = document.querySelectorAll('.' + filterType);

      selectedFilter.forEach(filter => filter.style.display = 'flex');

      chooseButtons.forEach(button => {
         button.classList.remove('active');
      });

      clickedButton.classList.add('active');
   }
</script>