<?php

class Comment {
  public $id; // unique int for primary key
  public $ing_id; // foreign key to the ingredient the comment is referencing
  public $comment_text; // the comment text
  public $user_id; // the User that the comment is tied to
  public $timestamp; // the time the comment was uploaded
  public $originating_ip; // the ip address from which the comment came from

  public function __construct($ID=0, $ingID=0, $com_text="",$uID=0,$time=0,$oIP=0){
    $this->id = $ID;
    $this->ing_id = $ingID;
    $this->comment_text= $com_text;
    $this->user_id = $uID;
    $this->timestamp = $time;
    $this->originating_ip = $oIP;
  }

  // add any necessary functions to support Comments

}

?>
