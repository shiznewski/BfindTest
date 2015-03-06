<?php
include('dbconnect.php');

if (isset($_POST['search'])){

	if ($_POST['search'] == 'city'){
		//do zipcode lookup
		//Do the lookup cities
		$state = mysql_real_escape_string($_POST['state']);
		$city = mysql_real_escape_string($_POST['city']);
		$query = "SELECT DISTINCT zipcode FROM tbl_cityinfo WHERE stateabbr = '$state' AND city = '$city' order by zipcode";
		//echo $query;
		//exit();
		$result = mysql_query($query, $conn);
		$num = mysql_num_rows($result);
		//echo "num: " . $num;
		if ($num > 0){
			$output = '';
			while($row = mysql_fetch_assoc($result)){
				$output .= $row['zipcode'] . '||';
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
	else{
		//Do the lookup cities
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

	echo 'no results';

}

?>