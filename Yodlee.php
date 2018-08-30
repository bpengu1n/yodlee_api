<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Config/config.php');

// Data Persistence
if(isset($_SESSION['CobrandInstance']) && !isset($_GET['r']))
{
	$cobrand = unserialize($_SESSION['CobrandInstance']);
}
else
	$cobrand = new Cobrand_CobrandInstance();

if(isset($_SESSION['UserInstance']) && !isset($_GET['r']))
	$user = unserialize($_SESSION['UserInstance']);
if (isset($_GET['f']) && $_GET['f'] == 'userLogin') {
	$user = new User_UserInstance($cobrand);
}

try
{
	$cobToken = $cobrand->getSessionToken();

	if(isset($_GET['f']) && $_GET['f'] == 'userLogin')
	{
		$user->login($_GET['user'], $_GET['pass'], $cobToken);

		$userToken = $user->getSessionToken();
	}
} catch (Exception $e)
{
	echo $e->getMessage()."\n\n";
	die();
}

// Store data 
$_SESSION['CobrandInstance'] 	= serialize($cobrand);
if (isset($user))
	$_SESSION['UserInstance']		= serialize($user);

//echo $cobrand->getContext();