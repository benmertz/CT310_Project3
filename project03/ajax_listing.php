<?php
require_once "inc/page_setup.php";
header ('Content-Type: text/json');
header ("Access-Control-Allow-Origin: *");
$db = new Database();
$ingredients = $db->getIngredients();
?>

<?php
$listing = array();
foreach ($ingredients as $i) {
	$name = $i["ingredient_name"];
	$short = $i["ingredient_name"] . " is a super delicious and fresh ingredient";
	$unit = "lbs";
	$cost = "1.49";
	$array = array(
		"name" => $name,
		"short" => $short,
		"unit" => $unit,
		"cost" => $cost,
	);
	array_push($listing, $array);
}
echo json_encode($listing);
?>
