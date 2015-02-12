<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Pub Sleuth - Bar Management</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" type="text/css" href="files/main.css">
		<link rel="stylesheet" type="text/css" href="files/stncss.css">
		<link rel="stylesheet" type="text/css" href="files/stncss.css">	


	</head>

	<body onload="BarInfo('load');">
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
					<div id="addinventory" style="margin: 0 auto; text-align: center;">
					<div class="form-style-2-heading" id="form-style-2-heading">Add Beers To Inventory:</div>
					<div class="form-style-2" id="form-style-2">
						<form id="inventory" onsubmit="return false;">
								<br/>
								<label for="field2"><span style="padding: 2px;">Beer/Brewery: <span class="required"></span></span><input type="text" class="input-field" name="beersearch" id="beersearch" value="" /></label>
								<br/>
								<button id="searchBeerBtn" onclick="searchBeers();">Search</button>
								<br/>
								<label for="field3"><span id="beerresults" class="spanclass">Results: 0<span class="required"></span></span>
									<br/><select style="width: 300px;" name="beerList[]" id="beerList" size="5" multiple="multiple">
									</select>
								</label>								
								<br>
								<label for="beertype"><span id="beertype">Type:<span class="required"></span></span>
									<select name="beertype" id="beertype" style="width:150px; padding: 2px; margin-top: 5px;">
										<option value="bottle">Bottle</option>
										<option value="draft">Draft</option>
									</select>
								</label>
								<button onclick="BarInfo('update');">Add</button>
						</form>
					</div>
					</div>				
					<br/><br/>
					<div id="response" style="margin: 0 auto; text-align: center;">
						<div class="form-style-2-heading" id="form-style-2-heading">Remove Beers From Inventory:</div>
						<div id="divresponse"></div>
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
