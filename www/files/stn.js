function openDiv(one,two,three) {
    document.getElementById(one.id).style.display = 'none';
    document.getElementById(two).style.display = 'block';
	document.getElementById(three).style.display = 'block';
}

function closeDiv(one,two,three) {
    document.getElementById(one.id).style.display = 'none'
    document.getElementById(two).style.display = 'block';
	document.getElementById(three).style.display = 'none';
}



$(function(){
	$("#beersearch").keyup(function(event){
		if(event.which == 13){
			document.getElementById('searchBeerBtn').disabled = true;
			searchBeers();

			var mySplitResult = myString.split(" ");

			for(i = 0; i < mySplitResult.length; i++){
				document.write("<br /> Element " + i + " = " + mySplitResult[i]); 
			}
		}
		else{
			document.getElementById('searchBeerBtn').disabled = false;
		}
	})
});


function searchBeers(){

	//First clear all values in the results drop down
	removeOptions(document.getElementById('beerList'));	
	
	//make ajax call to beersearch.php
	var str = $('#beersearch').val();
	str = 'search=' + str;

	$.ajax({
		type: "POST",
		url: "http://sndtracking.net/dev/bar_finder/beersearch.php",
		dataType: "text",
		cache: false,
		data: str,
		success: function(data){
			//$("#beerresponse").html(data);
			//alert(data);
			//data = "Miller|Miller Lite||Becks|Becks Lite";
			var mysplit = data.split("||");
			
			$("#beerresults").html(mysplit[0]);
			for(i = 1; i < mysplit.length; i++){

				//split brewery and beer name apart
				var mysplit2 = mysplit[i].split("|");
				
				select = document.getElementById('beerList');
				var opt = document.createElement('option');
				opt.value = mysplit2[0];
				opt.innerHTML = mysplit2[1] + ' - ' + mysplit2[2];
				select.appendChild(opt);				
			}			
		},
		error: function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} else if (jqXHR.status == 404) {
				alert('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				alert('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				alert('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				alert('Time out error.');
			} else if (exception === 'abort') {
				alert('Ajax request aborted.');
			} else {
				alert('Uncaught Error.\n' + jqXHR.responseText);
			}
		}				
	}) 

	
}


function removeOptions(selectbox)
{
	
    var i;
    for(i=selectbox.options.length-1;i>=0;i--)
    {
        selectbox.remove(i);
    }
}


/*Area for bar signup page */
function lookupCity(){
	//find cities that are in the state selected
	//First clear all values in the results drop down
	removeOptions(document.getElementById('barcity'));	
	
	//make ajax call to beersearch.php
	var str = $('#barstate').val();
	str = 'search=' + str;
	//alert(str);
	$.ajax({
		type: "POST",
		url: "http://sndtracking.net/dev/bar_finder/cityzip.php",
		dataType: "text",
		cache: false,
		data: str,
		success: function(data){
			select = document.getElementById('barcity');
			var opt = document.createElement('option');
			opt.value = '';
			opt.innerHTML = 'select';
			select.appendChild(opt);			
		
			var mysplit = data.split("||");
			for(i = 0; i < mysplit.length; i++){			
				select = document.getElementById('barcity');
				var opt = document.createElement('option');
				opt.value = mysplit[i];
				opt.innerHTML = mysplit[i];
				select.appendChild(opt);				
			}
			
		},
		error: function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} else if (jqXHR.status == 404) {
				alert('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				alert('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				alert('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				alert('Time out error.');
			} else if (exception === 'abort') {
				alert('Ajax request aborted.');
			} else {
				alert('Uncaught Error.\n' + jqXHR.responseText);
			}
		}				
	}) 
	

}

function lookupZip(){
	//find cities that are in the state selected
	//First clear all values in the results drop down
	removeOptions(document.getElementById('barzip'));	
	
	var str = '';
	var str1 = $('#barstate').val();
	var str2 = $('#barcity').val();
	str = 'search=city';
	str = str + '&state=' + str1;
	str = str + '&city=' + str2;
	
	//alert(str);
	$.ajax({
		type: "POST",
		url: "http://sndtracking.net/dev/bar_finder/cityzip.php",
		dataType: "text",
		cache: false,
		data: str,
		success: function(data){
			//alert(data);
			//$("#div1").html(data);
			
			//check if only 1 result
			var n = data.indexOf("||"); 
			if (n == 0){
				//check for no result
				n = data.indexOf("no results");
				if (n == 0){
					//append || to end of data so it can be split.
					data = data + '||';
				}
			}			
			
			var mysplit = data.split("||");
			for(i = 0; i < mysplit.length; i++){			
				select = document.getElementById('barzip');
				var opt = document.createElement('option');
				opt.value = mysplit[i];
				opt.innerHTML = mysplit[i];
				select.appendChild(opt);				
			}
			
		},
		error: function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} else if (jqXHR.status == 404) {
				alert('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				alert('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				alert('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				alert('Time out error.');
			} else if (exception === 'abort') {
				alert('Ajax request aborted.');
			} else {
				alert('Uncaught Error.\n' + jqXHR.responseText);
			}
		}				
	}) 
	

}


