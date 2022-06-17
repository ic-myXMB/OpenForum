<?php
/*
OpenForum - A basic open forum
Authors - Julie Meloni & ic-myXMB
Show Topic
This is the showtopic.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// check for required info from the query string

// IF GET

// escape user inputs for security

$topic_id = mysqli_real_escape_string($mysqli, $_GET["topic_id"]);

if (!isset($topic_id)) {

	// redirect

	header("Location: index.php");

	exit;

}

// verify the topic exists

// verify topic id exists for the post_id delete form

$verify_topic_id_sql = "SELECT topic_id FROM forum_topics WHERE topic_id = '".$topic_id."'";

$verify_topic_id_res =  mysqli_query($mysqli, $verify_topic_id_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_id_res) < 1) {

	// this topic does not exist

	$display_block = "<p><em>You have selected an invalid topic.<br/>
	Please <a href=\"index.php\">try again</a>.</em></p>";

} else {

	// get the topic id

	while ($topic_info = mysqli_fetch_array($verify_topic_id_res)) {

		$topic_id = $topic_info['topic_id'];

	}
}

// verify the topic exists

$verify_topic_sql = "SELECT topic_title FROM forum_topics WHERE topic_id = '".$topic_id."'";

$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {

	// this topic does not exist

	$display_block = "<p><em>You have selected an invalid topic.<br/>
	Please <a href=\"index.php\">try again</a>.</em></p>";

} else {

	// get the topic title

	while ($topic_info = mysqli_fetch_array($verify_topic_res)) {

		$topic_title = stripslashes($topic_info['topic_title']);

	}

	// gather the posts

	$get_posts_sql = "SELECT post_id, post_text, DATE_FORMAT(post_create_time, '%b %e %Y at %r') AS fmt_post_create_time, post_owner FROM forum_posts WHERE topic_id = '".$topic_id."' ORDER BY post_create_time ASC";
	
	$get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));

	// create the display string

	$display_block = "
		<p>Showing all posts for the <strong>".$topic_title."</strong> topic:</p>
		<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\" class=\"table table-responsive\">
		<tr>
		<th>AUTHOR</th>
		<th>POST</th>
		</tr>";

	//echo $topic_id;

	while ($posts_info = mysqli_fetch_array($get_posts_res)) {

		$post_id = $posts_info['post_id'];
		$post_text = nl2br(stripslashes($posts_info['post_text']));
		$post_create_time = $posts_info['fmt_post_create_time'];
		$post_owner = stripslashes($posts_info['post_owner']);

        // remove tags display in post_text

		$post_text = html_entity_decode($post_text);
		
		// add to display

	 	$display_block .= "
		<tr>
		<td width=\"35%\" valign=\"top\">".$post_owner."<br/>[".$post_create_time."]</td>
		<td width=\"65%\" valign=\"top\">".$post_text."<br/><br/>
		<a class=\"btn btn-outline-secondary btn-sm float-end m-1\" href='replytopost.php?post_id=".$post_id."' role=\"button\"><strong><i class=\"fa-solid fa-reply\"></i> REPLY TO POST</strong></a>
        <a class=\"btn btn-outline-secondary btn-sm float-end m-1\" href=\"javascript:void(0);\" onclick=\"document.getElementById('deleteForm').submit();\" role=\"button\"><strong><i class=\"fa-solid fa-xmark\"></i> DELETE POST</strong></a>
		<form id=\"deleteForm\" method=\"POST\" action=\"delete.php?post_id=".$post_id."\" style=\"display:none;\">
		<input type=\"hidden\" name=\"topic_id\" value=\"$topic_id\">
		<input type=\"hidden\" name=\"topic_title\" value=\"$topic_title\">		
		<input type=\"hidden\" name=\"post_id\" value=\"$post_id\">
		<input type=\"hidden\" name=\"post_owner\" value=\"$post_owner\">	
		</td>
		</tr>";

	}

	// free results

    mysqli_free_result($verify_topic_id_res);
	mysqli_free_result($get_posts_res);
	mysqli_free_result($verify_topic_res);

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "</table>";

}

	    // echo page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">	
		<title>Posts in: ".$topic_title."</title>
		<!-- Bootstrap CSS -->
		<link href=\"inc/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
		<!-- Font Awesome CSS -->
		<link href=\"inc/fontawesome/css/all.min.css\" rel=\"stylesheet\">
		<style>
		 img { max-width: 100%; height: 100%; object-fit: cover; } 
         iframe { max-width: 100%; max-height: 100%; object-fit: contain; }
		</style> 		   
		</head>
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
		<a class=\"nav-link active\" aria-current=\"page\" href=\"index.php\">Topics</a>
		</li>
		<li class=\"nav-item\">
		<a class=\"nav-link\" href=\"addtopic.php\">Add Topic</a>
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
		d=\"M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z\" />
		</svg>
		</label>
		<input class=\"form-check-input\" type=\"checkbox\" id=\"lightSwitch\" />
		</div>
		</div>
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i>
		Posts in: ".$topic_title."</h1>";
        
        echo $display_block;

		echo"
		<p><a class=\"btn btn-primary\" href=\"index.php\" role=\"button\"><i class=\"fa-solid fa-list\"></i> Topic List</a></p>
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
		<script src=\"inc/switch.js\"></script>";

?>
