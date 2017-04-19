<?php
require_once "inc/page_setup.php";
$pgTitle = "editComments";
include ('inc/header.php');
$db = new Database();
$comments = $db->getComments();
$ingredients  = $db->getIngredients();
include ('inc/nav.php'); ?>
</head>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Choose an Ingredient to edit its comments</h1>
		</div>
	</div>
	<div class ="row">
		<div class="col-xs-3"></div>
		<div class="col-xs-6" align="center">

			<!-- DISPLAY TABLE-->
			<?php if (isset($_POST['ing'])){
					$comments = showComments($db, $_POST['ing'], $comments);?>
			<table class="table table-condensed table-striped clear-all">
				<thead>
				<tr>
					<th></th>
					<th>Ingredient</th>
					<th>ID</th>
					<th>Comment</th>
					<th>User</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach ($comments as $comment){ ?>
						<tr>
							<td><a class="btn-default-btn"
								href="update_form.php?id=<?php echo $comment['id']?>"
								><span class="glyphicon glyphicon-pencil" aria-label="Edit"></span></td>
							<td><?php echo $comment['ingredient_name']?></td>
							<td><?php echo $comment['id']?></td>
							<td><?php echo $comment['comment_text']?></td>
							<td><?php echo $comment['username']?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<?php } else {?>
			<!-- END DISPLAY TABLE-->

			<!-- SELECTION FORM-->
			<form action = "#" method = "POST">
				<select name = "ing">
				<?php
					foreach ($ingredients as $ing)
						echo "<option value=\"" . $ing['ingredient_name'] . "\">" . $ing['ingredient_name'] . "</option>";
				?>
				</select>
				<input type="submit" value="Select">
			</form>
			<!-- END SELECTION FORM-->
			<?php };?>
		</div>
		<div class="col-xs-3"></div>
	</div>
</div>

<?php
function showComments($db, $ingredient, $comments) {
	$sql = "SELECT id FROM ingredients WHERE ingredient_name='" . $ingredient . "'";
	$id = $db->prepare($sql);
	$id->execute();
	$id = $id->fetch();
	$newID = $id['id'];
	/*$sql = "SELECT * FROM comments WHERE ing_id='$newID'";
	$comment_col = $db->prepare($sql);
	$comment_col->execute();*/
	$sql2 = "SELECT c.id, comment_text, username, timestamp, ingredient_name
						FROM comments AS c JOIN users AS u
						ON c.user_id = u.id
						JOIN ingredients AS i
						ON c.ing_id = i.id
						WHERE i.id='$newID'";
	$comment_col2 = $db->prepare($sql2);
	$comment_col2->execute();
	//print_r($comment_col2->fetch());
	return $comment_col2;
	/*foreach ($comment_col as $c)
		echo $c['comment_text'] . "<br>";*/
}
?>

<?php include('inc/footer.php'); ?>