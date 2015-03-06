<?php
	include('../dbconnect.php');

	
	//output username|barname|htmlresponse
	
if (isset($_POST['type'])){
	
	//Put in code to validate the session
	//select * from tbl_sessions where username = $_POST[username] AND sessionid= $_POST[session];
	
	
	//$query = "SELECT * FROM tbl_users_bar WHERE username = '$_POST[username]'";
	$query = "select * from tbl_sessions where username = '$_POST[username]' AND sessionid= '$_POST[session]'";
	$result = mysql_query($query, $conn);
	$num = mysql_num_rows($result);
	if ($num > 0){
		//Check the access time of the session. Make sure its less then 5 days old.
		//if its older then 5 days they must login
		$row = mysql_fetch_assoc($result);
		$accesst = $row['accesstime'];
		
		//$nextWeek = time() + (7 * 24 * 60 * 60);
		$nowtime = time() - (5*24*60*60);
		if ($nowtime < $accesst){
			
			//Here we have a valid session.
			//Lookup the bar id for this user.
			$query = "SELECT * FROM tbl_users WHERE email = '$_POST[username]'"; 
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);		
			if($num > 0){
				$row = mysql_fetch_assoc($result);
				$barid = $row['barid'];
				if ($_POST['type'] == 'load'){
					loadData($barid);
				}
				elseif ($_POST['type'] == 'update'){
					//this is the area to update
					$output = '';
					foreach ($_POST['beerList'] as $selectedOption){
						//echo $selectedOption."\n";
						$query = "INSERT INTO tbl_barinventory (barid, beerid, typeid) VALUES($barid, $selectedOption, '$_POST[beertype]')";
						$result = mysql_query($query, $conn);
						$num = mysql_affected_rows($conn);
					}
					loadData($barid);
				}
				else{
					//delete beer
					$query = "DELETE FROM tbl_barinventory WHERE barid = $_POST[barid] AND beerid = $_POST[beerid] AND typeid = '$_POST[type]'";
					$result = mysql_query($query, $conn);
					$num = mysql_affected_rows($conn);
					loadData($barid);
				}
			}
		}
		else{
			//cookie expired;
			echo 'Cookie expired accesst=' . $accesst . ' Now=' . $nowtime;;
		}
	}
	else{
		//add entry to database for bar id.
		echo "Failed|Login";
	}
		
}
else{

	//echo 'no results';

}



function loadData($barid){
			include('../dbconnect.php');
			//Return the beer data for editing
			$query = "SELECT a.beerid, typeid, beer, brewery FROM tbl_barinventory a, tbl_beerdata b WHERE barid = $barid and a.beerid = b.beerid";
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);		
			if ($num >0){
				//loop results output in table format for delete option
				echo '<table class="TFtable">';
					echo '<tr><td>Brewery</td><td>Beer </td><td>Type</td><td>Action</td></tr>';
					while ($row = mysql_fetch_assoc($result)){
						echo "<tr><td>$row[brewery]</td><td>$row[beer]</td><td>$row[typeid]</td><td><a href=\"#\" onclick=\"BarInfo('$barid,$row[beerid],$row[typeid]');\">Delete</a></td></tr>";	
					}
				echo '</table>';
			}
			else{
				//return string saying no inventory added
				echo "There is currently no inventory for this bar";
			}

}
?>