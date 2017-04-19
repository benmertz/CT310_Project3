<?php

require_once "inc/page_setup.php";

$pgTitle = "shoppingCart";
include ('inc/header.php');
$db = new Database();
?>

</head>

<?php include ('inc/nav.php');?>
<?php
function sendEmail($db) {
	$items = $_SESSION['shoppingCart'];
	$_SESSION['shoppingCart'] = array();
	$contents = "";
	foreach($items as $a)
		$contents .= $a . ", ";
	
	if (strcmp($contents, "") == 0)
		return;
	
	$sql = "SELECT * FROM users WHERE role='1'";
	$admins = $db->prepare($sql);
	$admins->execute();
	
	$msgBody = "An order has been placed for the following items: " . $contents;
	/*foreach ($admins as $a)
		mail($a['email'], "Shopping Cart", $msgBody);*/
		
	$sql = "SELECT email FROM users WHERE username='" . $_SESSION['sessionUser'] . "'";
	$email = $db->prepare($sql);
	$email->execute();
	$email = $email->fetch();
	$sendTo = $email['email'];
	
	mail($sendTo, "Shopping Cart", $msgBody);
	
	header ("Location: ./shoppingCart.php");
}
?>
<!-- Start contents of main page here. -->
<?php if (strcmp($_SESSION ['sessionUser'], "Guest") != 0) :?>
	<div class="container col-xs-12">
		<div align="center">
			<?php
				if (!isset($_SESSION['shoppingCart'])) {
					$_SESSION['shoppingCart'] = array();
				}
				
				if(isset($_GET['i'])){
					if (array_search($_GET['i'], $_SESSION['shoppingCart']) == FALSE) {
						array_push($_SESSION['shoppingCart'], $_GET['i']);
					}
				}
			
				echo "<h3>Shopping Cart:</h3>";
				$count = 1;
				foreach($_SESSION['shoppingCart'] as $t) {
					if (isset($_POST[$t])){
						$index = array_search($t, $_SESSION['shoppingCart']);
						$cart = $_SESSION['shoppingCart'];
						unset($cart[$index]);
						$_SESSION['shoppingCart'] = array_values($cart);
						header ("Location: ./shoppingCart.php");
					}
					echo "<form action='./shoppingCart.php' method='POST'>
						$count: <strong>$t</strong>
						<input type='submit' name=$t value='Remove'>
					</form><br>";
					$count = $count + 1;
				}
			?>
			<?php
				if(isset($_POST['submit']))
					sendEmail($db);
			?>
			<form action="./shoppingCart.php" method="POST">
				<input type="submit" name="submit" value="Checkout">
			</form>
		</div>
	</div>
<?php else: ?>
	<div align="center">
		<h4>Must be logged in to view cart</h4>
	</div>
<?php endif; ?>
<!-- End of contents -->

<?php include('inc/footer.php'); ?>