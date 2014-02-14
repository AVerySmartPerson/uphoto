<?php
/**
* Serves a thumbnail (150 x 150 pixels) of the image with the 
* given ID, displaying appropriate error messages should the 
* operation fail. 
*
* @author Mark Johnman
* @date 7/2/2014
*/

$id = basename($_GET["id"]);

$thumbnail_width = 150;
$thumbnail_height = 150;
$thumbnail = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

if (!$id) {

   exit("You didn't specify an ID");
   
} else if (file_exists("images/$id.jpg")) {

   header("Content-Type: image/jpg");
   $image = imagecreatefromjpeg("images/$id.jpg");
   imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, imagesx($image), imagesy($image));
   imagejpeg($thumbnail);
   
} else if (file_exists("images/$id.jpeg")) {

   header("Content-Type: image/jpeg");
   $image = imagecreatefromjpeg("images/$id.jpeg");
   imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, imagesx($image), imagesy($image));
   imagejpeg($thumbnail);
   
} else if (file_exists("images/$id.gif")) {

   header("Content-Type: image/gif");
   $image = imagecreatefromgif("images/$id.gif");
   imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, imagesx($image), imagesy($image));
   imagegif($thumbnail);
   
} else if (file_exists("images/$id.png")) {

   header("Content-Type: image/png");
   $image = imagecreatefrompng("images/$id.png");
   imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, imagesx($image), imagesy($image));
   imagepng($thumbnail);
   
} else {

   exit("ID does not exist");
   
}


