<?php
	include('../dbconnect.php');

	$query = "SELECT * FROM `tbl_bars_submitted` WHERE 1";
	$result = mysql_query($query, $conn);
	$num = mysql_num_rows($result);
?>

<html>
	<head>
		<title>Pub Sleuth Admin Area</title>

		<style type="text/css">
			.TFtable{
				width:100%; 
				border-collapse:collapse; 
			}
			.TFtable td{ 
				padding:7px; border:#4e95f4 1px solid;
			}
			/* provide some minimal visual accomodation for IE8 and below */
			.TFtable tr{
				background: #b8d1f3;
			}
			/*  Define the background color for all the ODD background rows  */
			.TFtable tr:nth-child(odd){ 
				background: #b8d1f3;
			}
			/*  Define the background color for all the EVEN background rows  */
			.TFtable tr:nth-child(even){
				background: #dae5f4;
			}
		</style>

	</head>
	
	<body>
		
		<?
			if ($num == 0){
				echo 'There are no bar signups to process';
			}
			else{
				echo '<table class="TFtable">';
					echo '<tr><td>Name</td><td>Bar Name</td><td>Address</td><td>City</td><td>State</td><td>Zip</td><td>Phone</td><td>Action</td></tr>';
					while($row = mysql_fetch_assoc($result)){
					
						echo "<tr><td>$row[fname] $row[lname]</td><td>$row[barname]</td><td>$row[baraddress]</td><td>$row[barcity]</td><td>$row[barstate]</td><td>$row[barzip]</td><td>$row[barphone]</td><td><a href=\"#\">Approve</a>/<a href=\"#\">Deny</a></td></tr>";
					
					}
				echo '</table>';
			}
		?>
	</body>
</html>