<?php
/**
* Serves the image with the given ID, displaying appropriate 
* error messages should the operation fail. The script's time 
* limit is manually set to ensure that it doesn't time out while 
* it's serving a particularly large image. 
*
* The time limit has been set locally as this is one of the
* only scripts in the web application that may require extra
* execution time. Rather than adjust the maximum execution 
* time globally and allow any PHP script on the website to 
* execute for a long period of time, it has been decided to
* restrict this settings change to the scripts that may 
* require it. This decision also ensures that PHP will have 
* these settings whilst the script is running, as opposed 
* to assuming that the global configuration is correct.
*
* @author Mark Johnman
* @date 7/2/2014
*/

// Script will run for 120 seconds before timing out.
set_time_limit(120);

$id = basename($_GET["id"]);
$image_extensions = array("jpg", "jpeg", "gif", "png");

if (!$id) {
   exit("You didn't specify an ID");
}

foreach ($image_extensions as $image_extension) {
   if (file_exists("images/$id.$image_extension")) {
      header("Content-Type: image/$image_extension");
      readfile("images/$id.$image_extension");
      exit;
   }
}

exit("ID does not exist");

