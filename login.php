


<?php
session_start ();
?>

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
$emailGet= test_input($_POST['email2']);
$passGet=  test_input($_POST['pass2']);
$passGet_MD5=md5($passGet);
    	$sql = "SELECT email,password FROM reg WHERE email='$emailGet'&& password='$passGet_MD5'";
    	$result = $conn->query($sql);
    	
    	
    	if(mysqli_fetch_row($result)){
    		$_SESSION["email2"]=$emailGet;
    		$emailLogedin = $_SESSION ['email2'];
    		echo 1;
    		
    	}else{
    		echo 0;
    	}
    	
    	
    	
    

    $conn->close();

    function test_input($data) {
    	$data = trim ( $data );
    	$data = stripslashes ( $data );
    	$data = htmlspecialchars ( $data );
    	return $data;
    }
    
    
   
    
    
    
    
?>

