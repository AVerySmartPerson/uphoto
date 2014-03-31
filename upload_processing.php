<?php
/**
* Validates one or multiple images uploaded via a HTML form. 
* If an image is valid, it is given a unique name, placed 
* in the images folder and a success message is displayed. 
* If an image/upload isn't valid, an error message is 
* displayed. At the conclusion of the process, a message
* listing the total number of images uploaded is displayed.
*
* The upload report is displayed in a modal window. When the
* window is closed, the user is redirected back to the index
* page.
*
* @author Mark Johnman
* @date 1/4/2014
*/

// Error messages corresponding with PHP file upload error codes.
$error_messages = array(
   1 => "Your image is larger than the maximum size", 
   2 => "Your image is larger than the maximum size", 
   3 => "Your image was only partially uploaded", 
   4 => "You didn't upload an image"
);

// Total number of images successfully uploaded.
$number_images_uploaded = 0;
?>

<!DOCTYPE html>
<html lang="en">
	<head>  
		<meta name="author" content="Mark Johnman">
		<meta name="application-name" content="Uphoto Imgur Clone">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title> Welcome to Uphoto </title>

		<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">  

		<style>
			body {
				background-color: black;
				text-align: center;
			}
			.pull-center {
				margin: 0 auto;
				display: block;
				text-align: center;
			}
			.modal.in {
   				display:block;
			}
		</style>    

		<script src="js/upload_form_functions"></script>
		<script src="/lib/jquery/jquery-1.10.2.min.js"></script>
		<script src="/lib/bootstrap/js/bootstrap.min.js"></script>      
	</head>
	<body>

	<!-- Modal -->
	<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<a href="index.php"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></a>
					<h4 class="modal-title" id="myModalLabel">Upload Report</h4>
				</div>
				<div class="modal-body">
					<?php
					foreach ($_FILES as $file) {
						// Add current time so that the image is guaranteed to have a unique name
						$image_destination = "images/" . time() . "-" . basename($file["name"]);

						/* 
						* Stops an error message being displayed for every blank file input element. This could be annoying
						* if the user created 10 file input elements and then only uploaded two images. If the user didn't 
						* upload any files at all, this will be reflected by the total number of images uploaded message at 
						* the end of the script.
						*/ 
						if ($file["error"] == 4) {
							continue;
						} else if ($file["error"] != 0) {
							echo $file["name"]. ": " . $error_messages[$file["error"]];
						} else if (!getimagesize($file["tmp_name"])) {
						  	echo $file["name"]. ": " . "Your upload failed because the file you attempted to upload is not an image";
						} else if (move_uploaded_file($file["tmp_name"], $image_destination)) {
						  	echo $file["name"]. ": " . "Your image has been successfully uploaded";
						  	$number_images_uploaded++;
						} else {
						  	echo $file["name"]. ": " . "Your upload has failed";
						}

						echo "<br><br>";
					}

					echo ($number_images_uploaded == 1) ? "1 image was uploaded." : "$number_images_uploaded images were uploaded.";
					?>
				</div>
				<div class="modal-footer">
					<a href="index.php"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></a>
				</div>
			</div>
		</div>
	</div>

	</body>
</html>
