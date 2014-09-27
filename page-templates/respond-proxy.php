<?php
/*
Template Name: Respond Proxy
*/
?>
<!-- Respond.js: min/max-width media query polyfill. Remote proxy (c) Scott Jehl. MIT/GPLv2 Lic. j.mp/respondjs -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Respond JS Proxy</title>
</head> 
<body>
	<script>
		(function () {
			var domain, css, query, getQueryString, ajax, xmlHttp;

			/*
				http://stackoverflow.com/questions/4963673/get-url-array-variables-in-javascript-jquery/4963817#4963817
			*/
			getQueryString = function() {
				var ret = {}, parts, i, p;

				parts = (document.location.toString().split("?")[1]).split("&");

				for (i = 0; i < parts.length; i++) {

					p = parts[i].split("=");
					// so strings will be correctly parsed:
					p[1] = decodeURIComponent(p[1].replace(/\+/g, " "));

					if (p[0].search(/\[\]/) >= 0) { // then it"s an array
						p[0] = p[0].replace("[]", "");

						if (typeof ret[p[0]] != "object") {
							ret[p[0]] = [];
						}
						ret[p[0]].push(p[1]);
					} else {
						ret[p[0]] = p[1];
					}
				}
				return ret;
			};

			ajax = function( url, callback ) {
				var req = xmlHttp();
				if (!req){
					return;
				}
				req.open( "GET", url, true );
				req.onreadystatechange = function () {
					if ( req.readyState != 4 || req.status != 200 && req.status != 304 ){
						return;
					}
					callback( req.responseText );
				};
				if ( req.readyState == 4 ){
					return;
				}
				req.send();
			};

			//define ajax obj 
			xmlHttp = (function() {
				var xmlhttpmethod = false,
					attempts = [
						function(){ return new XMLHttpRequest(); },
						function(){ return new ActiveXObject("Microsoft.XMLHTTP"); },
						function(){ return new ActiveXObject("MSXML2.XMLHTTP.3.0"); }
					],
					al = attempts.length;

				while( al-- ){
					try {
						xmlhttpmethod = attempts[ al ]();
					}
					catch(e) {
						continue;
					}
					break;
				}
				return function(){
					return xmlhttpmethod;
				};
			})();

			query = getQueryString();
			css = query["css"];
			domain = query["url"];

			if (css && domain) {
				ajax(css, function (response) {
					window.name = response;
					window.location.href = domain;
				});
			}
		}());
	</script>
</body>
</html>