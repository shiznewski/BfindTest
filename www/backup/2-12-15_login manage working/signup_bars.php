<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Pub Sleuth - Bar Registration</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" type="text/css" href="files/main.css">
		<link rel="stylesheet" type="text/css" href="files/stncss.css">
		<link rel="stylesheet" type="text/css" href="files/stncss.css">	


	</head>

	<body>
		<div class="container" id="container">
			
			<header>
				<div class="top">
					<div style="text-align: center;margin: 0 auto; padding: 5px;">
					<img src="files/logo.png"/>
					</div>
					
				</div>
				<nav>
					<ul>
					</ul>
				</nav>
			</header>
			<section class="banner home">
				<div class="form-style-2" id="form-style-2">
					<div id="response" style="margin: 0 auto; text-align: center;">
						<div id="divresponse"></div>
					</div>				
					<div class="form-style-2-heading" id="form-style-2-heading">Sign up Your Bar</div>
					<form action="" id="res" method="post" onsubmit="return false;">
						<label for="fname"><span>First name:<span class="required"></span></span><input  type="text" class="input-field" name="fname" value="" /></label>		
						<label for="lname"><span>Last name:<span class="required"></span></span><input  type="text" class="input-field" name="lname" value="" /></label>	
						<label for="baremail"><span>Email:<span class="required"></span></span><input  type="text" class="input-field" name="baremail" value="" /></label>							
						<hr/>
						<label for="barname"><span>Bar name:<span class="required"></span></span><input  type="text" class="input-field" name="barname" value="" /></label>					
						<label for="baraddress"><span>Address:<span class="required"></span></span><input  type="text" class="input-field" name="baraddress" value="" /></label>
						<label for="barstate"><span>State:<span class="required"></span></span>
							<select name="barstate" id="barstate" onchange="lookupCity();" style="width:150px;">
								  <option value="">Select State</option>
								  <option value="AL">Alabama</option>
								  <option value="AK">Alaska</option>
								  <option value="AZ">Arizona</option>
								  <option value="AR">Arkansas</option>
								  <option value="CA">California</option>
								  <option value="CO">Colorado</option>
								  <option value="CT">Connecticut</option>
								  <option value="DE">Delaware</option>
								  <option value="DC">Dist of Columbia</option>
								  <option value="FL">Florida</option>
								  <option value="GA">Georgia</option>
								  <option value="HI">Hawaii</option>
								  <option value="ID">Idaho</option>
								  <option value="IL">Illinois</option>
								  <option value="IN">Indiana</option>
								  <option value="IA">Iowa</option>
								  <option value="KS">Kansas</option>
								  <option value="KY">Kentucky</option>
								  <option value="LA">Louisiana</option>
								  <option value="ME">Maine</option>
								  <option value="MD">Maryland</option>
								  <option value="MA">Massachusetts</option>
								  <option value="MI">Michigan</option>
								  <option value="MN">Minnesota</option>
								  <option value="MS">Mississippi</option>
								  <option value="MO">Missouri</option>
								  <option value="MT">Montana</option>
								  <option value="NE">Nebraska</option>
								  <option value="NV">Nevada</option>
								  <option value="NH">New Hampshire</option>
								  <option value="NJ">New Jersey</option>
								  <option value="NM">New Mexico</option>
								  <option value="NY">New York</option>
								  <option value="NC">North Carolina</option>
								  <option value="ND">North Dakota</option>
								  <option value="OH">Ohio</option>
								  <option value="OK">Oklahoma</option>
								  <option value="OR">Oregon</option>
								  <option value="PA">Pennsylvania</option>
								  <option value="RI">Rhode Island</option>
								  <option value="SC">South Carolina</option>
								  <option value="SD">South Dakota</option>
								  <option value="TN">Tennessee</option>
								  <option value="TX">Texas</option>
								  <option value="UT">Utah</option>
								  <option value="VT">Vermont</option>
								  <option value="VA">Virginia</option>
								  <option value="WA">Washington</option>
								  <option value="WV">West Virginia</option>
								  <option value="WI">Wisconsin</option>
								  <option value="WY">Wyoming</option>								
							</select>
						</label>
						<label for="barcity"><span>City:<span class="required"></span></span>
							<select name="barcity" id="barcity" onchange="lookupZip();" style="width:150px;">
								<option value="">select</option>
							</select>
						</label>
						<label for="barzip"><span>Zip<span class="required"></span></span>
							<select name="barzip" id="barzip" style="width:150px;">
								<option value="">select</option>
							</select>
						</label>	
						
						<label for="barphone"><span>Bar Phone#:<span class="required"></span></span><input  type="text" class="input-field" name="barphone" placeholder="xxx-xxx-xxxx" value=""/></label>						
						<br/>
						<a href="#" class="tap-to-call" id="barRegisterbtn" onclick="barRegister();"><span>Register</span></a>
					</form>				
					<div id="response" style="margin: 0 auto; text-align: center;">
						<div id="div1"></div>
					</div>
				</div>
			
			</section>

			<footer>
				
				<nav>
					
				</nav>
			</footer>

			

		</div>
	<script src="files/jquery.js"></script>
	<script src="files/scripts.js"></script>
	<script src="files/stn.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


</body>
</html>
