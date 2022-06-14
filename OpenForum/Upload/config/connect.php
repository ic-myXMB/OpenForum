<?php
/*
OpenForum
DB Connect
This is the connect.php
*/

// display errors if needed

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// set up a db connection

function doDB() {

	global $mysqli;

	// connect to server and select database

	// edit DBuserName, DBuserPassword, DBdatabaseName to reflect your details

	$mysqli = mysqli_connect("localhost", "DBuserName", "DBuserPassword", "DBdatabaseName");

	// if connection fails, stop script execution

	if (mysqli_connect_errno()) {
		
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
}

?>
