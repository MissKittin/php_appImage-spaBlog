<?php
	// grab all scripts and push them to html inline script

	// check if is unpacked
	if(!isset($appImage))
		$appImage['address']=null;

	// default set
	$script['fjson']=$appImage['address'] . '/lib/fjson.js';
	$script['spa']=$appImage['address'] . '/lib/spaBlog.js';
	$script['spaSettings']=$appImage['address'] . '/js/spaSettings.js';
	$script['local']=$appImage['address'] . '/js/local.js';

	// default minified set
	if(file_exists($appImage['address'] . '/lib/fjson.min.js'))
		$script['fjson']=$appImage['address'] . '/lib/fjson.min.js';
	if(file_exists($appImage['address'] . '/lib/spaBlog.min.js'))
		$script['spa']=$appImage['address'] . '/lib/spaBlog.min.js';
	if(file_exists($appImage['address'] . '/js/local.min.js'))
		$script['local']=$appImage['address'] . '/js/local.min.js';

	// local set
	if(file_exists('lib/fjson.js'))
		$script['fjson']='lib/fjson.js';
	if(file_exists('lib/spaBlog.js'))
		$script['spa']='lib/spaBlog.js';
	if(file_exists('js/local.js'))
		$script['local']='js/local.js';
	if(file_exists('js/spaSettings.js'))
		$script['spaSettings']='js/spaSettings.js';

	// local minified set
	if(file_exists('lib/fjson.min.js'))
		$script['fjson']='lib/fjson.min.js';
	if(file_exists('lib/spaBlog.min.js'))
		$script['spa']='lib/spaBlog.min.js';
	if(file_exists('js/local.min.js'))
		$script['local']='js/local.min.js';

	// queue
	$scripts=[
		$script['fjson'],
		$script['spaSettings'],
		$script['spa'],
		$script['local']
	];

	foreach($scripts as $fscript)
		if($fscript === $script['spaSettings'])
			echo str_replace(PHP_EOL, '', file_get_contents($fscript)); // minify spaSettings
		else
			echo file_get_contents($fscript);
?>