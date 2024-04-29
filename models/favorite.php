<?php

   class Favorite{

      public function __construct($userId, $articleId){
         $this->userId = $userId;
         $this->articleId = $articleId;
      }
      public $userId;
      public $articleId;
   }

?>