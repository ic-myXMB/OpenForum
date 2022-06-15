<?php
/*
OpenForum2 - A basic open forum
Authors - Julie Meloni & ic-myXMB
Show Category
This is the showcategory.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// check for required info from the query string

// IF GET

$c_id_g = $_GET["category_id"];

if (!isset($c_id_g)) {

    // redirect

	header("Location: index.php");
	exit;

}

// verify the category exists

$verify_category_sql = "SELECT category_title FROM forum_categories WHERE category_id = '".$c_id_g."'";

$verify_category_res =  mysqli_query($mysqli, $verify_category_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_category_res) < 1) {

	// this category does not exist

	$display_block = "<p><em>You have selected an invalid category.<br/>
	Please <a href=\"index.php\">try again</a>.</em></p>";

} else {

	// get the category title

	while ($category_info = mysqli_fetch_array($verify_category_res)) {
		$category_title = stripslashes($category_info['category_title']);

	}

	// gather the topics

	$get_topics_sql = "SELECT topic_id, topic_title, topic_description, DATE_FORMAT(topic_create_time, '%b %e %Y at %r') AS fmt_topic_create_time, topic_owner FROM forum_topics WHERE category_id = '".$c_id_g."' ORDER BY topic_create_time ASC";
	
	$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

	// create the display string

		$display_block = "
		<p>Showing topics for the <strong>".$category_title."</strong> category:</p>
		<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\" class=\"table table-responsive\">
		<tr>
		<th>TOPIC</th>
		<th class=\"text-center\">POSTS</th>
		</tr>";

	while ($topics_info = mysqli_fetch_array($get_topics_res)) {

		$topic_id = $topics_info['topic_id'];
		$topic_title = stripslashes($topics_info['topic_title']);		
		$topic_description = nl2br(stripslashes($topics_info['topic_description']));
		$topic_create_time = $topics_info['fmt_topic_create_time'];
		$topic_owner = stripslashes($topics_info['topic_owner']);


		// get number of posts

		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE topic_id = '".$topic_id."'";
		
		$get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
			$num_posts = $posts_info['post_count'];
		}

		// add to display

		$display_block .= "
		<tr>
		<td><a href=\"showtopic.php?topic_id=".$topic_id."\"><strong>".$topic_title."</strong></a><br/>
		".$topic_description."<br/>
		Created on ".$topic_create_time." by ".$topic_owner."</td>
		<td class=\"align-middle\" align=\"center\">".$num_posts."</td>
		</tr>";
	}

	// free results

	mysqli_free_result($get_topics_res);
	mysqli_free_result($get_num_posts_res);
	mysqli_free_result($verify_category_res);

	//echo $_GET["category_id"];

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "</table>";
}

// if empty
if (empty($category_title)) {
	$category_title = '';
}

// if empty
if (empty($c_id_g)) {
	$c_id_g = '';
}

	    // echo page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">		
		<title>Topics in: ".$category_title."</title>
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
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i> Topics in: ".$category_title."</h1>";
        
        echo $display_block;

		echo"
		<div class=\"d-flex\">
		<p><a class=\"btn btn-primary m-1\" href=\"index.php\" role=\"button\"><i class=\"fa-solid fa-list\"></i> Category List</a></p>		
		<p><a class=\"btn btn-primary m-1\" href=\"addtopic.php?category_id=".$c_id_g."\" role=\"button\"><i class=\"fa-solid fa-plus\"></i> Add Topic</a></p>
		</div>
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

