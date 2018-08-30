<?php
// Needed includes
require_once('constants.php');

// Initiate the session
session_start();

// General REST Info
define('BASE_SERVER_URL', 'https://consolidatedsdk.yodlee.com/yodsoap/srest/[ACCOUNT_NAME]/v1.0/');
define('EXTD_SERVER_URL', BASE_SERVER_URL.'jsonsdk');

// Cobrand Info

define('COBRAND_ID', 		'[INSERT_COBRAND_ID]');
define('COBRAND_APP_ID', 	'[INSERT_APP_ID]');
define('COBRAND_USER',		'[INSERT_USERNAME]');
define('COBRAND_PASSWORD',	'[INSERT_PASSWORD]');
define('COBRAND_TIMEOUT',	90*60*1000); 			//90min
define('USER_TIMEOUT',		90*60*1000); 			//90min
define('YODLEE_API_PATH',	'/ABS/PATH/TO/YodleeAPI');
$prevPath = ini_get('include_path');
//set_include_path(ini_get('include_path').';'.YODLEE_API_PATH);
set_include_path(YODLEE_API_PATH);

// Autoload setup/registration
function autoloader_api_files($class_path)
{
	$class_path = str_replace('_', '/', $class_path);
	require_once($class_path . '.php');
}
spl_autoload_register('autoloader_api_files');
