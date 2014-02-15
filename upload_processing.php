<?php
/**
* Validates one or multiple images uploaded via a HTML form. 
* If an image is valid, it is given a unique name, placed 
* in the images folder and a success message is displayed. 
* If an image/upload isn't valid, an error message is 
* displayed. At the conclusion of the process, a message
* listing the total number of images uploaded is displayed.
*
* @author Mark Johnman
* @date 15/2/2014
*/

$error_messages = array(
   1 => "Your image is larger than the maximum size", 
   2 => "Your image is larger than the maximum size", 
   3 => "Your image was only partially uploaded", 
   4 => "You didn't upload an image"
);

$number_images_uploaded = 0;

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

   echo "<br>";
}

echo ($number_images_uploaded == 1) ? "1 image was uploaded" : "$number_images_uploaded images were uploaded";
