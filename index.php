<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<script src="jquery-3.3.1.js"></script>
	<style>
		*{
			font-family: 'Quicksand', sans-serif!important;
		}
		#container{
			height:100vh;
			transition:0.2s linear;
		}
		.w3-button{
			background: black;
			width:14vw;
			height:8vh;
			transition: 0.2s linear;
			border-radius:5px;
			font-size:26px;
			color:white;
		}
		.w3-button:hover{
			color:black!important;
			background-color:white!important;
		}
		h2{
			font-size:5vw;
			letter-spacing: 7px;
		}
		.bar{
			font-size:30px;
			width:30vw;
			margin:0 auto;
			background-color: inherit;
		}
		#passwordBar{
			display:none;
			transition:0.2s ease-out;
		}
	</style> 
</head>
<?php
	//IF USERNAME IS SET
	if(isset($_POST["username"])){
		session_start();
		$_SESSION["uname"] = $_POST["username"];
		$uname = $_SESSION["uname"];
		//IF USERNAME IS "qianlongxiang" & IF PASSWORD IS VALID
		if ($uname == "qianlongxiang"){
			$psw = $_POST["password"];
			if (isset($psw) && $psw == "admin"){
				header("Location:chatroom.php");
			}
			else{
				echo "<script>alert('INVALID PASSWORD!')</script>";
				header("Location:index.php");
			}
		}
		else{
			header("Location:chatroom.php");
		}
		
	}else{

?>
<body>
	<div id = "container">
		<form method = "post">
			<br><br><br><br><br><br><br><br>
			<div class = "w3-center w3-row">
				<h2 id = "welcomeText">Welcome.</h2><br>
				<input id = "nameBar" class="w3-input w3-center bar" type="text" placeholder="" name = "username" required style = "outline: none" value =""  onkeyup="isAdmin()" autocomplete="off" required><br>
				<input  id = "passwordBar" class="w3-input w3-center bar" type="password" placeholder="" name = "password" style = "outline: none" value = " " autocomplete="off" required ><br>
				<button type = "submit" class = "w3-button" style = "">Log in</button>
			</div>
		</form>
	</div>
</body>
<?php
	}
?>
<script>
	//AUTOFOCUS ON INPUT BAR WHEN PAGE LOADED
	window.onload = function() {
	  var input = document.getElementById("nameBar").focus();
	};
	//IF ADMIN, SHOW PASSWORD FIELD
	function isAdmin(){
		var uname = document.getElementById("nameBar").value;
		if (uname == "qianlongxiang"){
			//alert(uname);
			document.getElementById("passwordBar").value = "";
			var input = document.getElementById("passwordBar").focus();
			adminTheme();
		}
		else{
			peasantTheme();
		}
	}
	//ADMIN THEME
	function adminTheme(){
		document.getElementById("container").style.backgroundColor = "#000000";
		document.getElementById("welcomeText").style.color = "white";
		document.getElementsByClassName("bar")[0].style.color = "white";
		document.getElementById("passwordBar").style.display = "block";
		document.getElementsByClassName("bar")[1].style.color = "white";

	}
	//PEASANT THEME
	function peasantTheme(){
		document.getElementById("container").style.backgroundColor = "#FFFFFF";
		document.getElementById("welcomeText").style.color = "black";
		document.getElementById("nameBar").style.color = "black";
		document.getElementById("passwordBar").style.display = "none"
	}
</script>
</html>