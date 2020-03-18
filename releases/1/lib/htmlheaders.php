<meta http-equiv="Content-Security-Policy" content="script-src 'nonce-9s0c8as0xz', style-src 'nonce-9s0c8as0xz'">
<style type="text/css" nonce="9s0c8as0xz"><?php
	if(file_exists('theme/theme.min.css')) // local minified
		include('theme/theme.min.css');
	elseif(file_exists('theme/theme.css')) // local
		include('theme/theme.css');
	elseif(file_exists($appImage['address'] . '/theme/theme.min.css')) // appImage minified
		include($appImage['address'] . '/theme/theme.min.css');
	else // appImage
		include($appImage['address'] . '/theme/theme.css');
?></style>
<script type="text/javascript" nonce="9s0c8as0xz"><?php
	if(file_exists('js/scripts.php')) // local
		include('js/scripts.php');
	else // appImage
		include($appImage['address'] . '/js/scripts.php');
?></script>