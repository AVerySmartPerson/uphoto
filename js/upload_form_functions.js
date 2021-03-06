/**
* Contains functions that can be used to enable multiple file uploads 
* from the one file upload form. Assumes that there is already one file
* input element in the HTML form with an ID attribute of file1.
*
* @author Mark Johnman
* @date 1/4/2014
*/

/* 
* Counts the number of files that have been displayed on the screen (i.e. 
* if the user adds a file, then removes it, the count will not be affected).
*/
var fileCount = 1;

/**
* Adds a file input element to the end of the given HTML container element.
* @param file_group_id the ID of the HTML element in which the file input elements are contained.
*/
function addFile(file_group_id) {
   var newFileID = "file" + ++fileCount;
   var newFileHTML = "<div id='" + newFileID + "' class='row'><div class='col-md-5 col-md-offset-1'><input name='" + newFileID + "' type='file'></div><div class='col-md-6'><button type='button' onclick='removeFile(this.value)' class='btn btn-sm btn-default' value='" + newFileID + "'>Remove Image</button><br><br></div></div>";
   document.getElementById(file_group_id).innerHTML += newFileHTML;
}

/**
* Removes the given file input element from the web page.
* @param file_id the ID of the file input element to be removed.
*/
function removeFile(file_id) {
   document.getElementById(file_id).remove();
}
