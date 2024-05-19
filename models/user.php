<?php

   class User{
      public function __construct($fullName, $username, $email, $password, $avatar){
         $this->fullName = $fullName;
         $this->username = $username;
         $this->email = $email;
         $this->password = password_hash($password, PASSWORD_DEFAULT);
         $this->admin = false;
         $this->avatar = $avatar;
         $this->followers = 0;
         $this->preferences = null;
      }
      public $fullName;
      public $username;
      public $email;
      public $password;
      public $admin;
      public $avatar;
      public $preferences;
   }

?>