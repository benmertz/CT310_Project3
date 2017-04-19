<head>
<?php
require_once "inc/page_setup.php";
$pgTitle = "Forgotten Password";
$db = new Database();
$users = $db->getUsers();
	
if(isset($_POST['mailing'])){
  $toMail = $_POST['username'];
  // echo "$toMail";
  $key = str_shuffle("abcdefghijklmnopqrstuvwxyz123456");
  $msg = "follow this link to reset your password: https://www.cs.colostate.edu/~bpowley/previous_assignments/PA6/passwordreset.php?key=" . $key;
  $_SESSION['url'] = $key;
  $_SESSION['sendTo'] = $_POST['username'];
  if(mail($toMail, 'password recovery', $msg));
}
include ('inc/header.php');
?>
</head>
<?php
function check_user($users, $name) {
	$found = false;
	$email = null;
	foreach ($users as $u){
		if (strcmp($name, $u['username']) == 0){
			$found = true;
			$email = $u['email'];
			send_email($email, $name);
		}
	}
	if ($found)
		echo "<b>Email has been sent to: </b>" . $email . "<br>";
	else
		echo "<b>User not found</b><br>";
}
function send_email($destination, $user){
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
    $password = hash('sha512', $salt.$destination);
    $pwrurl = "www.cs.colostate.edu/~bpowley/CT310-P2/reset_psw.php?q=".$password."&a=".$user;
        
    $mailbody = "Dear user,\n\nIt appears that you have requested a password reset\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl;
	$_SESSION['url'] = $password;
    mail($destination, "Password Reset", $mailbody);
}
?>
<?php include ('inc/nav.php'); ?>

<!-- Start contents of main page here. -->

	<div class="header">
		<h2> Password Recovery </h2>
	</div>
	<div style="display: block; text-align: center">
		<p>Please enter your  username:</p>
		<form action="fmp.php" method="post">
			<?php if(isset($_POST['user']))
				check_user($users, $_POST['user']); ?>
			<input type="text" name="user"><br>
			<input type="submit" value="Send Email">
		</form>
	</div>



<!-- End of contents -->
<?php include('inc/footer.php'); ?>