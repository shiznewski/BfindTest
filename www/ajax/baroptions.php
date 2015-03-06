<?php
	include('../dbconnect.php');

	
	//output username|barname|htmlresponse
	
if (isset($_POST['type'])){
	
	//Put in code to validate the session
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
					//check post variables and send updates to the table
					$query = "UPDATE tbl_bars ";
					$query .= "SET quizzo = '" . genDayAndTime('q') . "', ";
					
					if (isset($_POST['pool']))
						$query .= "barpool = 'YES', ";
					else
						$query .= "barpool = 'NO', ";

					if (isset($_POST['darts']))
						$query .= "darts = 'YES', ";
					else
						$query .= "darts = 'NO', ";
						
					if (isset($_POST['goldentee']))
						$query .= "goldentee = 'YES', ";
					else
						$query .= "goldentee = 'NO', ";						
						
					if (isset($_POST['megatouch']))
						$query .= "megatouch = 'YES', ";
					else
						$query .= "megatouch = 'NO', ";

					if (isset($_POST['touchtunes']))
						$query .= "touchtunes = 'YES', ";
					else
						$query .= "touchtunes = 'NO', ";						
					$query .= "dj = '" . genDayAndTime('dj') . "', ";
					$query .= "band = '" . genDayAndTime('band') . "', ";
					$query .= "karaoke = '" . genDayAndTime('karaoke') . "' ";
					$query .= "WHERE barid = $barid";
					$result2 = mysql_query($query, $conn);
					$num = mysql_affected_rows($conn);
					if ($num > 0){
						echo 'Successfully updated';
					}
					else{
						//do a check to see if all values match the database.
						//if so it is not a failure just nothing to update.
						echo 'update failed<br>' . $query;
					}
					//loadData($barid);
				}
				else{
					//there is no delete option for "bar options page"
				}
			}
		}
		else{
			//cookie expired;
			echo 'Cookie expired accesst=' . $accesst . ' Now=' . $nowtime;
			echo "Failed|Login";
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

function genDayAndTime($type){

	//Sun - Sat
	$output = '';
	if (isset($_POST['dt' . $type . 'sun'])){
		$output .= 'Sun: ' . $_POST[$type . 'sun'] . '|';
	}
	if (isset($_POST['dt' . $type . 'mon'])){
		$output .= 'Mon: ' . $_POST[$type . 'mon'] . '|';
	}
	if (isset($_POST['dt' . $type . 'tue'])){
		$output .= 'Tue: ' . $_POST[$type . 'tue'] . '|';
	}
	if (isset($_POST['dt' . $type . 'wed'])){
		$output .= 'Wed: ' . $_POST[$type . 'wed'] . '|';
	}
	if (isset($_POST['dt' . $type . 'thu'])){
		$output .= 'Thu: ' . $_POST[$type . 'thu'] . '|';
	}
	if (isset($_POST['dt' . $type . 'fri'])){
		$output .= 'Fri: ' . $_POST[$type . 'fri'] . '|';
	}
	if (isset($_POST['dt' . $type . 'sat'])){
		$output .= 'Sat: ' . $_POST[$type . 'sat'] . '|';
	}
	if (substr($output, -1) == '|'){
		$output = substr($output, 0,-1);
	}
	if ($output == '')
		$output = 'UN';
	return $output;
}

function loadData($barid){
			include('../dbconnect.php');
			//Return the beer data for editing
			$query = "SELECT * FROM tbl_bars WHERE barid = $barid";
			$result = mysql_query($query, $conn);
			$num = mysql_num_rows($result);
			//$abc = $query;
			if ($num >0){
				//loop results output in a html form so you can show current value and allow edit
				//quizzo first
				$loutput = '';
				$row = mysql_fetch_assoc($result);
					$loutput .= '<div class="collapsible">';
						$loutput .= '<a href="#" id="billardopen" onclick="openDiv(this, \'billardclose\', \'billard\');">Show Game Options</a>'; 
						$loutput .= '<a href="#" id="billardclose" style="display: none;" onclick="closeDiv(this, \'billardopen\', \'billard\');">Hide Game Options</a>';
						$loutput .= '<div id="billard">';
							//START QUIZZO
							$loutput .= '<label for="field2"><span>Quizzo<span class="required"></span></span></label><br/><br/>';
							if (strpos($row['quizzo'], 'Sun') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Sunday', 'Sun', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Sun');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos);
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Sunday', 'Sun', $ptime, 'q');
							}
							if (strpos($row['quizzo'], 'Mon') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Monday', 'Mon', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Mon');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos) +2;
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Monday', 'Mon', $ptime, 'q');
							}
							if (strpos($row['quizzo'], 'Tue') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Tuesday', 'Tue', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Tue');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos)+2;
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Tuesday', 'Tue', $ptime, 'q');
							}
							if (strpos($row['quizzo'], 'Wed') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Wednesday', 'Wed', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Wed');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos) +2;
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Wednesday', 'Wed', $ptime, 'q');
								$abc = $ptime;
							}
							if (strpos($row['quizzo'], 'Thu') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Thursday', 'Thu', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Thu');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos) +2;
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Thursday', 'Thu', $ptime, 'q');
							}
							if (strpos($row['quizzo'], 'Fri') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Friday', 'Fri', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Fri');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos) +2;
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Friday', 'Fri', $ptime, 'q');
							}
							if (strpos($row['quizzo'], 'Sat') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Saturday', 'Sat', '', 'q');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['quizzo'], 'Sat');
								$pos = strpos($row['quizzo'], ' ', $pos) +1;
								$pos2 = strpos($row['quizzo'], 'PM', $pos) + 2;
								$ptime = substr($row['quizzo'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Saturday', 'Sat', $ptime, 'q');
							}

							//END QUIZZO
							
							$loutput .= '<br/><br/>';
							
							$loutput .= '<label for="field2"><span>Pool Tables<span class="required"></span></span><input style="height:20px;" type="checkbox" class="input-field" name="pool" value="" /></label>';
							$loutput .= '<label for="field3"><span>Darts<span class="required"></span></span><input style="height:20px;" type="checkbox" class="input-field" name="darts" value="" /></label>';
							$loutput .= '<label for="field3"><span>Golden Tee<span class="required"></span></span><input style="height:20px;" type="checkbox" class="input-field" name="goldentee" value="" /></label>';
							$loutput .= '<label for="field3"><span>Megatouch<span class="required"></span></span><input style="height:20px;" type="checkbox" class="input-field" name="megatouch" value="" /></label>';				
						$loutput .= '</div>';
					$loutput .= '</div>';
					$loutput .= '<hr>';
				
				
					$loutput .= '<div class="collapsible">';
						$loutput .= '<a href="javascript:void(0);" id="musicopen" onclick="openDiv(this, \'musicclose\', \'music\');">Show Music Options</a>'; 
						$loutput .= '<a href="javascript:void(0);" id="musicclose" style="display: none;" onclick="closeDiv(this, \'musicopen\', \'music\');">Hide Music Options</a>';
						$loutput .= '<div id="music">';				
							$loutput .= '<br/>';
							$loutput .= '<label for="field3"><span>Touch Tunes<span class="required"></span></span><input style="height:20px;" type="checkbox" class="input-field" name="touchtunes" value="" /></label>';
							$loutput .= '<label for="field2"><span>DJ<span class="required"></span></span></label><br/><br/>';
							//START DJ
							if (strpos($row['dj'], 'Sun') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Sunday', 'Sun', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Sun');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos);
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Sunday', 'Sun', $ptime, 'dj');
							}
							if (strpos($row['dj'], 'Mon') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Monday', 'Mon', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Mon');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos) +2;
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Monday', 'Mon', $ptime, 'dj');
							}
							if (strpos($row['dj'], 'Tue') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Tuesday', 'Tue', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Tue');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos)+2;
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Tuesday', 'Tue', $ptime, 'dj');
							}
							if (strpos($row['dj'], 'Wed') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Wednesday', 'Wed', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Wed');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos) +2;
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Wednesday', 'Wed', $ptime, 'dj');
								$abc = $ptime;
							}
							if (strpos($row['dj'], 'Thu') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Thursday', 'Thu', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Thu');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos) +2;
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Thursday', 'Thu', $ptime, 'dj');
							}
							if (strpos($row['dj'], 'Fri') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Friday', 'Fri', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Fri');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos) +2;
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Friday', 'Fri', $ptime, 'dj');
							}
							if (strpos($row['dj'], 'Sat') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Saturday', 'Sat', '', 'dj');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['dj'], 'Sat');
								$pos = strpos($row['dj'], ' ', $pos) +1;
								$pos2 = strpos($row['dj'], 'PM', $pos) + 2;
								$ptime = substr($row['dj'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Saturday', 'Sat', $ptime, 'dj');
							}

							//END DJ
							
							//START BAND
							$loutput .= '<br>';
							$loutput .= '<label for="field2"><span>Band<span class="required"></span></span></label><br/><br/>';
							
							if (strpos($row['band'], 'Sun') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Sunday', 'Sun', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Sun');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos);
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Sunday', 'Sun', $ptime, 'band');
							}
							if (strpos($row['band'], 'Mon') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Monday', 'Mon', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Mon');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos) +2;
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Monday', 'Mon', $ptime, 'band');
							}
							if (strpos($row['band'], 'Tue') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Tuesday', 'Tue', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Tue');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos)+2;
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Tuesday', 'Tue', $ptime, 'band');
							}
							if (strpos($row['band'], 'Wed') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Wednesday', 'Wed', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Wed');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos) +2;
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Wednesday', 'Wed', $ptime, 'band');
								$abc = $ptime;
							}
							if (strpos($row['band'], 'Thu') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Thursday', 'Thu', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Thu');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos) +2;
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Thursday', 'Thu', $ptime, 'band');
							}
							if (strpos($row['band'], 'Fri') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Friday', 'Fri', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Fri');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos) +2;
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Friday', 'Fri', $ptime, 'band');
							}
							if (strpos($row['band'], 'Sat') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Saturday', 'Sat', '', 'band');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['band'], 'Sat');
								$pos = strpos($row['band'], ' ', $pos) +1;
								$pos2 = strpos($row['band'], 'PM', $pos) + 2;
								$ptime = substr($row['band'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Saturday', 'Sat', $ptime, 'band');
							}

							//END BAND				
							
							
							//START Karaoke
							$loutput .= '<br>';
							$loutput .= '<label for="field2"><span>Karaoke<span class="required"></span></span></label><br/><br/>';
							
							if (strpos($row['karaoke'], 'Sun') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Sunday', 'Sun', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Sun');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos);
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Sunday', 'Sun', $ptime, 'karaoke');
							}
							if (strpos($row['karaoke'], 'Mon') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Monday', 'Mon', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Mon');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos) +2;
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Monday', 'Mon', $ptime, 'karaoke');
							}
							if (strpos($row['karaoke'], 'Tue') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Tuesday', 'Tue', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Tue');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos)+2;
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Tuesday', 'Tue', $ptime, 'karaoke');
							}
							if (strpos($row['karaoke'], 'Wed') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Wednesday', 'Wed', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Wed');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos) +2;
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Wednesday', 'Wed', $ptime, 'karaoke');
								$abc = $ptime;
							}
							if (strpos($row['karaoke'], 'Thu') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Thursday', 'Thu', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Thu');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos) +2;
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Thursday', 'Thu', $ptime, 'karaoke');
							}
							if (strpos($row['karaoke'], 'Fri') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Friday', 'Fri', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Fri');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos) +2;
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Friday', 'Fri', $ptime, 'karaoke');
							}
							if (strpos($row['karaoke'], 'Sat') === false){
								//output sunday quizzo.
								$loutput .= outputSelect('Saturday', 'Sat', '', 'karaoke');
							}
							else{
								//output quizzo with select selected.
								$pos = strpos($row['karaoke'], 'Sat');
								$pos = strpos($row['karaoke'], ' ', $pos) +1;
								$pos2 = strpos($row['karaoke'], 'PM', $pos) + 2;
								$ptime = substr($row['karaoke'], $pos, $pos2-$pos);
								$loutput .= outputSelect('Saturday', 'Sat', $ptime, 'karaoke');
							}

							//END Karaoke					
						$loutput .= '</div>';
					$loutput .= '</div>';
				
				echo $loutput;
				//echo $abc;
			}
			else{
				//return string saying no inventory added
				echo "There is currently no inventory for this bar";
			}

}

