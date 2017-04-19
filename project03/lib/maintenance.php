<?php 

require_once "config.php";
if(isset($config->maintenance) && $config->maintenance){
	include __DIR__ .'/../inc/header.php';
	?>
	<main>
		<div class="container">
			<p>We're sorry, the site is currently down for maintenance. Please try again later.</p>		
		</div>
	</main>
	<?php 
	include __DIR__ . '/../inc/footer.php';
	exit();
}