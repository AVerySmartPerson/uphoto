<?php
/**
* Displays a form that allows users to upload an image file with a maximum size of 20Mb.
*
* @author Mark Johnman
* @date 7/2/2014
*/
?>

<!DOCTYPE html>
<html>
   <head>
      <title> Upload an Image </title>
   </head>
   <body>
      <h1> Upload an Image</h1>
      <form enctype="multipart/form-data" action="upload_processing.php" method="post">
          Choose an image to upload (maximum file size is 20Mb): <input name="image" type="file">
          <input type="submit" value="Upload Image">
      </form>
   </body>
</html>
