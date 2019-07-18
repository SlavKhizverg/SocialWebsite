<?php
session_start ();
// if(isset($_SESSION['email'])) {
// echo "Your session is running " . $_SESSION['email'];
// }

?>
 <?php
	$email = "";
	if (isset ( $_SESSION ['email2'] )) {
		$email = $_SESSION ['email2'];
	}
	?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli ( $servername, $username, $password, $dbname );
// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}
$sql = "SELECT path,name FROM images WHERE email='$email'";
$result = mysqli_query ( $conn, $sql );

while ( $row = mysqli_fetch_assoc ( $result ) ) {
	
	$folder_path = "uploadedImages/";
	$folder = opendir ( $folder_path );

			$file_path = $row["path"];
			$file=$row["name"];
			$extension = strtolower ( pathinfo ( $file, PATHINFO_EXTENSION ) );
			if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'bmp') {
?>
<a href="<?php echo $file_path; ?>"><img src="<?php echo $file_path; ?>"
	height="250" /></a>
<?php
			}

	
	closedir ( $folder );
}
$conn->close ();

?>