<?php
require_once "inc/page_setup.php";
$pgTitle = "viewIngredient";
include ('inc/header.php');
if(isset($_GET["i"])){
	$displayIngredient = $_GET["i"];
	// echo 'display ingredient [' . $displayIngredient . ']';
}
$db = new Database();
$ingredient = $db->getIngredientDetails($displayIngredient);
?>

</head>

<?php include ('inc/nav.php');?>

<!-- Start contents of main page here. -->

<div class="col-lg-2 col-md-2 hidden-sm hidden-xs" ></div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<h2><?php echo $ingredient->name;?></h2>
	<p>
		<?php echo $ingredient->description;?>
	</p>
	<?php include('inc/comments.php'); ?>
</div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<img  src="assets/img/<?php echo $ingredient->image_name?>" class="img-circle img-responsive" alt="Picture of <?php echo $ingredient->name?>" />
	<!--<p class="photoCred">Photo by krosseel at <a href="https://morguefile.com/">Morguefile.com</a></p>-->
</div>

<div class="col-lg-2 col-md-2 hidden-sm hidden-xs" ></div>

<!-- End of contents -->

<?php include('inc/footer.php'); ?>