
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

<!DOCTYPE html>

<html>
<head>
<title></title>
<link href="css/homePageStyle.css" rel="stylesheet">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="./js/myJS.js"></script>
<script src="./js/main.js"></script>
</head>
<body>
	<ul class="nav">
		<li id="settings"><a href="#"><img src="./pics/TheSocialNetwor.png"></a>

		</li>
		<li id="search">
			<form action="" method="get">
				<input type="text" name="search_text" id="search_text"
					placeholder="Search" /> <input type="button" name="search_button"
					id="search_button">
				<div id="test"></div>
			</form>
		</li>
		<li><a href="#">Home</a></li>
		<li style="float: right"><a href="index.php">Log out</a></li>


	</ul>

	<script src="prefixfree-1.0.7.js" type="text/javascript"></script>
	<div class="rightCOntainer">
<?php
include_once ("userLogedin.php");
$firstName = $lastName = $name = "";

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

$sql = "SELECT * FROM reg WHERE email='$userLogedIn'";
$result = $conn->query ( $sql );
$row = mysqli_fetch_array ( $result );
$firstName = $row ["firstName"];
$lastName = $row ["lastName"];
$log_username = $firstName;
$log_username .= ' ';
$log_username .= $lastName;

$sql = "SELECT * FROM reg WHERE email='$email'";
$result = $conn->query ( $sql );
$row = mysqli_fetch_array ( $result );
$firstName = $row ["firstName"];
$lastName = $row ["lastName"];
$author_name = $firstName;
$author_name .= ' ';
$author_name .= $lastName;
echo $log_username;
echo $author_name;

?>
<script src="./js/ajax.js"></script>
<?php

$isOwner = "";

if ($userLogedIn != "") {
	$isOwner = "yes";
}
$status_ui = "";
$statuslist = "";
if ($isOwner == "yes") {
	$status_uit = '<textarea id="statustext"  placeholder="What&#39;s new with you ' . $log_username . '?"></textarea>';
	$status_uib = '<button id="statusBtn" onclick="postToStatus(\'status_post\',\'a\',\'' . $log_username . '\',\'statustext\',\'' . $author_name . '\')">Post</button>';
} else {
	$status_uit = '<textarea id="statustext" " placeholder="Hi ' . $log_username . ', say something to ' . $author_name . '"></textarea>';
	$status_uib = '<button id="statusBtn" onclick="postToStatus(\'status_post\',\'c\',\'' . $log_username . '\',\'statustext\',\'' . $author_name . '\')">Post</button>';
}

?>
<?php
$temp_log_username=$log_username;
$temp_log_username= str_replace(' ', '', $temp_log_username);
$temp_author_name=$author_name;
$temp_author_name= str_replace(' ', '', $temp_author_name);
$sql = "SELECT * FROM status WHERE account_name='$temp_log_username' AND type='a' OR account_name='$temp_author_name' AND type='c' ORDER BY postdate DESC LIMIT 20";

$query= $conn->query ( $sql );

$statusnumrows = mysqli_num_rows ( $query );

?>
	<h1><?php echo $statusnumrows?></h1>
	<?php 
	
