<?php
require_once "inc/page_setup.php";
header ('Content-Type: text/json');
header ("Access-Control-Allow-Origin: *");
$db = new Database();
$ingredients = $db->getIngredients();
?>

<?php
if (isset($_GET['ing'])) {
	$ingredient = $_GET['ing'];
	foreach ($ingredients as $i) {
		if (strcmp($ingredient, $i["ingredient_name"]) == 0) {
			$name = $i["ingredient_name"];
			$short = $i["ingredient_name"] . " is a super delicious and fresh ingredient";
			$unit = "lbs";
			$cost = "1.49";
			$time = "Ships today";
			$desc = $i["description"];
			$array = array(
				"name" => $name,
				"short" => $short,
				"unit" => $unit,
				"cost" => $cost,
				"time" => $time,
				"desc" => $desc,
			);
			echo json_encode($array);
		}
	}
}
else {
	echo "No ingredient specified";
}
?>
