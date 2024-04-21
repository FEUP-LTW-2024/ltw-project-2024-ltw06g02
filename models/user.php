<?php

   class User{
      public function __construct($username, $email, $password, $avatar){
         $this->username = $username;
         $this->email = $email;
         $this->password = password_hash('bazinga'.$password.'bazinga', PASSWORD_DEFAULT);
         $this->avatar = $avatar;
      }
      public $username;
      public $email;
      public $password;
      public $avatar;

      public function setUsername($username){
         $this->username = $username;
      }
      public function setEmail($email){
         $this->email = $email;
      }
      public function setAvatar($avatar){
         $this->avatar = $avatar;
      }
      public function setPassword($password){
         $this->password = password_hash('bazinga'.$password.'bazinga', PASSWORD_DEFAULT);
      }
      public function getUsername(){
         return $this->username;
      }
      public function getEmail(){
         return $this->email;
      }
      public function getPassword(){
         return $this->password;
      }
      public function getAvatar(){
         return $this->avatar;
      }
   }

?>