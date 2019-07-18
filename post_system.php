
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
?>

<?php
if(isset($_POST["name"])){
    echo $_POST["name"]." is from ".$_POST["country"];
	exit();
}
?>

<?php
if (isset($_POST['action']) && $_POST['action'] == "status_post"){
	// Make sure post data is not empty
	if(strlen($_POST['data']) < 1){
		mysqli_close($conn);
	    echo "data_empty";
	    exit();
	}
	// Make sure type is either a or c
	if($_POST['type'] != "a" && $_POST['type'] != "c"){
		mysqli_close($conn);
	    echo "type_unknown";
	    exit();
	}
	// Clean all of the $_POST vars that will interact with the database
	$type = preg_replace('#[^a-z]#', '', $_POST['type']);
	$account_name = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$log_username= preg_replace('#[^a-z0-9]#i', '', $_POST['author']);
	$data = htmlentities($_POST['data']);
	$data = mysqli_real_escape_string($conn, $data);
	
	// Insert the status post into the database now
	$sql = "INSERT INTO status(account_name, author, type, data, postdate)
	VALUES('$account_name','$log_username','$type','$data',now())";
	if ($conn->query ( $sql ) === FALSE) {
		echo "Error: " . $sql . "<br>" . $conn->error;
	} else {
		

	$id = mysqli_insert_id($conn);
	mysqli_query($conn, "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1");
	
	$conn->close ();
	echo "1|$id";
	}
	exit();
}
	?>
	
	<?php 
//action=status_reply&osid="+osid+"&user="+user+"&data="+data
if (isset($_POST['action']) && $_POST['action'] == "status_reply"){
	// Make sure data is not empty
	if(strlen($_POST['data']) < 1){
		mysqli_close($conn);
	    echo "data_empty";
	    exit();
	}
	// Clean the posted variables
	$osid = preg_replace('#[^0-9]#', '', $_POST['sid']);
	$account_name = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$log_username= preg_replace('#[^a-z0-9]#i', '', $_POST['author']);
	
	$data = htmlentities($_POST['data']);
	$data = mysqli_real_escape_string($conn, $data);
	
	
	// Insert the status reply post into the database now
	$sql = "INSERT INTO status(osid, account_name, author, type, data, postdate)
	        VALUES('$osid','$account_name','$log_username','b','$data',now())";
	if ($conn->query ( $sql ) === FALSE) {
		echo "Error: " . $sql . "<br>" . $conn->error;
	} else {
		
		
		$id = mysqli_insert_id($conn);
		
		$conn->close ();
		echo "2|$id";
	}
	exit();
}
?>
<?php
if (isset($_POST['action']) && $_POST['action'] == "delete_status"){
	if(!isset($_POST['statusid']) || $_POST['statusid'] == ""){
		mysqli_close($conn);
		echo "status id is missing";
		exit();
	}
	$log_username= preg_replace('#[^a-z0-9]#i', '', $_POST['author']);
	$statusid = preg_replace('#[^0-9]#', '', $_POST['statusid']);
	// Check to make sure this logged in user actually owns that comment
	$query = mysqli_query($conn, "SELECT account_name, author FROM status WHERE id='$statusid' LIMIT 1");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$account_name = $row["account_name"];
		$author = $row["author"];
	}
	if ($author == $log_username || $account_name == $log_username) {
		mysqli_query($conn, "DELETE FROM status WHERE osid='$statusid'");
		mysqli_close($conn);
		echo "4";
		exit();
	}
}
?>
<?php 
if (isset($_POST['action']) && $_POST['action'] == "delete_reply"){
	if(!isset($_POST['replyid']) || $_POST['replyid'] == ""){
		mysqli_close($conn);
		exit();
	}
	$log_username= preg_replace('#[^a-z0-9]#i', '', $_POST['author']);
	$replyid = preg_replace('#[^0-9]#', '', $_POST['replyid']);
	// Check to make sure the person deleting this reply is either the account owner or the person who wrote it
	$query = mysqli_query($conn, "SELECT osid, account_name, author FROM status WHERE id='$replyid' LIMIT 1");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$osid = $row["osid"];
		$account_name = $row["account_name"];
		$author = $row["author"];
	}
    if ($author == $log_username || $account_name == $log_username) {
    	mysqli_query($conn, "DELETE FROM status WHERE id='$replyid'");
    	mysqli_close($conn);
	    echo "3";
		exit();
	}
}
?>