function barRegister(){
	//barRegisterbtn
	var str = '&type=bar';
	var str2 = $("#res").serialize();
	str2 = str2 + str;
	$.ajax({
		type: "POST",
		url: "http://sndtracking.net/dev/bar_finder/signup_submit.php",
		dataType: "text",
		cache: false,
		data: str2,
		success: function(data){
			alert(data);
			$("#div1").html(data);
		},
		error: function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} else if (jqXHR.status == 404) {
				alert('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				alert('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				alert('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				alert('Time out error.');
			} else if (exception === 'abort') {
				alert('Ajax request aborted.');
			} else {
				alert('Uncaught Error.\n' + jqXHR.responseText);
			}
		}				
	}) 	
	
}


function isPhonegap(){
	var app = document.URL.indexOf( 'http://' ) === -1 && document.URL.indexOf( 'https://' ) === -1;
	if ( app ) {
		//alert('phonegap');
		return true;
	} else {
		//alert('not phone gap app');
		return false;
	} 
}

/* Bar inventory management */
function barManageLoad(){
	if (isPhonegap())
		document.addEventListener("deviceready", BarInfo('load'), false);
	else
		BarInfo('load');
}

function BarInfo(type){
	
	//Replace these values with the values saved from local storage
	var username = getCookie("username");
	var session = getCookie("session");

	var device = '';
	if (isPhonegap()){
		var deviceID = device.uuid;
		device = deviceID;
	}
	else
		device = 'computer';	
	
	
	var str = "type=" + type;
	var str = str + "&username=" + username + "&session=" + session + '&device=' + device;
	if (type == 'update'){
		str = $("#inventory").serialize() + '&' + str;
	}
	if ((type != 'update') && (type != 'load')){
		var mysplit = type.split(",");
		str = "type=delete&barid=" + mysplit[0] + "&beerid=" + mysplit[1] + "&type=" + mysplit[2] + "&username=" + username + "&session=" + session;
	}
	//alert(str);
	$.ajax({
		type: "POST",
		url: "http://sndtracking.net/dev/bar_finder/ajax/barinfo.php",
		dataType: "text",
		cache: false,
		data: str,
		success: function(data){
			//alert('Response: ' + data);
			var mysplit = data.split("||");
			if (mysplit[0] == 'Failed'){
				//clear cookies and redirect to login
				deleteCookies();
			}
			else{
				$("#divresponse").html(data);
			}
		},
		error: function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} else if (jqXHR.status == 404) {
				alert('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				alert('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				alert('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				alert('Time out error.');
			} else if (exception === 'abort') {
				alert('Ajax request aborted.');
			} else {
				alert('Uncaught Error.\n' + jqXHR.responseText);
			}
		}				
	}) 

}

//Login Stuff
function loginLoad(redir){
	if (isPhonegap())
		document.addEventListener("deviceready", checkCookie(redir), false);
	else
		checkCookie(redir);
}
function checkLogin(type){

	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var device = '';
	if (isPhonegap()){
		var deviceID = device.uuid;
		device = deviceID;
	}
	else
		device = 'computer';
	var str = "type=" + type;
	str = str + '&username=' + username + '&password=' + password + '&device=' + device;
	
	$.ajax({
		type: "POST",
		url: "http://sndtracking.net/dev/bar_finder/ajax/checklogin.php",
		dataType: "text",
		cache: false,
		data: str,
		success: function(data){
			//alert('Response: ' + data);
			//Data should return sucess|sessionid;
			var mysplit = data.split("|");
			if (mysplit[0] == 'Success'){
				setCookie('session', mysplit[1], 5);
				setCookie('username', username, 5);
				window.location.href = "manage_bar.html";
			}
		},
		error: function (jqXHR, exception) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} else if (jqXHR.status == 404) {
				alert('Requested page not found. [404]');
			} else if (jqXHR.status == 500) {
				alert('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
				alert('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
				alert('Time out error.');
			} else if (exception === 'abort') {
				alert('Ajax request aborted.');
			} else {
				alert('Uncaught Error.\n' + jqXHR.responseText);
			}
		}				
	}) 	

}


//Cookie Handling
function setCookie(cname, cvalue, exdays) {
	if (isPhonegap()){
		//write local stoare
		window.localStorage.setItem(cname, cvalue);
	}
	else{
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}
} 

function deleteCookies(){
	if (isPhonegap()){
		window.localStorage.setItem('username', '');
		window.localStorage.setItem('session', '');
	}
	else{
		document.cookie = 'session' + '=; Path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
		document.cookie = 'username' + '=; Path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';	
	}
}

function checkCookie(redir) {
    var username=getCookie("session");
    if (username!="") {
        //alert("Welcome again " + username);
		if (redir == true)
			window.location.href = "manage_bar.html";
		else{
			$("#logindiv").html('Set: ' + username);
		}
    }else{
		//alert('Not logged in');
		$("#logindiv").html('None:');
    }
} 

function getCookie(cname) {

	if(isPhonegap()){
		//get local storage
		var value = window.localStorage.getItem(cname);
		if (value === null)
			value = "";
		return value;
	}
	else{
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
	}
	return "";
} 
//End cookie handling