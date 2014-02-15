<?php
/**
* Displays a form that allows users to upload multiple image files, each with a 
* maximum size of 20Mb.
*
* @author Mark Johnman
* @date 15/2/2014
*/
?>

<!DOCTYPE html>
<html>
   <head>
      <title> Upload an Image </title>
      <script src="js/upload_form_functions"></script>
   </head>
   <body>
      <h1> Upload an Image</h1>
      <form id="image_upload_form" enctype="multipart/form-data" action="upload_processing.php" method="post">
          <button type="button" onclick="addFile(this.value)" value="images">Add Image</button>
          <br>
          <br>
          <!--The ID of the div below needs to be the same as the value of the Add Image button in order for the JS to work properly. -->
          <div id="images">
            <div id="file1">
               Choose an image to upload (maximum file size is 20Mb): <input name="image1" type="file">
            </div>
          </div>
          <br>
          <input type="submit" value="Upload Image">
      </form>
   </body>
</html>
