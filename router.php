<?php
	// PHP appImage - main

	// quiet
	error_reporting(E_ERROR | E_PARSE);

	// import library
	include('lib/appImage.php');

	// chdir
	chdir($appImage['path']);

	// cache
	$appImage['router']['strtok']=strtok($_SERVER['REQUEST_URI'], '?');
	$appImage['router']['str_replace']=str_replace($appImage['router']['path'], '', $appImage['router']['strtok']);

	// hide router
	$appImage['router']['filename']=array_reverse(explode('/', $appImage['router']['strtok']));
	if($appImage['router']['filename'][0] === 'router.php')
	{
		include('lib/404.php');
		exit();
	}

	// hide library
	if($appImage['router']['filename'][0] === 'appImage.php')
	{
		include('lib/404.php');
		exit();
	}

	// hide releases
	if($appImage['router']['filename'][1] === 'releases')
	{
		include('lib/404.php');
		exit();
	}

	// add file name
	if(strpos($appImage['router']['filename'][0], '.') !== false)
		$appImage['router']['filename']='';
	else
		$appImage['router']['filename']='/index.php';

	// choose file from local or from package
	if(file_exists($appImage['path'] . $appImage['router']['strtok'] . $appImage['router']['filename']))
		return false; // do normal job
	else
	{
		// go to image
		if(!file_get_contents($appImage['address'] . $appImage['router']['str_replace'] . $appImage['router']['filename']))
		{
			include('lib/404.php');
			exit();
		}
		// if isn't php
		if(pathinfo($appImage['address'] . $appImage['router']['str_replace'] . $appImage['router']['filename'])['extension'] !== 'php')
		{
			// file headers
			header('Content-type: ' . mime_content_type($appImage['address'] . $appImage['router']['str_replace'] . $appImage['router']['filename']));
			header('Content-length: ' . filesize($appImage['address'] . $appImage['router']['str_replace'] . $appImage['router']['filename']));

			// cache headers
			header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
			header('Pragma: cache');
			header('Cache-Control: max-age=3600');

			// stream file
			while(ob_get_level()) ob_end_clean(); // clear buffer
			readfile($appImage['address'] . $appImage['router']['str_replace'] . $appImage['router']['filename']);
			exit();
		}
		else
			include($appImage['address'] . $appImage['router']['str_replace'] . $appImage['router']['filename']); // include script from image
	}
?>