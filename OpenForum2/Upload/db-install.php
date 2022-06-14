<?php
/*
OpenForum - A basic open forum
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

 $verify_sql = "SHOW TABLES LIKE 'forum_categories'";

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

   $_SESSION['message4'] = '<div class="alert alert-primary" role="alert">Table is not installed! So, installing.</div>';

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

   $_SESSION['message3'] = '<div class="alert alert-warning" role="alert">Table was already installed! So, not installing.</div>';

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

   $_SESSION['message2'] = '<div class="alert alert-danger" role="alert">Database was already installed! You can begin by visiting <a href="index.php" class="alert-link">OpenForum</a> now.</div> ';

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

   $_SESSION['message1'] = '<div class="alert alert-success" role="alert">Database is installed! You can begin by visiting <a href="index.php" class="alert-link">OpenForum</a> now.</div>';

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
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">		
		<title>Install Databse</title>
		<!-- Bootstrap CSS -->
		<link href=\"inc/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
		<!-- Font Awesome CSS -->
		<link href=\"inc/fontawesome/css/all.min.css\" rel=\"stylesheet\">   
		</head>
		<body>
		<!-- Navbar -->
		<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
		<div class=\"container-fluid\">
		<a class=\"navbar-brand\" href=\"index.php\"><i class=\"fa-solid fa-message\"></i> OpenForum</a>
		<button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		<span class=\"navbar-toggler-icon\"></span>
		</button>
		<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
		<ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
		<li class=\"nav-item\">
		<a class=\"nav-link active\" aria-current=\"page\" href=\"index.php\">Categories</a>
		</li>
		<li class=\"nav-item\">
		<a class=\"nav-link\" href=\"addcategory.php\">Add Category</a>
		</li>
		</div>
		</div>
		</nav>
		<div class=\"container\">		
        <div class=\"row\">		
        <!-- LIGHT SWITCH -->
		<div class=\"d-flex\">
		<div class=\"form-check form-switch ms-auto mt-3 me-3\">
		<label class=\"form-check-label ms-3\" for=\"lightSwitch\">
		<svg
		xmlns=\"http://www.w3.org/2000/svg\"
		width=\"25\"
		height=\"25\"
		fill=\"currentColor\"
		class=\"bi bi-brightness-high\"
		viewBox=\"0 0 16 16\">
		<path
		d=\"M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z\"
              />
		</svg>
		</label>
		<input class=\"form-check-input\" type=\"checkbox\" id=\"lightSwitch\" />
		</div>
		</div>		
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-database\"></i> Installation</h1>
        <p>Details about the db install process:</p> 
        <h2><i class=\"fa-solid fa-screwdriver-wrench\"></i> Database Information...</h2>";

        // function install db
        
        install_dbs(); 

		echo"
		</div>
		</div>
		<!-- Footer -->
		<div class=\"container\">
		<footer class=\"bg-light py-3 my-4\">
		<ul class=\"nav justify-content-center border-bottom pb-3 mb-3\">
		<!--
		<li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-secondary\">Link</a></li>
		<li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-secondary\">Link</a></li>
		<li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-secondary\">Link</a></li>
		<li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-secondary\">Link</a></li>
		-->
		</ul>
		<p class=\"text-center text-secondary\">&copy; 2022 OpenForum</p>
		</footer>
		</div>
		<!-- Bootstrap JS -->
		<script src=\"inc/bootstrap/js/bootstrap.bundle.min.js\"></script>
		<!-- Light Switch -->
		<script src=\"inc/switch.js\"></script>		
		</body>
		</html>";

?>
