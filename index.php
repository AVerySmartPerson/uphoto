<?php
/**
* Displays a grid of randomly chosen thumbnails of the images stored
* by the web application. Each thumbnail is a link to a view of the 
* full-sized image. The grid of thumbnails is set up so that the same
* thumbnails are displayed for a certain period of time. This ensures
* continuity accross all web browsers and users of the web appplication.
*
* Also displays a form that allows users to upload multiple image files, 
* each with a maximum size of 100Mb, and a blurb about Uphoto.
*
* @author Mark Johnman
* @date 1/4/2014
*/

// Number of minutes that the same randomly chosen thumbnails should be displayed.
$num_mins_to_display = 5;

// Number of rows and columns in the grid of thumbnails.
$num_rows = 4;
$num_columns = 5;

// List of image IDs that can be used to select and display thumbnails.
$image_ids = array();

foreach (glob("images/*.{png,jpeg,jpg,gif}", GLOB_BRACE) as $filename) {
	/*
	* Ensures that images uploaded within the current display block aren't included in the list
	* of potential thumbnails (if the list changed, different thumbnails would be displayed).
	*/
	if (time() - filemtime($filename) > (60 * $num_mins_to_display)) {
		array_push($image_ids, preg_replace("/images\/(.*)\.(png|jpeg|jpg|gif)/", "$1", $filename));
	}
}

// Seeds the random number generator so that the same thumbnails are chosen for the specified time period.
$seed = time() / (60 * $num_mins_to_display);
mt_srand($seed);

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
		</style>    

		<script src="js/upload_form_functions"></script>
		<script src="/lib/jquery/jquery-1.10.2.min.js"></script>
		<script src="/lib/bootstrap/js/bootstrap.min.js"></script>      
	</head>
	<body>
		<br>
		<div class="row">
			<div class="col-md-8">
				<?php
				for ($row = 1; $row <= $num_rows; $row++) {
					echo "<div class='col-xs-3'>";
					for ($column = 1; $column <= $num_columns; $column++) {
						$index = mt_rand(0, count($image_ids) - 1);
						$image_id = $image_ids[$index];

						// Removes the image ID just chosen from the list of image IDs so that the same image can't be displayed twice.
						array_splice($image_ids, $index, 1);

						echo "<a href='view.php?id=$image_id' class='thumbnail'><img src='thumbnail.php?id=$image_id'></a>";
						echo "&nbsp;";
					}
					echo "</div>";
				}
				?>
			</div>

			<div class="col-md-4">
				<div class="well well-lg">
					<h1>Upload Images</h1>
					<form id="image_upload_form" enctype="multipart/form-data" action="upload_processing.php" method="post" role="form">
						<!--The ID of the div below needs to be the same as the value of the Add Image button in 
							order for the JS to work properly. -->	
						<br>								
						<button type="button" onclick="addFile(this.value)" value="images" class="btn btn-default">Add Image</button>
						<br>
						<br>
						<br>
						<div id="images">
							<div id="file1">
								<input type="file" name="file1" class="pull-center">
								<br>
							</div>
						</div>
						<br>
						<input type="submit" value="Upload Image/s" class="btn btn-lg btn-primary">
					</form>
				</div>
				<div class="well well-lg">
					<h1>About Uphoto</h1>
					<br>
					<p>
						Uphoto is a site where you can upload images and view them. Above is a form that allows users to upload multiple image files, each with a maximum size of 100Mb.
						<br><br>
						On the left is a grid of randomly chosen thumbnails of some of the images stored by the web application. Each thumbnail is a link to a view of the full-sized image. The grid of thumbnails is set up so that the same thumbnails are displayed for a certain period of time.
					</p>
				</div>
			</div>
		</div>
	</body>
</html>



