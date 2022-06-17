<?php
/*
OpenForum - A basic open forum
Authors - Julie Meloni & ic-myXMB
Delete Post
This is the delete.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// escape user inputs for security

$post_id = mysqli_real_escape_string($mysqli, $_POST["post_id"]);

// still have to verify topic and post

$verify_sql = "SELECT ft.topic_id, ft.topic_title FROM forum_posts AS fp LEFT JOIN forum_topics AS ft ON fp.topic_id = ft.topic_id WHERE fp.post_id = '".$post_id."'";

$verify_res = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_res) < 1) {

	// this post or topic does not exist

	// redirect

	header("Location: index.php");

	exit;

}

// IF POST

// escape user inputs for security

$post_id = mysqli_real_escape_string($mysqli, $_POST["post_id"]);

// if post_id delete

if (isset($post_id)) {

	$id = (int)$post_id;

	// query

	$delete_post_id_sql = "DELETE FROM forum_posts WHERE post_id = '".$id."'";

	// result

	$delete_post_id_res = mysqli_query($mysqli, $delete_post_id_sql) or die(mysqli_erro($mysqli));

	// IF POST

	// escape user inputs for security

    $topic_id = mysqli_real_escape_string($mysqli, $_POST["topic_id"]);
    $topic_title = mysqli_real_escape_string($mysqli, $_POST["topic_title"]);
    $post_owner = mysqli_real_escape_string($mysqli, $_POST["post_owner"]);

	// create a nice message for the user

	$display_block = "
	<!DOCTYPE html>
	<html lang=\"en\">
	<meta charset=\"UTF-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	<title>Deleted Post in: ".$topic_title."</title>
		<!-- Bootstrap CSS -->
		<link href=\"inc/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
		<!-- Font Awesome CSS -->
		<link href=\"inc/fontawesome/css/all.min.css\" rel=\"stylesheet\">   
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
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i> Deleted Post in: ".$topic_title."</h1>
	    <div class=\"alert alert-success\" role=\"alert\">The post by: <strong>".$post_owner."</strong> has been deleted.</div>";

	echo $display_block;

	// redirect user to topic
	
    header( "Refresh:3; url= showtopic.php?topic_id=".$topic_id, true, 303);

    $display_block = "
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

	echo $display_block;

}

?>
