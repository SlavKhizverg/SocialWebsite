

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./css/uploadImage.css">
<title>Upload Multiple Images</title>
<!-------Including jQuery from Google ------>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/uploadScript.js"></script>
<!------- Including CSS File ------>
<body>
<input type="button" id="goHome" class="upload" value="Return to Home Page">

<div id="maindiv">
<div id="formdiv">
<h2>Multiple Image Upload</h2>
<form enctype="multipart/form-data" action="" method="post">
<div id="filediv">
<input name="file[]" type="file" id="file">
</div>
<input type="button" id="add_more" class="upload" value="Add More Files">
<input type="submit" value="Upload File" name="submit" id="upload" class="upload">
</form>
<!------- Including PHP Script here ------>
<?php include "upload.php"; ?>
</div>
</div>
</body>
</html>