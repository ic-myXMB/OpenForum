<?php
/*
OpenForum - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
Connection
This is the connect.php
*/

// display errors if needed

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// set up a db connection

function doDB() {

	global $mysqli;

	// connect to server and select database

	$mysqli = mysqli_connect("localhost", "testUser", "testPassword", "testDB");

	// if connection fails, stop script execution

	if (mysqli_connect_errno()) {

		printf("Connect failed: %s\n", mysqli_connect_error());
		
		exit();

	}
}

?>
