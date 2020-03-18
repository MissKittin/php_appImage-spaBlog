<?php
	// check if is unpacked
	if(!isset($appImage))
		$appImage['address']=null;

	// import database
	if(file_exists('db.php'))
		include('db.php'); // if unpacked
	elseif(file_exists('api/db.php'))
		include('api/db.php'); // if no database defined in local
	else
		include($appImage['address'] . '/api/db.php'); // import local

	// send header
	header('Content-Type: application/json');

	// ?title
	if(isset($_GET['title']))
		echo json_encode($title);

	// ?header
	if(isset($_GET['header']))
		echo json_encode($header);

	// ?articles
	if(isset($_GET['articles']))
	{
		$articles=array_reverse($articles); // reverse pages
		$page=json_decode(file_get_contents('php://input'), true);
		echo json_encode(array_reverse($articles[$page['page']-1])); // reverse posts
	}

	// ?pages
	if(isset($_GET['pages']))
		echo json_encode(count($articles));
?>