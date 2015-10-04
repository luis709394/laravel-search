<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = urldecode($uri);

$paths = require __DIR__.'/bootstrap/paths.php';

$requested = $paths['public'].$uri;

<<<<<<< HEAD
// This file  allows us to emulate Apache's "mod_rewrite" functionality from the
// uilt-in  web server. This provides a convenient way to test a Laravel
=======
// Ths file  allows us to emulate Apache's "mod_rewrite" functionality from the
// uilt-in PHP  server. This provides a convenient way to test a Laravel
>>>>>>> 527d5cd43454826216a84151539e0a8afca086d3
// application without having installed a "real" web server software here.
if ($uri !== '/' and file_exists($requested))
{
	return false;
}

require_once $paths['public'].'/index.php';