function outputSelect($theday, $abbr, $thetime, $type){
	$abbr = strtolower($abbr);
	$output = '';
	$output .= '<label for="field2"><span>' . $theday . ':</span> <input type="checkbox"';
	if ($thetime != '')
		$output .= 'checked ';
	$output .= 'name="dt' . $type .  $abbr . '" id="dt' . $type . $abbr . '" />';
		$output .= '<select name="' . $type . $abbr . '" id="' . $type . $abbr . '">';
		$output .= '<option value="12:00PM"';
		if ($thetime == '12:00PM')
			$output .= ' selected';
		$output .= '>12:00PM</option>';
		$output .= '<option value="12:30PM"';
		if ($thetime == '12:30PM')
			$output .= ' selected';		
		$output .= '>12:30PM</option>';
		$output .= '<option value="1:00PM"';
		if ($thetime == '1:00PM')
			$output .= ' selected';			
		$output .= '>1:00PM</option>';
		$output .= '<option value="1:30PM"';
		if ($thetime == '1:30PM')
			$output .= ' selected';			
		$output .= '>1:30PM</option>';
		$output .= '<option value="2:00PM"';
		if ($thetime == '2:00PM')
			$output .= ' selected';			
		$output .= '>2:00PM</option>';
		$output .= '<option value="2:30PM"';
		if ($thetime == '2:30PM')
			$output .= ' selected';			
		$output .= '>2:30PM</option>';
		$output .= '<option value="3:00PM"';
		if ($thetime == '3:00PM')
			$output .= ' selected';			
		$output .= '>3:00PM</option>';
		$output .= '<option value="3:30PM"';
		if ($thetime == '3:30PM')
			$output .= ' selected';			
		$output .= '>3:30PM</option>';
		$output .= '<option value="4:00PM"';
		if ($thetime == '4:00PM')
			$output .= ' selected';			
		$output .= '>4:00PM</option>';
		$output .= '<option value="4:30PM"';
		if ($thetime == '4:30PM')
			$output .= ' selected';			
		$output .= '>4:30PM</option>';
		$output .= '<option value="5:00PM"';
		if ($thetime == '5:00PM')
			$output .= ' selected';			
		$output .= '>5:00PM</option>';
		$output .= '<option value="5:30PM"';
		if ($thetime == '5:30PM')
			$output .= ' selected';			
		$output .= '>5:30PM</option>';
		$output .= '<option value="6:00PM"';
		if ($thetime == '6:00PM')
			$output .= ' selected';			
		$output .= '>6:00PM</option>';
		$output .= '<option value="6:30PM"';
		if ($thetime == '6:30PM')
			$output .= ' selected';			
		$output .= '>6:30PM</option>';
		$output .= '<option value="7:00PM"';
		if ($thetime == '7:00PM')
			$output .= ' selected';			
		$output .= '>7:00PM</option>';
		$output .= '<option value="7:30PM"';
		if ($thetime == '7:30PM')
			$output .= ' selected';			
		$output .= '>7:30PM</option>';
		$output .= '<option value="8:00PM"';
		if ($thetime == '8:00PM')
			$output .= ' selected';			
		$output .= '>8:00PM</option>';
		$output .= '<option value="8:30PM"';
		if ($thetime == '8:30PM')
			$output .= ' selected';			
		$output .= '>8:30PM</option>';
		$output .= '<option value="9:00PM"';
		if ($thetime == '9:00PM')
			$output .= ' selected';			
		$output .= '>9:00PM</option>';
		$output .= '<option value="9:30PM"';
		if ($thetime == '9:30PM')
			$output .= ' selected';			
		$output .= '>9:30PM</option>';
		$output .= '<option value="10:00PM"';
		if ($thetime == '10:00PM')
			$output .= ' selected';			
		$output .= '>10:00PM</option>';
	$output .= '</select>';										
	$output .= '</label>';	
	return $output;
}
?>