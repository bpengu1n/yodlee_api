<?php
// Enable Error Reporting

// Initiate the session
session_start();

// General REST Info
define('REST_SERVER_URL', 'https://rest.developer.yodlee.com/services/srest/restserver/v1.0/');

// Cobrand Info
define('COBRAND_ID', 		'[INSERT_COBRAND_ID]');
define('COBRAND_APP_ID', 	'[INSERT_APP_ID]');
define('COBRAND_USER',		'[INSERT_USERNAME]');
define('COBRAND_PASSWORD',	'[INSERT_PASSWORD]');
define('COBRAND_TIMEOUT',	90*60*1000); 			//90min
define('USER_TIMEOUT',		90*60*1000); 			//90min


// Autoload setup/registration
function autoloader_api_files($class_path)
{
	$class_path = str_replace('_', '/', $class_path);
	require_once($class_path . '.php');
}
spl_autoload_register('autoloader_api_files');

// REST API Call
function do_rest_call($ch, $url, $data)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);

	return json_decode($response);
}
