<?php
	include('../dbconnect.php');

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} 
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}	

	if (isset($_POST['type'])){
		if ($_POST['type'] == 'session'){
			$query = "SELECT * FROM tbl_sessions a, tbl_users b WHERE a.username='$_POST[username]' AND a.sessionid='$_POST[session]' and a.username = b.email";
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);
			if ($num > 0){
				//update
				$row = mysql_fetch_assoc($result);
				$type = $row['type'];
				$query = "UPDATE tbl_sessions SET accesstime = " . time() . " WHERE username = '$_POST[username]' AND sessionid='$_POST[session]'";
				$result = mysql_query($query, $conn);
				$num = mysql_affected_rows($conn);
				echo "Success|$type|$_POST[session]";					
			}
			else{
				echo "Fail|$type|";
			}
		}
		else{
			$query = "SELECT * FROM tbl_users WHERE email = '$_POST[username]' AND password = '$_POST[password]'";	
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);
			if ($num > 0){
				//successful login. create md5 hash
				$row = mysql_fetch_assoc($result);
				$type = $row['type'];
				if ($_POST['device'] == 'computer'){
					$session = md5($_POST['username']  . $ip);
				}
				else{
					$session = md5($_POST['username']  . $_POST['device']);
				}
				
				$query = "SELECT * FROM tbl_sessions WHERE username='$_POST[username]' AND sessionid='$session'";
				$result = mysql_query($query, $conn);
				$num = mysql_num_rows($result);
				if ($num > 0){
					//update
					$query = "UPDATE tbl_sessions SET accesstime = " . time() . " WHERE username = '$_POST[username]' AND sessionid='$session'";
					$result = mysql_query($query, $conn);
					$num = mysql_affected_rows($conn);
					echo "Success|$type|$session";					
				}
				else{
					$query = "INSERT INTO tbl_sessions(username, sessionid, accesstime) VALUES('$_POST[username]','$session','" . time() . "')";
					$result = mysql_query($query, $conn);
					$num = mysql_affected_rows($conn);
					echo "Success|$type|$session";
				}
			}
			else{
				echo "Failed||$query";
			}
		}
			
	}
			
	else{

		//echo 'no results';

	}

?>