<?php
//session_start();
if (isset($_SESSION['email2'])) {
	$userLogedIn = $_SESSION["email2"];
}
else {
	$userLogedIn= "";
}
?>
	<?php
if(isset($_GET['e'])){
	$email=$_GET['e'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT email FROM reg WHERE email='$email'";
	$result = $conn->query($sql);
	
	
	if(mysqli_fetch_row($result)){
		$email=$_GET['e'];
	}else{
		echo"can't find email";
	}
	$conn->close();
}else{
	$email=$userLogedIn;
}

?>