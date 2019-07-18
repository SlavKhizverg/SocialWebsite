<?php

$firstName = $lastName = $email = $pass = $gender = "";
$firstName = test_input ( $_POST ["firstName1"] );
$lastName = test_input ( $_POST ["lastName1"] );
$email = test_input ( $_POST ["email1"] );
$pass = test_input ( $_POST ["pass1"] );
$gender = test_input ( $_POST ["gender1"] );
$avatar="pics/avatardefault.JPG";

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

$email = filter_var ( $email, FILTER_SANITIZE_EMAIL ); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
	echo "Invalid Email.......";
} else {
	
	// if the email is registered->give an alert error,otherwise put all the details into the table
	$sql = "SELECT email FROM reg WHERE email='$email'";
	$result = $conn->query ( $sql );
	
	if (mysqli_fetch_row ( $result )) {
		// echo '<script language="javascript">';
		// echo 'alert("This email already registered")';
		// echo '</script>';
		echo "This email already registered";
	} else {
		$pass = md5 ( $pass );
		$sql = "INSERT INTO reg (firstname,lastname,email,password,gender,avatar)
		VALUES ('$firstName','$lastName','$email','$pass','$gender','$avatar')";
		
		if ($conn->query ( $sql ) === FALSE) {
			echo "Error: " . $sql . "<br>" . $conn->error;
		} else {
			echo "Login to your account to get started";
		}
		$conn->close ();
	}
}
function test_input($data) {
	$data = trim ( $data );
	$data = stripslashes ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}

?>