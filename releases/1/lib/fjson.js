// get/send JSON library

// usage:
//	getJSON('/url', 'post'|'get', function(err, response){
//		if(err == null)
//			console.log(response);
//		else
//			console.log(err);
//	}, '{"json":"data"}'|null);

// minified:
// var getJSON=function(n,e,o,s){var t=new XMLHttpRequest;t.open(e,n,!0),t.responseType="json",t.onload=function(){var n=t.status;200==n?o(null,t.response):o(n)},t.onerror=function(n){o(n)},t.send(s)};
// minifier: https://jscompress.com/

var getJSON=function(url, method, callback, data)
{
	var xhr=new XMLHttpRequest();
	xhr.open(method, url, true);
	xhr.responseType='json';
	xhr.onload=function() // send response or error to callback function
	{
		var status=xhr.status;
		if(status == 200)
			callback(null, xhr.response);
		else
			callback(status);
	};
	xhr.onerror=function(e){ callback(e);}; // catch network error
	xhr.send(data);
};