
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
if (isset($_POST['action']) && $_POST['action'] == "status_post"){
	echo "ssss";
}
	?>