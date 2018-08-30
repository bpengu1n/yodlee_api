<?php

require_once('Config/config.php');

// Data Persistence/Creation
if(isset($_SESSION['CobrandInstance']))
	$cobrand = unserialize($_SESSION['CobrandInstance']);
else
	$cobrand = new Cobrand_CobrandInstance();
if(isset($_SESSION['UserInstance']))
	$user = unserialize($_SESSION['UserInstance']);

if($_GET['f'] == 'userLogin')
{
	echo "login Procedure";
}

$_SESSION['CobrandInstance'] = serialize($cobrand);

echo $cobrand->getContext();