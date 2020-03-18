// SPA Blog template
// Settings:
//	var spaBlog_apiUrl		-> url to api
//	var headerDiv 			-> id of div with header
//	var articlesDiv 		-> id of div with articles
//	var pagesDiv			-> id of div with page switches
//	var spaBlog_connectionErrorLabel

// minified:
// function spaBlog_printConnectionError(){console.log(spaBlog_connectionErrorLabel)}function spaBlog_getTitle(e){getJSON(e+"?title","get",function(e,n){null==e&&(window.document.title=n)},null)}function spaBlog_getHeader(t,e){getJSON(e+"?header","get",function(e,n){null==e?document.getElementById(t).innerHTML=n:spaBlog_printConnectionError()},null)}function spaBlog_getArticles(i,e,n){getJSON(n+"?articles","post",function(e,n){if(null==e){var t=document.getElementById(i);t.innerHTML="",n.forEach(function(e){t.innerHTML=t.innerHTML+'<div class="article">'+e+"</div>"})}else spaBlog_printConnectionError()},'{"page":'+e+"}")}function spaBlog_getPages(l,e,o){getJSON(e+"?pages","get",function(e,n){if(null==e){var t=document.getElementById(l);t.innerHTML="";for(var i=1;i<=n;i++)t.innerHTML=t.innerHTML+'<a href="#!p='+i+'">'+i+"</a>"}else spaBlog_printConnectionError();o()},null)}function spaBlog_init(){spaBlog_getTitle(spaBlog_apiUrl),spaBlog_getHeader(headerDiv,spaBlog_apiUrl),window.location.hash?spaBlog_getArticles(articlesDiv,window.location.hash.substring(4),spaBlog_apiUrl):spaBlog_getArticles(articlesDiv,1,spaBlog_apiUrl),spaBlog_getPages(pagesDiv,spaBlog_apiUrl,function(){for(var e=document.getElementById(pagesDiv).getElementsByTagName("a"),n=0;n<e.length;n++)e[n].addEventListener("click",function(){spaBlog_getArticles(articlesDiv,this.hash.substring(4),spaBlog_apiUrl)})})}
// minifier: https://jscompress.com/

// used in getArticles() and getPages()
function spaBlog_printConnectionError()
{
	console.log(spaBlog_connectionErrorLabel);
}

// send/receive to/from backend
function spaBlog_getTitle(url)
{
	getJSON(url + '?title', 'get', function(err, response){
		if(err == null)
			window.document.title=response;
	}, null);
}
function spaBlog_getHeader(id, url)
{
	getJSON(url + '?header', 'get', function(err, response){
		if(err == null)
			document.getElementById(id).innerHTML=response;
		else
			spaBlog_printConnectionError();
	}, null);
}
function spaBlog_getArticles(id, page, url)
{
	var data='{"page":' + page + '}';
	getJSON(url + '?articles', 'post', function(err, response){
		if(err == null)
		{
			var idelement=document.getElementById(id);
			idelement.innerHTML='';
			response.forEach(function(article){
				idelement.innerHTML=idelement.innerHTML + '<div class="article">' + article + '</div>';
			});
		}
		else
			spaBlog_printConnectionError();
	}, data);
}
function spaBlog_getPages(id, url, getPagesCallback)
{
	getJSON(url + '?pages', 'get', function(err, response){
		if(err == null)
		{
			var idelement=document.getElementById(id);
			idelement.innerHTML='';
			for(var i=1; i<=response; i++)
				idelement.innerHTML=idelement.innerHTML + '<a href="#!p=' + i + '">' + i + '</a>'; //  onclick="getArticles(articlesDiv, ' + i + ')"
		}
		else
			spaBlog_printConnectionError();
		getPagesCallback();
	}, null);
}

// main function
function spaBlog_init(){
	spaBlog_getTitle(spaBlog_apiUrl);
	spaBlog_getHeader(headerDiv, spaBlog_apiUrl);
	// choose page
	if(window.location.hash)
		spaBlog_getArticles(articlesDiv, window.location.hash.substring(4), spaBlog_apiUrl);
	else
		spaBlog_getArticles(articlesDiv, 1, spaBlog_apiUrl);
	// get page switches from backend
	spaBlog_getPages(pagesDiv,spaBlog_apiUrl,  function(){
		// assign onclick function for each switch
		var elements=document.getElementById(pagesDiv).getElementsByTagName('a');
		for(var i=0; i<elements.length; i++)
			elements[i].addEventListener('click', function(){
				spaBlog_getArticles(articlesDiv, this.hash.substring(4), spaBlog_apiUrl);
			});
	});
}