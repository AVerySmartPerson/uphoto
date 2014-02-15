<?php
/**
* Displays a grid of randomly chosen thumbnails of the images stored
* by the web application. Each thumbnail is a link to a view of the 
* full-sized image. The grid of thumbnails is set up so that the same
* thumbnails are displayed for a certain period of time. This ensures
* continuity accross all web browsers and users of the web appplication.
*
* @author Mark Johnman
* @date 15/2/2014
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

for ($row = 1; $row <= $num_rows; $row++) {
   for ($column = 1; $column <= $num_columns; $column++) {
      $index = mt_rand(0, count($image_ids) - 1);
      $image_id = $image_ids[$index];

      // Removes the image ID just chosen from the list of image IDs so that the same image can't be displayed twice.
      array_splice($image_ids, $index, 1);

      echo "<a href='view.php?id=$image_id'><img src='thumbnail.php?id=$image_id'></a>";
      echo "&nbsp;";
   }
   echo "<br><br>";
}
