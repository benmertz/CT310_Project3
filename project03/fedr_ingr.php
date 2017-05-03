<?php
require_once "inc/page_setup.php";
$db = new Database();
$pgTitle = "Home";
include ('inc/header.php');
include ('inc/nav.php');
?>
<script type="text/javascript" src="fedr_ingr.js"></script>

</head>



<!-- Start contents of main page here. -->

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<p  class="" id="placeholder"><strong>Status: <span id="outp2">LOADING</span></strong></p>


			<table class="table table-hover table-responsive" id="fedr_ingr_table">
				<tr>
					<th>Name</th>
					<th>Unit</th>
					<th>Price</th>
					<th>Short</th>
					<th>Host Website</th>

				</tr>


			</table>

		</div>
	</div>
</div>

<!-- End of contents -->
<?php include('inc/footer.php'); ?>
