<?php
	session_start();
	if (isset($_POST['newMsg'])){
		$my_file = 'messages.txt';
		//CHECK IF ADMIN
		if($_SESSION['uname'] == "qianlongxiang"){
			//CLEANING LOG COMMAND
			if ($_POST['newMsg'] == "clr"){
				$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
				$data = "";
				fwrite($handle, $data);
			}
			else{
				$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
				$data =$_POST["cu"].": ".$_POST['newMsg']."<br>";
				fwrite($handle, $data);
				
			}
		}
		//IF NOT
		else{
			$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
			$data =$_POST["cu"].": ".$_POST['newMsg']."<br>";
			fwrite($handle, $data);
		}
		
	}	
?>