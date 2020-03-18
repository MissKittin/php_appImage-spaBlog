<?php
	// PHP appImage - library

	// Settings
	$appImage['router']['path']='';
	$appImage['release']='1';
	$appImage['archiveType']='tar.bz2';

	// Generate image address
	$appImage['path']=$_SERVER['DOCUMENT_ROOT'] . $appImage['router']['path'];
	$appImage['address']='phar://' . $appImage['path'] . '/releases/' . $appImage['release'] . '.' . $appImage['archiveType'];

	// check if image exists
	if(!file_exists($appImage['address']))
	{
		include('lib/500.php');
		exit();
	}
?>