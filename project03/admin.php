<?php

require_once "inc/page_setup.php";

$pgTitle = "admin";
include ('inc/header.php');

// print_r($_SESSION['sessionUser']);

$db = new Database();

$user = new User();
$user = User::getUserByName($_SESSION['sessionUser']);
// echo 'User: ';
// print_r($user);
$userRole = $user['role'];
// echo('==================userRole: ');
// print_r($userRole);
?>

</head>

<?php include ('inc/nav.php');?>

<!-- Start contents of main page here. -->

<div class="container col-xs-12">
	<?php if($userRole == 1): ?>
	<div class="row">
		<div class="col-xs-3"></div>
		<div class="col-xs-6">
		<h2>You have administrator priveleges. You may: </h2>
		<ul>
			<h5><li><a href="./addIngredient.php">Add an Ingredient</a></li></h5>
			<h5><li><a href="./editComments.php">Modify Ingredient Comments</a></li></h5>
			<h5><li><a href="./createDB.php">Reset the site to the Default Database</a></li></h5>		
		</ul>
		</div>
		<div class="col-xs-3"></div>
	</div>
		
	<?php else: ?>
	<pre class="bg-danger">
		<h1>You Do Not Have Admin Access Permissions</h1>
	</pre>
	<?php endif;?>
</div>


<!-- End of contents -->

<?php include('inc/footer.php'); ?>
