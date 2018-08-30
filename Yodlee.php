<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('Config/config.php');

// Data Persistence
if(isset($_SESSION['CobrandInstance']) && !isset($_REQUEST['r']))
{
	$cobrand = unserialize($_SESSION['CobrandInstance']);
	
	
	if(isset($_SESSION['siteCache']) && isset($_POST['mfaLoop']))
	{
		// We would need site persistence only in the case of MFA
		//	So ensure that's the only situation we have it in...
		if (isset($_GET['register']))
			unset($_SESSION['siteCache']);
		else // Need to verify requested site is no different than cached site
			$site = unserialize($_SESSION['siteCache']);
	}
}
else
	$cobrand = new Cobrand_CobrandInstance();


if(isset($_SESSION['UserInstance']) && !isset($_REQUEST['r']))
	$user = unserialize($_SESSION['UserInstance']);
if (isset($_REQUEST['f']) && $_REQUEST['f'] == 'userLogin') {
	$user = new User_UserInstance($cobrand, $_REQUEST['loginName'], $_REQUEST['password']);
}

try
{
	$cobToken = $cobrand->getSessionToken();

	if(isset($_REQUEST['f']) && $_REQUEST['f'] == 'userLogin')
	{
		$user->login($_REQUEST['loginName'], $_REQUEST['password'], $cobToken);

		$userToken = $user->getSessionToken();
	}
	if(isset($_POST['emailAddress']))
	{
		$user = new User_UserInstance($cobrand);
		// By now, any errors should have thrown an exception...
		//	So we're assuming registration succeeded, and continuing.
		$user->register();
		header('Location: index.php');
		
		echo "Registered Successfully! Logging in...";
	}
} catch (Exception $e)
{
	echo '<div class="error">'.$e->getMessage().'</div><br />';
}

//echo "DEBUG<br />COB: " . $cobToken."<br />USR: " . $user->getSessionToken()."\n\n";
//echo "Sites:";

//print_r($user->getAllSites());

	
