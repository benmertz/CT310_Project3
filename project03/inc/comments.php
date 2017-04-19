<head>
<?php
require_once "inc/page_setup.php";
$db = new Database();
$users = $db->getUsers();
$comments = $db->getComments();
$ingredients = $db->getIngredients();
?>
</head>
	<?php
	function addCommentToDB($cmt, $ingredients, $db) {
		$ingID = getIngredientID($_GET['i'], $ingredients);
		$username = $_SESSION['sessionUser'];
		$userID = $db->getUserID($username);
		$new_userID = $userID['id'];
		// echo 'new_userID: [' . $new_userID . ']';
		$timeStamp = date ( "l d, M. g:i a", time () );
		$ip = $_SERVER['REMOTE_ADDR'];
		$add = true;
		$comments = $db->getComments();
		if (strcmp($cmt, "") == 0)
			$add = false;
		if ($add) {
			global $db;
			$sql = "INSERT INTO comments (ing_id, comment_text, user_id, timestamp, originating_ip) VALUES ('$ingID', '$cmt', '$new_userID', '$timeStamp', '$ip')";
			$db->exec($sql);
		}
	}
	function getIngredientID($ingredient, $ingredients) {
		foreach ($ingredients as $i) {
			if (strcmp($ingredient, $i['ingredient_name']) == 0)
				return $i['id'];
		}
	}
	function showComments($db, $ingredients) {
		$sql = "SELECT id FROM ingredients WHERE ingredient_name='" . $_GET['i'] . "'";
		$id = $db->prepare($sql);
		$id->execute();
		$id = $id->fetch();
		$newID = $id['id'];
		$sql2 = "SELECT comment_text, username, timestamp
							FROM comments AS c JOIN users AS u
							ON c.user_id = u.id
							WHERE ing_id = '$newID'";
		$comment_col2 = $db->prepare($sql2);
		$comment_col2->execute();
		// print_r($comment_col2->fetch());
		foreach ($comment_col2 as $c) {
			echo "\"" . $c['comment_text'] . "\" - <strong>" . $c['username'] . "</strong><br><br>";
		}
	}
	?>
	<div class="comment-box rounded">

		<div class="title-box">
			<h4>Comments</h4>
		</div>

		<div class="comment-section">
			<p id="comments">
				<!-- this is where comments will display -->
				<?php
					if (isset($_POST['cmt']))
					{
						addCommentToDB($_POST['cmt'], $ingredients, $db);
						showComments($db, $ingredients);
					}
					else
						showComments($db, $ingredients);
				?>
			</p>
		</div>
		<?php if($_SESSION["sessionUser"] != 'Guest'){ ?>
		<form action="#" method="POST">
			<div align="center">
				<input type="text" name="cmt"><br>
				<input type="submit" value="Add Comment">
			</div>
		</form><br>
		<form align="center" action="./shoppingCart?i=<?php echo $_GET["i"]; ?>" method="POST">
			<input type="submit" name="addCart" value="Add To Cart">
		</form>
	</div>
<?php }else { ?>
	<br/>
	<p style="text-align: center"> <small>[You must log in to leave a comment] </small></p>
	</div>
<?php } ?>
