<?php
// require_once("<some_object(s).php>")
require_once("ingredient.php");
require_once("user.php");
require_once("comment.php");
class Database extends PDO {
  public function __construct() {
		parent::__construct ( "sqlite:" . __DIR__ . "/../ingredients.db" );
	}
	public function getNoOfIngredients(){
		$ing_num = $this->query("SELECT count(*) FROM ingredients");
		$num = $ing_num->fetchColumn();
		return $num;
	}
	public function getImage($name){
		$sql = "SELECT image_name FROM ingredients WHERE ingredient_name = '$name'";
		return $this->query($sql)->fetch();
	}
  	public function getIngredients() {
  		$sql = "SELECT * FROM ingredients";
  		return $this->query($sql);
  	}
    public function getIngredientDetails($name){
      $sql = "SELECT id, ingredient_name, image_name, description  FROM ingredients WHERE ingredient_name = '$name'";
      $result = $this->query ( $sql );
		  if ($result === FALSE) {
        // Only doing this for class. Would never do this in real life
        echo $sql;
        echo '<pre class="bg-danger">';
        print_r ( $this->errorInfo () );
        echo '</pre>';
        return NULL;
      }
      return Ingredient::getIngredientFromRow($result->fetch());
    }
  	public function getUsers(){
  		$sql = "SELECT * FROM users";
  		return $this->query($sql);
  	}
	  public function getComments(){
  		$sql = "SELECT * FROM comments";
  		return $this->query($sql);
    }
    public function getCommentDetails($id){
      //echo "getCommentDetails($id): ";
      $sql = "SELECT * FROM comments WHERE id='$id'";
      $result = $this->query($sql);
      if($result === FALSE){
        echo $sql;
        echo '<pre class="bg-danger">';
        print_r ( $this->errorInfo () );
        echo '</pre>';
        return NULL;
      }
      return $result->fetch();
    }
    public function getUserID($username){
      $sql = "SELECT id FROM users WHERE username = '$username'";
      $result = $this->query($sql);
      if($result === FALSE){
        echo $sql;
        echo '<pre class="bg-danger">';
        print_r ( $this->errorInfo () );
        echo '</pre>';
        return NULL;
      }
      return $result->fetch();
    }
    public function updateComment($comment){
      $sql = "UPDATE comments SET ing_id = :ing_id, comment_text = :comment_text,
                user_id = :user_id, timestamp = :timestamp, originating_ip = :originating_ip
                WHERE id = :id";
      $stm = $this->prepare($sql);
      return $stm->execute(array(
        ":ing_id" => $comment->ing_id,
        ":comment_text" => $comment->comment_text,
        ":user_id" => $comment->user_id,
        ":timestamp" => $comment->timestamp,
        ":originating_ip" => $comment->originating_ip,
        ":id" => $comment->id
      ));
    }
  	public function addIngredient($name, $img, $dsc){
  		$lastID = $this->getNoOfIngredients();
 		$newID = $lastID + 1;
		$sql = "INSERT INTO ingredients (id, ingredient_name, image_name, description) VALUES ('$newID','$name','$img','$dsc')";
		if(!$this->exec($sql)){
			echo '<pre class="bg-danger">';
			print_r($this->errorInfo());
			echo '</pre>';
		}
  	}
}
// create necessary database functions
 ?>
