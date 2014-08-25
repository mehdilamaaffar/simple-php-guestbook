<?php

function autoloader($class_name)
{
	$file = 'inc/' . $class_name . '.php';
	if ( file_exists($file) && is_file($file) )
	{
		require_once $file;
	}
}

spl_autoload_register('autoloader');

?>