<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./css/mainPageStyle.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/myJS.js"></script>
</head>
<body>
<img src="./pics/afekaLogo" alt="afeka" style="width:304px;height:228px;"align="right">





<!-- Login Fields -->
<h2 style="color:white">Login</h2>
<div>
<form id="loginForm" method="post" action="#" style="color:white">
<div id="message"></div>
		 E-mail: <input type="text" name="email" id="emailGet"> <br>
		<br> Password:<input type="text" name="pass" id="passGet"> <br>
		<br> <input type=button name="Login" id="Login" value="Login">
	</form>
</div>



<!-- Registration Fields -->
<h3 style="color:white">Registration</h3>
<div>

	<form id="registerForm" method="post" action="#" style="color:white">  
  First Name: <input type="text" name="firstName" id="firstName">
  <br><br>
  
  Last Name: <input type="text" name="lastName" id="lastName">
  <br><br>
  
  
  E-mail: <input type="text" name="email" id="email">
  <br><br>
  
  Password:<input type="text" name="pass" id="pass">
  <br><br>
  
  Gender:
  <input type="radio" name="gender" value="female" id="gender">Female
  <input type="radio" name="gender" value="male" id="gender">Male
  <br><br>
  <input type="button" name="Register" id="Register" value="Register">  
</form>
	

	
</div>




</body>
</html>
