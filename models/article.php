<?php

   class Article{

      public function __construct($name, $description, $price, $category, $user, $images){
         $this->name = $name;
         $this->description = $description;
         $this->price = $price;
         $this->category = $category;
         $this->user = $user;
         $this->images = $images;
      }
      public $name;
      public $description;
      public $price;
      public $category;
      public $user;
      public $images;
   }

?>