while ( $row = mysqli_fetch_array ( $query, MYSQLI_ASSOC ) ) {
	
	
	$statusid = $row ["id"];
	$account_name = $row ["account_name"];
	$author = $row ["author"];
	$postdate = $row ["postdate"];
	$data = $row ["data"];
	$data = nl2br ( $data );
	$data = str_replace ( "&amp;", "&", $data );
	$data = stripslashes ( $data );
	$statusDeleteButton = '';
	
	if ($author == $temp_author_name|| $account_name == $temp_author_name) {
	
		$statusDeleteButton = '<span id="sdb_' . $statusid . '"><a href="#" onclick="return false;" onmousedown="deleteStatus(\'' . $statusid . '\',\'' . $author_name. '\',\'status_' . $statusid . '\');" title="DELETE THIS STATUS AND ITS REPLIES">delete status</a></span> &nbsp; &nbsp;';
	}
	// GATHER UP ANY STATUS REPLIES
	$status_replies = "";
	$query_replies = mysqli_query ( $conn, "SELECT * FROM status WHERE osid='$statusid' AND type='b' ORDER BY postdate ASC" );
	$replynumrows = mysqli_num_rows ( $query_replies );
	if ($replynumrows > 0) {
		while ( $row2 = mysqli_fetch_array ( $query_replies, MYSQLI_ASSOC ) ) {
			$statusreplyid = $row2 ["id"];
			$replyauthor = $row2 ["author"];
			$replydata = $row2 ["data"];
			$replydata = nl2br ( $replydata );
			$replypostdate = $row2 ["postdate"];
			$replydata = str_replace ( "&amp;", "&", $replydata );
			$replydata = stripslashes ( $replydata );
			$replyDeleteButton = '';
			if ($replyauthor == $temp_log_username|| $account_name == $temp_log_username) {
				$replyDeleteButton = '<span id="srdb_'.$statusreplyid.'"><a href="#" onclick="return false;" onmousedown="deleteReply(\''.$statusreplyid.'\',\'' . $author_name. '\',\'reply_'.$statusreplyid.'\');" title="DELETE THIS COMMENT">remove</a></span>';
			}
			$status_replies .= '<div id="reply_' . $statusreplyid . '" class="reply_boxes"><div><b>Reply by <a href="home.php?u=' . $replyauthor . '">' . $replyauthor . '</a> ' . $replypostdate . ':</b> ' . $replyDeleteButton . '<br />' . $replydata . '</div></div>';
		}
	}
	$statuslist .= '<div id="status_' . $statusid . '" class="status_boxes"><div><b>Posted by <a href="home.php?u=' . $author . '">' . $author . '</a> ' . $postdate . ':</b> ' . $statusDeleteButton . ' <br />' . $data . '</div>' . $status_replies . '</div>';
	if ($isFriend == true || $log_username == $log_username) {
		$statuslist .= '<textarea id="replytext_' . $statusid . '" class="replytext" onkeyup="statusMax(this,250)" placeholder="write a comment here"></textarea><button id="replyBtn_' . $statusid . '" onclick="replyToStatus(' . $statusid . ',\'' . $log_username. '\',\'' . $author_name. '\',\'replytext_' . $statusid . '\',this)">Reply</button>';
	}
}
?>

		<script>


function postToStatus(action,type,user,ta,author){
	alert("inside the status func");
	var data = _(ta).value;
	
	if(data == ""){
		alert("Type something first weenis");
		return false;
	}
	_("statusBtn").disabled = true;
	var ajax = ajaxObj("POST", "post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			
			
			var datArray = ajax.responseText.split("|");
			 alert(datArray[0]);
				if(datArray[0] == 1){
					
						var sid = datArray[1];
						alert(data);
						var currentHTML = _("statusarea").innerHTML;
						_("statusarea").innerHTML='<h1>post Success</h1>'+currentHTML;
						_(ta).value = "";
						_("statusBtn").disabled = false;
				}
			
			
		}
	}
	ajax.send("action="+action+"&type="+type+"&user="+user+"&data="+data+"&author="+author);
}
function replyToStatus(sid,user,author,ta,btn){
	alert("inside the replay func");
	var data = _(ta).value;
	if(data == ""){
		alert("Type something first weenis");
		return false;
	}
	_("replyBtn_"+sid).disabled = true;
	var ajax = ajaxObj("POST", "post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			var datArray = ajax.responseText.split("|");
			if(datArray[0] == 2){
				var rid = datArray[1];
				_("status_"+sid).innerHTML='<h1>replay Success</h1>';
				_(ta).value = "";
				_("replyBtn_"+sid).disabled = false;
			} else {
				alert(ajax.responseText);
			}
		}
	}
	ajax.send("action=status_reply&sid="+sid+"&user="+user+"&author="+author+"&data="+data);
}
function deleteStatus(statusid,author,statusbox){
	alert("inside the remove func");
	var ajax = ajaxObj("POST", "post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == 4){
				_(statusbox).style.display = 'none';
				_("replytext_"+statusid).style.display = 'none';
				_("replyBtn_"+statusid).style.display = 'none';
			} else {
				alert(ajax.responseText);
			}
		}
	}
	ajax.send("action=delete_status&statusid="+statusid+"&author="+author);
}

