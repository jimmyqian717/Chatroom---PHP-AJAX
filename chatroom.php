<!DOCTYPE html>
<?php
	//NAME HANDLING
	session_start();
	$uname = $_SESSION['uname'];
	if($uname == "qianlongxiang"){
		$username = "Longxiang Qian(Jimmy)";
		$displayName = "Admin";
	}
	else{
		$username = $uname;
		$displayName = $uname;
	}
?>
<html>
<head>
	<title>Chat room</title>
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/chatroom.css">
	<link href="https://fonts.googleapis.com/css?family=Poor+Story" rel="stylesheet">
	<script src="jquery-3.3.1.js"></script>
</head>
<body onload = "load();ifAdmin();autoFocus();">

	<div id="textArea">
		<h2 id = "name" style = "position:fixed"><?php echo $displayName; ?></h2>
		<input id = "currentU" type = "text" style = "opacity:0;user-select:none;z-index:-1;cursor:default" value ="<?php echo $username;?>" >
		<p id = "messages"></p>
	</div> 
	<input type="text" name="newMsg" id = "msgBar" placeholder="Say something.." value = "">
	<button type="button" id = "sendBtn" >Send</button>
	
</body>
</html>
<script>
	//ONCLICK TRIGGERING SEND()
	$("#sendBtn").click(function(){
		if ($("#msgBar").val() !== ""){
			send();
		}
		
	});
	//ONKEYPRESS TRIGGERING SEND()
	$("#msgBar").keypress (function(e){
		var code = e.keyCode || e.which;
		if (code == 13){
			if ($("#msgBar").val() !== ""){
				send();	
			}
		}	
		
	});
	//AJAX - PHP
	function send(){
		var $uname = $("#currentU").val();
		var $message = $("#msgBar").val();
		$.ajax({
			type: "POST",
			url: 'sender.php',
			data: {newMsg:$message,cu:$uname},
			success: function(data) {
				$("#msgBar").val("");
			}
		});
	}
</script>
<script>	
	

	//AUTOFOCUS ON INPUT BAR WHEN PAGE LOADED
	function autoFocus(){
		var input = document.getElementById('msgBar').focus();
	}
	//CHECK IF ADMIN
	function ifAdmin(){
		//alert(document.getElementById("currentU").value);
		//IF TRUE, CHANGE THEME 
		if (document.getElementById("currentU").value == "Longxiang Qian(Jimmy)"){
			adminTheme();
		}
	}
	//UPDATING DISPLAYED MESSAGES EVERY 0.1s
	function load() {
	    var myVar = setInterval(update, 100);
	}
	function updateScroll(){
	    var element = document.getElementById("textArea");
	    element.scrollTop = element.scrollHeight;
	}
	function update() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (document.getElementById("messages").innerHTML !== this.responseText){
					document.getElementById("messages").innerHTML = this.responseText;
					updateScroll(); 
				}
				//alert(document.getElementById("messages").innerHTML);
				//alert(this.responseText);
				
			}
		};
		xhttp.open("POST", "messages.txt", true);
		xhttp.send();

	}
	//ADMIN THEME
	function adminTheme(){
		document.getElementById('name').style.background = "#000000";
		document.getElementById("textArea").style.backgroundColor = "#000000";
		document.getElementById("messages").style.color = "white";
		document.getElementById("name").style.color = "white";
		document.getElementById("msgBar").style.backgroundColor = "#000000";
		document.getElementById("msgBar").style.color = "white";
		document.getElementById("msgBar").style.marginLeft = "0";
		document.getElementById("msgBar").style.width = "80vw";
		document.getElementById("sendBtn").style.backgroundColor = "#000000";
		document.getElementById("sendBtn").style.color = "white";
		document.getElementById("sendBtn").style.width = "19 .5vw";
		document.body.style.backgroundColor = "#000000";
	}

</script>
