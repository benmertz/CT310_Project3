<?php
// Status: open/closed (must be lowercase)
$status = "closed";

if (strcmp($status, "open") == 0) {
	$data = array ('status' => 'open');
	// will encode to JSON object: {"status":"open"} 
}
else if (strcmp($status, "closed") == 0) {
	$data = array ('status' => 'closed');
	// will encode to JSON object: {"status":"closed"} 
}
header('Content-type: application/json');
echo json_encode($data);
?>