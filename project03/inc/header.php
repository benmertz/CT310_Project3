<?php

	if(!isset($config)){ 
		require_once dirname(__FILE__) . "/../lib/config.php";
	} 

date_default_timezone_set ( 'America/Denver' );

	if(!isset($_SESSION['sessionUser'])){
		$_SESSION['sessionUser'] = 'Guest';
	}
	if(!isset($_SESSION['startTime'])){
		$_SESSION ['startTime'] = date ( "l d, M. g:i a", time () );
	}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo "IFY  |  " . $pgTitle; ?></title>

	<meta name="author" content=" Brendon Powley" >
	<meta name="description" content="CT310 P1: Team 15">
	<meta name="keywords" content="Dylan,Crescibene,Brendon,Powley,CSU,CT310,Colostate">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href='//fonts.googleapis.com/css?family=Alegreya+Sans+SC' rel='stylesheet'>

	<script type="text/javascript"> 

		function stopRKey(evt) { 
		  var evt = (evt) ? evt : ((event) ? event : null); 
		  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
		  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
		} 

		document.onkeypress = stopRKey; 

	</script>