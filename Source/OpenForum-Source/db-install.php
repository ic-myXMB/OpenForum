<?php
/*
OpenForum - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
DB Install
This is the db-install.php
*/

// do install

function install_dbs() {

 // include the config file

 require "config/connect.php";	

 // do connect doDB func

 doDB();

 global $mysqli;

 //  now query table

 // verify a table exists or not

 $verify_sql = "SHOW TABLES LIKE 'forum_topics'";

 // verify result

 $verify_result = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

   // verify result returns exists

   if (mysqli_num_rows($verify_result) == 1) {

    // result returns table does exist

    // echo does exist

    	echo "<div style=\"background-color:#DDFFDD;border:1px solid #4CAF50;color:#4CAF50;margin-bottom:15px;padding:10px;border-radius:3px;\"><h1 style=\"padding-left:10px;\">DB TABLE DOES EXIST</h1></div>";

    // echo table exists alert

    	table_installed();

    // echo db not installed alert

    	dbs_not_installed();

   }

      else {

      // verify result returns does not exist

      	if (mysqli_num_rows($verify_result) < 1) {

      	// result returns table does not exist

      	// echo does not exist

      		echo "<div style=\"background-color:#FFDDDD;border:1px solid #F44336;color:#F44336;margin-bottom:15px;padding:10px;border-radius:3px;\"><h1 style=\"padding-left:10px;\">DB TABLE DOESN'T EXIST</h1></div>";

      	// echo table does not exist alert

      		table_not_installed();

        // get the db sql file

      		$sql = file_get_contents('sql/db.sql');

      	// execute multi query

      		mysqli_multi_query($mysqli, $sql);

      	// echo database installing alert

      		dbs_installed();

      }

   }

}

// table is installing alert

function table_not_installed() {

   // table installing message

   $_SESSION['message4'] = '<div style="background-color:#46A7F5;color:#FFFFFF;text-shadow: 2px 2px 4px #000000;border: 1px solid #0C83E2;opacity:0.83;transition:opacity 0.6s;margin-bottom:15px;padding:20px;border-radius:3px;">Table is not installed! So, installing.</div> ';

   if (isset($_SESSION['message4'])) {
   
     // echo message

     	echo $_SESSION['message4'];
   
     // unset

     	unset($_SESSION['message4']);

   }
}

// table is already installed alert

function table_installed() {

   // table not installing message

   $_SESSION['message3'] = '<div style="background-color:#FFA92A;color:#FFFFFF;text-shadow: 2px 2px 4px #000000;border: 1px solid #FF9800;opacity:0.83;transition:opacity 0.6s;margin-bottom:15px;padding:20px;border-radius:3px;">Table was already installed! So, not installing.</div> ';

   if (isset($_SESSION['message3'])) {
   
     // echo message

     	echo $_SESSION['message3'];
   
     // unset

     	unset($_SESSION['message3']);

   }
}

// database is already installed alert

function dbs_not_installed() {

   // database not installing message

   $_SESSION['message2'] = '<div style="background-color:#F56257;color:#FFFFFF;text-shadow: 2px 2px 4px #000000;border: 1px solid #F1392B;opacity:0.83;transition:opacity 0.6s;margin-bottom:15px;padding:20px;border-radius:3px;">Database was already installed! You can now visit: <a href="index.php" style="color:#FFFFFF;text-shadow: 2px 2px 4px #000000;">OpenForum</a> to begin.</div> ';

   if (isset($_SESSION['message2'])) {
   
     // echo message

     	echo $_SESSION['message2'];
   
     // unset

     	unset($_SESSION['message2']);

   }
}

// database is installing alert

function dbs_installed() {

   // database is installed message

   $_SESSION['message1'] = '<div style="background-color:#04AA6D;color:#FFFFFF;text-shadow: 2px 2px 4px #000000;border: 1px solid #025F3D;opacity:0.83;transition:opacity 0.6s;margin-bottom:15px;padding:20px;border-radius:3px;">Database is installed! You can now visit: <a href="index.php" style="color:#FFFFFF;text-shadow: 2px 2px 4px #000000;">OpenForum</a> to begin.</div> ';

   if (isset($_SESSION['message1'])) {
   
     // echo message

     	echo $_SESSION['message1'];
   
     // unset

     	unset($_SESSION['message1']);

   }
}

	    // echo the page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<title>Install Databse</title>
		</head>
		<body>
		<h1>Installation</h1>
        <p>Details about the db install process:</p> 
        <h2>Database Information...</h2>";

        // function install db
        
        install_dbs(); 

		echo"
		</body>
		</html>";

?>
