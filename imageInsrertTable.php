<?php
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


if (!$conn->query("DROP PROCEDURE IF EXISTS imageInsert") ||
		!$conn->query("CREATE PROCEDURE imageInsert(IN getEmail varchar(100),IN getName varchar(100),IN getPath varchar(200),IN getType varchar(100) ) BEGIN INSERT INTO images(email,name,path,type) VALUES(getEmail,getName,getPath,getType); END;")) {
			echo "Error in procedure: (" . $conn->errno . ") " . $conn->error;
		}
		$conn->close();
?>