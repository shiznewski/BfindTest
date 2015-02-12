<?php
include('dbconnect.php');

if (isset($_POST['search'])){

	//Do the lookup for beer/brewery matches
	$search = mysql_real_escape_string($_POST['search']);
	$query = "SELECT * FROM tbl_beerdata WHERE (brewery LIKE '%$search%') or (beer LIKE '%$search%')";
	//echo $search;
	//exit();
	$result = mysql_query($query, $conn);
	$num = mysql_num_rows($result);
	//echo "num: " . $num;
	if ($num > 0){
		$output = 'Results: ' . $num . '. Select one or more.||';
		while($row = mysql_fetch_assoc($result)){
		
			$output .= $row['beerid'] . '|' . $row['brewery'] . '|' . $row['beer'] . '||';
		
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

	echo 'no results';

}

?>