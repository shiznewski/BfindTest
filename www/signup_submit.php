<?php
include('dbconnect.php');

if (isset($_POST['type'])){

	if ($_POST['type'] == 'bar'){
		//submit bar registration
		$fname = mysql_real_escape_string($_POST['fname']);
		$lname = mysql_real_escape_string($_POST['lname']);
		$email = mysql_real_escape_string($_POST['baremail']);
		
		$barname = mysql_real_escape_string($_POST['barname']);
		$baraddress = mysql_real_escape_string($_POST['baraddress']);
		$barcity = mysql_real_escape_string($_POST['barcity']);
		$barstate = mysql_real_escape_string($_POST['barstate']);
		$barzip = mysql_real_escape_string($_POST['barzip']);
		$barphone = mysql_real_escape_string($_POST['barphone']);
		
		//check variables 
		$errmsg = '';
		$errnum = 0;
		if ($fname == ''){
			$errmsg = 'Must fill in first name';
			$errnum = 1;
			echo $errmsg;
			exit();			
		}
		if ($lname==''){
			$errmsg = 'Must fill in last name';
			$errnum = 2;
			echo $errmsg;
			exit();			
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errmsg = 'Must enter a valida email';
			$errnum = 3;
			echo $errmsg;
			exit();
		}
		if ($barname==''){
			$errmsg = 'Must fill in bar name';
			$errnum = 4;
			echo $errmsg;
			exit();			
		}		
		if ($baraddress==''){
			$errmsg = 'Must fill in bar address';
			$errnum = 5;
			echo $errmsg;
			exit();			
		}		
		if ($barstate==''){
			$errmsg = 'Must select bar state';
			$errnum = 6;
			echo $errmsg;
			exit();			
		}				
		if ($barcity==''){
			$errmsg = 'Must select bar city';
			$errnum = 7;
			echo $errmsg;
			exit();			
		}
		if ($barzip==''){
			$errmsg = 'Must select bar zip';
			$errnum = 8;
			echo $errmsg;
			exit();			
		}			
		if ($barphone==''){
			$errmsg = 'Must enter the bars phone number';
			$errnum = 9;
			echo $errmsg;
			exit();			
		}
		else{
			if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $barphone)) {
				
			}	
			else{
				$errmsg = 'Must enter phone number as xxx-xxx-xxxx';
				$errnum = 10;
				echo $errmsg;
				exit();				
			}
		}
		
		
		
		//data is validated
		
		/* Not sure what to do about email address yet as 1 bar owner or manager could try to sign up several bars.
			//confirm email address does not exist
			$query = "SELECT * FROM tbl_users_bars WHERE email = '$email'";
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);
			
			if ($num > 0){
				$errmsg = 'Email address already used ';
				$errnum = 9;
				echo $errmsg;
				exit();
			}
		*/
		
		//insert into database and send a welcome email.
		//explain that the bar information will be validated.
		//if the bar does not exist in our system and we verify you have the authority to sign up
		//we will send you a username and password where you can manage the bar information.
		
		$query = "INSERT INTO tbl_bars_submitted(fname,lname,barname,baraddress,barcity,barstate,barzip,email,barphone) ";
		$query .= "VALUES('$fname','$lname','$barname','$baraddress','$barcity','$barstate','$barzip','$email','$barphone')";
		$result = mysql_query($query, $conn);
		$num = mysql_affected_rows($conn);
		if ($num >0){
		
			echo 'Your information has been successfully submitted. Please check your email for more instructions';
		
		}
		else{
			echo 'There was a problem inserting into the database';
		}
		
	}
	else{
		//Submit regular user registration
		$search = mysql_real_escape_string($_POST['search']);
		$query = "SELECT DISTINCT city FROM tbl_cityinfo WHERE stateabbr = '$search' order by city";

		$result = mysql_query($query, $conn);
		$num = mysql_num_rows($result);
		//echo "num: " . $num;
		if ($num > 0){
			$output = '';
			while($row = mysql_fetch_assoc($result)){
				$output .= $row['city'] . '||';
			}
			
			if (substr($output, -2) == '||'){
				$output = substr($output, 0, -2);
			}
			echo $output;
		}
		else{
			echo 'no results found';
		}
	}
}
else{

	//echo 'no results';

}

?>