<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Pub Sleuth - Bar Management</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<link rel="stylesheet" type="text/css" href="files/main.css">
		<link rel="stylesheet" type="text/css" href="files/stncss.css">
		<link rel="stylesheet" type="text/css" href="files/stncss.css">	


	</head>

	<body onload="checkCookie();">
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
					<div class="form-style-2-heading" id="form-style-2-heading">Account login:</div>
					<div class="form-style-2" id="form-style-2">
						<form id="loginForm" onsubmit="return false;">
								<br/>
								<label for="username"><span style="padding: 2px;">Username: <span class="required"></span></span><input type="text" class="input-field" name="username" id="username" value="" /></label>
								<label for="password"><span style="padding: 2px;">Password: <span class="required"></span></span><input type="text" class="input-field" name="password" id="password" value="" /></label>

								<button onclick="checkLogin('bar');">Add</button>
						</form>
					</div>
					</div>				
					<br/><br/>
					<div id="response" style="margin: 0 auto; text-align: center;">
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
