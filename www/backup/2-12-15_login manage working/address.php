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
$query = "SELECT barid, barname, baraddress, barcity, barzip, ( 3959 * acos( cos( radians(" . $userlat . ") ) * cos( radians( barlat ) ) * cos( radians( barlong ) - radians(" . $userlong . ") ) + sin( radians(" . $userlat . ") ) * sin( radians( barlat ) ) ) ) AS distance FROM tbl_bars " . $where . " HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;";
$result = mysql_query($query, $conn);
//echo $query . "<br/>";
$num = mysql_num_rows($result);

if ($num > 0){
	echo 'Results: ' . $num . '<br><br/>';
	while($row = mysql_fetch_assoc($result)){
		$output = '<div class="bar">';
			$output .= '<span class="boldi">'. $row['barname'] . '</span><br/>';
			$output .= '<span class="address">' . $row['baraddress'] . ' ' . $row['barcity'] . ' ' . $row['barzip'] . '</span>';
		$output .= '</div>';
		echo $output;
		$output = '';
	}
}
else{
	echo 'No Results<br/>';
}

?>
