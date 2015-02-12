<?php
	include('../dbconnect.php');

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}	

	if (isset($_POST['type'])){

		if ($_POST['type'] == 'bar'){
			
			$query = "SELECT * FROM tbl_users_bar WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);
			if ($num > 0){
				//successful login. create md5 hash
				if ($_POST['device'] == 'computer'){
					$session = md5($_POST['username']  . $ip);
				}
				else{
					$session = md5($_POST['username']  . $_POST['device']);
				}
				$query = "INSERT INTO tbl_sessions(username, sessionid, accesstime) VALUES('$_POST[username]','$session','" . time() . "')";
				$result = mysql_query($query, $conn);
				$num = mysql_affected_rows($conn);
				echo "Success|$session";
			}
			else{
				echo "Failed|Invalid username or password";
			}
			
		}
			
	}
	else{

		//echo 'no results';

	}

?>