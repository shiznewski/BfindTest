<?php

include('dbconnect.php');

function lookup($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
 
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return null;
   }
 
   //print_r($response);
   $geometry = $response['results'][0]['geometry'];
 
    $longitude = $geometry['location']['lat'];
    $latitude = $geometry['location']['lng'];
 
    $array = array(
        'latitude' => $geometry['location']['lat'],
        'longitude' => $geometry['location']['lng'],
        'location_type' => $geometry['location_type'],
    );
 
    return $array;
 
}
 
$city = 'San Francisco, USA';
$city = '445 kismet rd, Philadelphia, USA';
//$city = '19115';
$city = $_POST['zipcode'];

$array = lookup($city);
$userlat = $array['latitude'];
$userlong = $array['longitude'];
//echo "u2: $userlat , $userlong <br/>";
//print_r($array);


/* Add the WHERE values from the form submit */
	//First we check to see if results MUST have all search options or if they just must have some (OR)
	if ($_POST['allorsome'] == 'ALL')
		$operator = 'AND ';
	else
		$operator = 'OR ';

	$where = 'WHERE ';
	
	
	//GAME OPTIONS
	if (isset($_POST['pool'] )){
		//Checkbox is set
		$where .= "barpool = 'YES' " . $operator;
	}

	if (isset($_POST['darts'] )){
		//Checkbox is set
		$where .= "darts = 'YES' " . $operator;
	}	
	if (isset($_POST['goldentee'] )){
		//Checkbox is set
		$where .= "goldentee = 'YES' " . $operator;
	}		
	
	if (isset($_POST['megatouch'] )){
		//Checkbox is set
		$where .= "megatouch = 'YES' " . $operator;
	}	
	
	if (isset($_POST['quizzo'] )){
		//Checkbox is set
		$where .= "quizzo <> 'UN' " . $operator;
	}		
	
	//Music options
	if (isset($_POST['dj'] )){
		//Checkbox is set
		$where .= "dj <> 'UN' " . $operator;
	}

	if (isset($_POST['band'] )){
		//Checkbox is set
		$where .= "band <> 'UN' " . $operator;
	}	
	if (isset($_POST['touchtunes'] )){
		//Checkbox is set
		$where .= "touchtunes = 'YES' " . $operator;
	}		
	
	//remove ending AND or OR
	if (substr($where, -4) == 'AND '){
		$where = substr($where, 0, -4);
	}
	if (substr($where, -3) == 'OR '){
		$where = substr($where, 0, -3);
	}	
	if ($where == 'WHERE ')
		$where = '';
	
//	$where .= ')';

/* END the WHERE values from the form submit */



$query = "SELECT *, ( 3959 * acos( cos( radians(" . $userlat . ") ) * cos( radians( barlat ) ) * cos( radians( barlong ) - radians(" . $userlong . ") ) + sin( radians(" . $userlat . ") ) * sin( radians( barlat ) ) ) ) AS distance FROM tbl_bars " . $where . " HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;";
//$query = "SELECT barid, barname, baraddress, barcity, barzip, ( 3959 * acos( cos( radians(" . $userlat . ") ) * cos( radians( barlat ) ) * cos( radians( barlong ) - radians(" . $userlong . ") ) + sin( radians(" . $userlat . ") ) * sin( radians( barlat ) ) ) ) AS distance FROM tbl_bars " . $where . " HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;";
$result = mysql_query($query, $conn);
$num = mysql_num_rows($result);

if ($num > 0){
	echo 'Results: ' . $num . '<br><br/>';
	$x = 1;
	while($row = mysql_fetch_assoc($result)){
		
		$gameoutput = '';
		if ($row['barpool'] == 'YES')
			$gameoutput .= '<span class="address">Pool tables</span><br/>';
		
		if (strtolower($row['darts']) == 'yes')
			$gameoutput .= '<span class="address">Darts</span><br/>';
		
		if (strtolower($row['quizzo']) != 'un'){
			//split the string for dates/times.
			$split = explode("|",$row['quizzo']);
			$gameoutput .= '<span class="address">Quizzo: ';
			foreach ($split as $key => $value){
				$gameoutput .= $value . ', ';
			}
			if (substr($gameoutput, -2) == ', ')
				$gameoutput = substr($gameoutput, 0, strlen($gameoutput)-2);			
			$gameoutput .= '</span>';
		}
		if (substr($gameoutput, -5) == '<br/>')
			$gameoutput = substr($gameoutput, 0, strlen($gameoutput)-5);		
		
		//Query for the beer list
		$query = "SELECT a.beerid, typeid, beer, brewery FROM tbl_barinventory a, tbl_beerdata b WHERE barid = $row[barid] and a.beerid = b.beerid ";
		$query .= " Order by brewery, beer";
		$result2 = mysql_query($query, $conn);
		$num = mysql_num_rows($result2);
		$beerlist = '';
		if($num > 0){
			while ($row2 = mysql_fetch_assoc($result2)){
				$beerlist .= $row2['brewery'] . ' - ' . $row2['beer'] . '<br/>';
			}
		}
		$output = '<div class="bar">';
			$output .= '<span class="boldi">'. $row['barname'] . '</span><br/>';
			$output .= '<span class="address">' . $row['baraddress'] . ' ' . $row['barcity'] . ' ' . $row['barzip'] . '</span><br/>';
			$output .= '<span class="address bold red">Game Options</span><br>';
			$output .=  $gameoutput;
			$output .= '<br/>';
			$output .= '<span class="address bold red">Music Options</span><br>';	
			$output .= $musicoutput;
			$output .= '<div style="padding:5px; font-size: 12px; font-weight: bold;">';
			$output .= '<a class="red1" href="#" id="' . $row['barid'] . 'open" onclick="openDiv(this, \'' . $row['barid'] . 'close\', \'' . $row['barid'] . '\');">Show Beer List</a>';
			$output .= '<a class="red1" href="#" id="' . $row['barid'] . 'close" style="display: none;" onclick="closeDiv(this, \'' . $row['barid'] . 'open\', \'' . $row['barid'] . '\');">Hide Beer List</a>';
			$output .= '</div>';
			$output .= '';
			$output .= '<div id="' . $row['barid'] . '" style="width: 280px; margin:0; padding:5px;display: none;">' . $beerlist . '</div>';
		$output .= '</div>';
		
		echo $output;
		$output = '';
		$x = $x +1;
	}
}
else{
	echo 'No Results<br/>';
}

?>
