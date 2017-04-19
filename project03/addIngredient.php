<?php

require_once "inc/page_setup.php";

$pgTitle = "addIngredient";
include ('inc/header.php');

$db = new Database();

$filename = "";
if ($_FILES && isset ( $_FILES ["image"] )) {
	if ($_FILES ["image"] ["error"] == UPLOAD_ERR_OK) {
		if ($_FILES ["image"] ["size"] > 1000000) {
			$error_msg = "File is too large.";
		} else {
			// find out what type of file the image is
			$ext = parseFileSuffix ( $_FILES ['image'] ['type'] );
			if ($ext == '') {
				// if there is no file type, display an error message
				$error_msg = "Unknown file type";
			} else {
				// print_r($_FILES ["image"]);
				$filename = $_FILES ["image"]["name"];
				if (! file_exists ( $config->upload_dir )) {
					if (! mkdir ( $config->upload_dir )) {
						$error_msg = "Attempt to make folder: \"" . $config->upload_dir . "\" failed";
					}
				}
				move_uploaded_file ( $_FILES ["image"] ["tmp_name"], $config->upload_dir . $filename );

				$chmodImg = $config->upload_dir . $filename;
				chmod($chmodImg, 0755);
			}
		}
	} else if ($_FILES ["image"] ["error"] == UPLOAD_ERR_INI_SIZE || $_FILES ["image"] ["error"] == UPLOAD_ERR_FORM_SIZE) {
		$error_msg = "File is too large.";
	} else {
		$error_msg = "An error occured. Please try again. <!-- " . $_FILES ["image"] ["error"] . " -->";
	}
}

if(isset($_POST["ingredient_name"])){
	if(isset($_POST["description"])){
		$newName = $_POST["ingredient_name"];
		$newDsc  = $_POST["description"];
		$db->addIngredient($newName,$filename,$newDsc);
	}				
}

?>

</head>

<?php include ('inc/nav.php');?>

<!-- Start contents of main page here. -->

<div class="container col-xs-12">
				<form class="form-horizontal" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="ingredient_name">Ingredient Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="ingredient_name" id="ingredient_name"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="description">Description</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="description" id="description"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for="image">Upload an Image</label>
						<div class="col-sm-6">
							<input type="hidden" name ="MAX_FILE_SIZE" value="1000000"/>
							<input type="file" class="form-control" name="image" id="image"/>
						</div>
					</div>					
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Save</button>
						</div>
					</div>
				</form>
</div>

<!-- End of contents -->
<?php
/* Support functions for handling image upload above. */
function parseFileSuffix($iType) {
	if ($iType == 'image/jpeg') {
		return 'jpg';
	}
	if ($iType == 'image/gif') {
		return 'gif';
	}
	if ($iType == 'image/png') {
		return 'png';
	}
	if ($iType == 'image/tif') {
		return 'tif';
	}
	return '';
	
	/*<div class="form-group">
						<label class="col-sm-2 control-label" for="image_name">Image Name</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="image_name" id="image_name"/>
						</div>
					</div>*/
}

?>
<?php include('inc/footer.php'); ?>