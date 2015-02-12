<?php
	include('../dbconnect.php');
	
	$query = "SELECT * FROM tbl_beerdata WHERE brewery like '%(%'";
	$result = mysql_query($query, $conn);
	echo $query;
	while ($row = mysql_fetch_assoc($result)){
		$mystring = 'abc';
		$findme   = 'a';
		$pos = strpos($mystring, $findme);		
		$start = strpos($row['brewery'], '(');
		$end = strpos($row['brewery'], ')') + 1;
		$remove = substr($row['brewery'], $start, $end - $start);
		$remove = ' ' . $remove;
		echo $remove . '<br>';
		$new = str_replace($remove, '', $row['brewery']);
		$new = mysql_escape_string($new);
		$query = "UPDATE tbl_beerdata SET brewery = '$new' WHERE beerid = $row[beerid]";
		echo $query;
		$res = mysql_query($query, $conn);
		
	}
	
?>