function deleteReply(replyid,author,replybox){
	
	var ajax = ajaxObj("POST", "post_system.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
			if(ajax.responseText == 3){
				_(replybox).style.display = 'none';
			} else {
				alert(ajax.responseText);
			}
		}
	}
	ajax.send("action=delete_reply&replyid="+replyid+"&author="+author);
}

</script>


		<div id="statusui">
  <?php
		
echo $status_uit;
		echo $status_uib;
		?>
</div>
		<div id="statusarea">
  <?php echo $statuslist; ?>
</div>
		<script>

</script>
	</div>

	<div class="leftCOntainer">
		<div id="avatar">
		<?php
		$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
		$query = "SELECT * FROM reg WHERE email='$email' ";
		$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
		$row = mysqli_fetch_array ( $result );
		$path = $row ["avatar"];
		?>
			<input type="image" src=<?php echo $path; ?> height="300" width="250"
				border=1px /> <input type="file" id="my_file" style="display: none;" />
		</div>


		<div class="textHeader"> "<?php echo $email;?> Profile" </div>
		<div class="profileLeftSideContent">Content about this person profile</div>
		<div class="textHeader">My friends</div>
		<div class="images">
			<img src="" height="80" width="56" border=1px />&nbsp;&nbsp; <img
				src="" height="80" width="56" border=1px />&nbsp;&nbsp; <img src=""
				height="80" width="56" border=1px />&nbsp;&nbsp;<br> <img src=""
				height="80" width="56" border=1px />&nbsp;&nbsp; <img src=""
				height="80" width="56" border=1px />&nbsp;&nbsp; <img src=""
				height="80" width="56" border=1px />&nbsp;&nbsp;
		</div>

		<div>
			<input type=button name="gallery" id="gallery"
				value="Profile Pictures "> <input type=button name="imageUpload"
				id="imageUpload" value="Upload">
		</div>
		<br />
		<div class="images">
		
		<?php
		$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
		$query = "SELECT * FROM images WHERE email='$email' ORDER BY id DESC LIMIT 0, 1 ";
		$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
		$row = mysqli_fetch_array ( $result );
		$name = $row ["name"];
		$path = $row ["path"];
		?>
			<img src=<?php echo $path; ?> height="80" width="56" border=1px />
			
			<?php
			$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
			$query = "SELECT * FROM images WHERE email='$email' ORDER BY id DESC LIMIT 1, 1";
			$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
			$row = mysqli_fetch_array ( $result );
			$name = $row ["name"];
			$path = $row ["path"];
			?>
			<img src=<?php echo $path; ?> height="80" width="56" border=1px /> 
			
			<?php
			$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
			$query = "SELECT * FROM images WHERE email='$email' ORDER BY id DESC LIMIT 2, 1";
			$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
			$row = mysqli_fetch_array ( $result );
			$name = $row ["name"];
			$path = $row ["path"];
			?>
			<img src=<?php echo $path; ?> height="80" width="56" border=1px /><br> 
			
			<?php
			$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
			$query = "SELECT * FROM images WHERE email='$email' ORDER BY id DESC LIMIT 3, 1";
			$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
			$row = mysqli_fetch_array ( $result );
			$name = $row ["name"];
			$path = $row ["path"];
			?>
			<img src=<?php echo $path; ?> height="80" width="56" border=1px /> 
			
			<?php
			$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
			$query = "SELECT * FROM images WHERE email='$email' ORDER BY id DESC LIMIT 4, 1";
			$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
			$row = mysqli_fetch_array ( $result );
			$name = $row ["name"];
			$path = $row ["path"];
			?>
			<img src=<?php echo $path; ?> height="80" width="56" border=1px /> 
			
			<?php
			$con = mysqli_connect ( 'localhost', 'root', '', 'myDB' );
			$query = "SELECT * FROM images WHERE email='$email' ORDER BY id DESC LIMIT 5, 1";
			$result = mysqli_query ( $con, $query ) or die ( 'Error, query failed' );
			$row = mysqli_fetch_array ( $result );
			$name = $row ["name"];
			$path = $row ["path"];
			?>
			<img src=<?php echo $path; ?> height="80" width="56" border=1px />
		</div>
	</div>

</body>
</html>
