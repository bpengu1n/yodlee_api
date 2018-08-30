<?php
// Initiate the session
session_start();

// General SOAP Info
define('SOAP_SERVER_URL', 'https://consolidatedsdk.yodlee.com/yodsoap/services');

// Cobrand Info
define('COBRAND_ID', 		'[INSERT_COBRAND_ID]');
define('COBRAND_APP_ID', 	'[INSERT_APP_ID]');
define('COBRAND_USER',		'[INSERT_USERNAME]');
define('COBRAND_PASSWORD',	'[INSERT_PASSWORD]');
define('COBRAND_TIMEOUT',	180000); 			//180ms


// Autoload setup/registration
function autoloader_api_files($class_path)
{
	$class_path = str_replace('_', '/', $class_path);
	require_once($class_path . '.php');
}
spl_autoload_register('autoloader_api_files');
