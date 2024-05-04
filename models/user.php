<?php

   class User{

      public function __construct($username, $email, $password){
         $this->username = $username;
         $this->email = $email;
         $this->password = password_hash('bazinga'.$password.'bazinga', PASSWORD_DEFAULT);
         $this->admin = false;
      }
      public $username;
      public $email;
      public $password;
      public $admin;
   }

?>