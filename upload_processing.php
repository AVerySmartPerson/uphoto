<?php
/**
* Validates an image uploaded via a HTML form. If the image
* is valid, it is given a unique name and placed in the 
* images folder. If the image/upload isn't valid, an error
* message is displayed. 
*
* @author Mark Johnman
* @date 7/2/2014
*/

if (!isset($_FILES["image"])) {
  exit("You didn't upload an image between 0Mb and the maximum size");
}

// Add current time so that the image is guaranteed to have a unique name
$image_destination = "images/" . time() . "-" . basename($_FILES["image"]["name"]);
$error_messages = array(
   1 => "Your image is larger than the maximum size", 
   2 => "Your image is larger than the maximum size", 
   3 => "Your image was only partially uploaded", 
   4 => "You didn't upload an image"
);

if ($_FILES["image"]["error"] != 0) {
   exit($error_messages[$_FILES["image"]["error"]]);
} else if (!getimagesize($_FILES["image"]["tmp_name"])) {
   exit("Your upload failed because the file you attempted to upload is not an image");
} else if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_destination)) {
   exit("Your image has been successfully uploaded");
} else {
   exit("Your upload has failed");
}
