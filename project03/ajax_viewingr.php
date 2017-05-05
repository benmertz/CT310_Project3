<?php
require_once "inc/page_setup.php";
$db = new Database();
$pgTitle = "Home";
include ('inc/header.php');
include ('inc/nav.php');
?>


</head>


<?php
$ing="";
$link="";
	if (isset ( $_GET ['ing'] )) {
		$ing = $_GET['ing'];
	}else{
			$ing ="no ingr";
	}
	
	if (isset ( $_GET ['link'] )) {
		$link = $_GET['link'];
	}else{
		$link ="no link";
		}
?>

<!-- Start contents of main page here. -->

<div class="container">
	<div class="row">
		<div class="col-xs-12">
				<p><?php echo $ing ?></p>
				<p><?php echo $link ?></p>


		</div>
	</div>
</div>

<!-- End of contents -->
<?php include('inc/footer.php'); ?>
