<?php
session_start ();
// if(isset($_SESSION['email'])) {
// echo "Your session is running " . $_SESSION['email'];
// }

?>
 <?php
 	$email="";
	if (isset ( $_SESSION ['email2'] )) {
		$email = $_SESSION ['email2'];
	}
	?>


<?php
if (isset($_POST["submit"])) {
	$j = 0;     // Variable for indexing uploaded image.
	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
		// Loop to get individual element from the array

		$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
		if (($_FILES["file"]["size"][$i] < 5000000)) {// Approx. 5mb files can be uploaded.
					
					$filetemp =$_FILES['file']['tmp_name'][$i];
					$filename =$_FILES['file']['name'][$i];
					$filetype =$_FILES['file']['type'][$i];
					$target_path = "uploadedImages/".$filename;  
					
					if (move_uploaded_file($filetemp, $target_path)) {
						// If file moved to uploads folder.
						if($con=mysqli_connect('localhost','root','','myDB'))
						{
							$query =mysqli_query($con, "call imageInsert('$email','$filename','$target_path','$filetype')");
						}
						echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';

					} else {     //  If File Was Not Moved.
						echo $j. ').<span id="error">please try again!.</span><br/><br/>';
					}
				} else {     //   If File Size And File Type Was Incorrect.
					echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
				}
	}
}
?>