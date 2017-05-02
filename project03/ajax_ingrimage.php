<?php
require_once "inc/page_setup.php";
header ('Content-Type: text/json');
header ("Access-Control-Allow-Origin: *");
$db = new Database();
$ingredients = $db->getIngredients();
?>

<?php
if (isset($_GET["ing"])) {
	$ingredient = $_GET['ing'];
	foreach ($ingredients as $i) {
		if (strcmp($ingredient, $i["ingredient_name"]) == 0) {
			$path = './assets/img/' . $i["image_name"];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			echo base64_encode($data);
		}
	}
}
else {
	echo "No ingredient is specified";
}
?>
