<?php

require_once "inc/page_setup.php";
require_once "assets/passwordLib.php";

$pgTitle = "Log In";
include ('inc/header.php');
?>

</head>

<?php include ('inc/nav.php'); ?>

<!-- Start contents of main page here. -->


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php
function validateCredentials($username, $pass) {
	$db = new Database();
	$users = $db->getUsers();
	
	foreach ($users as $user){
		if($user["username"] == $username){
			$actualPassword = $user["password"];	
			$verified = password_verify($pass, $actualPassword);
			if($verified){
				return true;		
			}else{
				return false; 		
			}
		}
	}
	return false;
}

if (isset ( $_POST ['logout'] )) {
	$_SESSION ['sessionUser'] = "Guest";
	$_SESSION ['startTime'] = date ( "l d, M. g:i a", time () );
}

if($_SESSION['sessionUser'] != 'Guest'){?>
	<pre class="bg-success">
		<p style="text-align: center">Logged in as <strong>  <?php  echo  $_SESSION["sessionUser"] ?></strong></p>
		<p style="text-align: center">Logged in at: <?php  echo $_SESSION['startTime'] ?></p>
	</pre>
			
	<div style="display: block; text-align: center">	
		<form method="post" action="login.php">
			 <input type="hidden" value="true" name="logout">
			 <input type="submit" value="Logout" >
		</form>
	</div><?php
}
else {
	if (isset($_POST['op'])) {
		$username  = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$password  = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		
		if (validateCredentials($username, $password)){
			$_SESSION["sessionUser"] = $username;
			$_SESSION['startTime'] = date ( "l d, M. g:i a", time () ); ?>

			<pre class="bg-success">
				<p style="text-align: center">Logged in as <strong>  <?php  echo  $_SESSION["sessionUser"] ?></strong></p>
				<p style="text-align: center">Logged in at: <?php  echo $_SESSION['startTime'] ?></p>
			</pre>
			
			<div style="display: block; text-align: center">	
				<form method="post" action="login.php">
					 <input type="hidden" value="true" name="logout">
					 <input type="submit" value="Logout" >
				</form>
			</div>
		<?php
		}
		else { ?>
			<div style="display: block; text-align: center">
				<pre class="bg-danger">
			   	<h2>Login Failed</h2>
			   </pre>
			   <p>Please re-enter your credentials below. </p>
			   <form method="post" action="login.php" >
				  Username:    <input type="text" name="username"    size="30"><br/>
				  Password&nbsp;: <input type="password" name="password" size="30"><br/>
				 <input type="hidden" value="done" name="op">
				 <input type="submit" value="Send" >
			   </form>
		   </div>
		   <?php
		}
	}
	else {
		?>
			<div style="display: block; text-align: center">
			   <h2>Please Log In</h2>
			   <p>Enter your credentials below. </p>
			   <form method="post" action="login.php" >
				  Username:    <input type="text" name="username"    size="30" ><br/>
				  Password&nbsp;: <input type="password" name="password" size="30" ><br/>
				 <input type="hidden" value="done" name="op">
				 <input type="submit" value="Send">
			   </form>
		   </div>
		   
		   <div style="display: block; text-align: center">
		   	<br>
				<p>Forgot Your Password? <a href="fmp.php">Click Here</a></p>
		   </div>
		<?php
	}
}
?>
	
</div>



<!-- End of contents -->
<?php include('inc/footer.php'); ?>
