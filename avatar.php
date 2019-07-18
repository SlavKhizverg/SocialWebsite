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
$avatar="./uploadedImages/".$_POST ["avatar"];


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
$sql = "UPDATE reg SET avatar='$avatar' WHERE email='$email'";

if ($conn->query ( $sql ) === FALSE) {
	echo "Error: " . $sql . "<br>" . $conn->error;
} else {
	echo "Login to your account to get started";
}
$conn->close ();


?>