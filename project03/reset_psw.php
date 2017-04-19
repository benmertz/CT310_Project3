<?php
require_once "inc/page_setup.php";

$pgTitle = "Forgotten Password";

$db = new Database();
$users = $db->getUsers();

include ('inc/header.php');


if (isset($_GET['q'])) {
	if (strcmp($_GET['q'], $_SESSION['url']) != 0)
		header("Location: ./login.php");
}
else
	header("Location: ./login.php");


include ('inc/header.php');
include ('inc/nav.php');

function set_password($psw, $users) {
	foreach ($users as $u) {
		if (strcmp($u['username'], $_GET['a']) == 0){
			setNewPassword($psw, $_GET['a']);
		}
	}
}

function setNewPassword($psw, $name) {
	  global $db;
	  $hash_psw = password_hash($psw);
	  $sql = "UPDATE users SET password='" . $hash_psw . "' WHERE username='" . $name . "'";
	  return $db->exec($sql);
  }
?>

<div align = "center">
		<?php if ((isset($_POST['psw1']) && isset($_POST['psw2'])) && ($_POST['psw1'] == $_POST['psw2']) && (strcmp($_POST['psw1'], "") != 0)) :?>
			<h5><b>Password Set</b></h5>
			<?php set_password($_POST['psw1'], $users); ?>
		<?php else :?>
		<h5><b>Please enter a new password</b></h5>
		<form method="POST" style="background-color: #e6ffff; border:3px solid black; width:30%; margin-top: 25px; padding: 10px;">
			<p><b>New Password</b></p>
			<input type="password" placeholder="Enter Password" name="psw1"><br><br>
			
			<p><b>Confirm Password</b></p>
			<input type="password" placeholder="Enter Password" name="psw2"><br><br>
			<input type="submit" value="submit">
		</form>
		<?php endif; ?>
</div>

<!--  -->
<!-- End of contents -->
<?php include('inc/footer.php'); ?>
