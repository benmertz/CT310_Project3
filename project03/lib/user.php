<?php
require_once "assets/passwordLib.php";

class User {
  public $id; // an id unique to each User
  public $username; // the username of the User
  public $password; // the blowfish-hashed password
  public $role; // 0 if User is a guest, 1 if User is an admin


  public function __construct($id = 0, $user = "", $pass = "", $role = 0){
    $this->id = $id;
    $this->username = $user;
    $this->password = password_hash($pass);
    $this->role = $role;
  }

  // add any necessary functions to support User
  public function getUserByName($name){
	 global $db;
  	 $sql = "SELECT * FROM users WHERE username = '$name'";
  	 return $db->query($sql)->fetch();
  }
  
  public function getUserRole(){
  
  }
}

?>
