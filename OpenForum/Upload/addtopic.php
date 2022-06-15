<?php
/*
OpenForum - A basic open forum
Authors - Julie Meloni & ic-myXMB
Add Topic
This is the addtopic.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// check to see if we're showing the form or adding the post

// do_page != $_POST or = $_POST

$do_page = $_POST;

if (!$do_page) {

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>Add a Topic</title>
		<!-- Bootstrap CSS -->
		<link href=\"inc/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
		<!-- Font Awesome CSS -->
		<link href=\"inc/fontawesome/css/all.min.css\" rel=\"stylesheet\">  
		<!-- TinyMCE --> 
		<script src=\"inc/tinymce/tinymce.min.js\"></script>
		<script src=\"inc/tinymce/init.js\"></script>
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
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-medical\"></i> Add a Topic</h1>
		<form class=\"was-validated\" method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<div class=\"mb-3\">
		<label for=\"FormControlInputEmail\" class=\"form-label\">Email address:</label>
		<input id=\"FormControlInputEmail\" class=\"form-control\" type=\"text\" name=\"topic_owner\" maxlength=\"150\" placeholder=\"name@example.com\" required>
        <div class=\"invalid-feedback\">
        Please enter an email address.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering an email address.
        </div>
		</div>
		<div class=\"mb-3\">
		<label for=\"FormControlInputTopicTitle\" class=\"form-label\">Topic Title:</label>
		<input id=\"FormControlInputTopicTitle\" class=\"form-control\" type=\"text\" name=\"topic_title\" maxlength=\"150\" placeholder=\"Required\" required>
        <div class=\"invalid-feedback\">
        Please enter a topic title
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering a topic title.
        </div>		
		</div>		
		<div class=\"mb-3\">
		<label for=\"FormControlTextareaTopicDescription\" class=\"form-label\">Topic Description:</label>
		<textarea id=\"FormControlTextareaTopicDescription\" class=\"form-control\" name=\"topic_description\" rows=\"4\" placeholder=\"Required\" required></textarea>
        <div class=\"invalid-feedback\">
        Please enter a topic description.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering a topic description.
        </div>		
		</div>	
		<div class=\"mb-3\">
		<label for=\"FormControlTextareaPostText\" class=\"form-label\">First Post Message:</label>
		<textarea id=\"FormControlTextareaPostText\" class=\"form-control\" name=\"post_text\" rows=\"8\" placeholder=\"Required\" required></textarea>
        <div class=\"invalid-feedback\">
        Please enter a post message.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering a post message.
        </div>		
		</div>	
		<p><button class=\"btn btn-primary\" type=\"submit\"><i class=\"fa-solid fa-plus\"></i> Add Topic</button></p>		
		</form>
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

} else if ($do_page) {

	// POST

	// topic

    $t_title_p = $_POST["topic_title"];
    $t_description_p = $_POST["topic_description"];
    $t_owner_p = $_POST["topic_owner"];

	// post

    $p_text_p = $_POST["post_text"];

	// check for required items from form

	if ((!$t_owner_p) || (!$t_title_p) || (!$t_description_p) || (!$p_text_p)) {
        
        // redirect

		header("Location: addtopic.php");
		exit;

	}

    // inputs
    
	$t_title_p = htmlspecialchars($t_title_p);
    $t_description_p = htmlspecialchars($t_description_p);
    $p_text_p = htmlspecialchars($p_text_p);

	// create and issue the first query

	$add_topic_sql = "INSERT INTO forum_topics (topic_title, topic_description, topic_create_time, topic_owner) VALUES ('".$t_title_p."', '".$t_description_p."', now(), '".$t_owner_p."')";
		
	$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

	$topic_id = mysqli_insert_id($mysqli);

	// create and issue the second query

	$add_post_sql = "INSERT INTO forum_posts (topic_id, post_text, post_create_time, post_owner) VALUES ('".$topic_id."', '".$p_text_p."', now(), '".$t_owner_p."')";
		
	$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

	// close connection to MySQL

	mysqli_close($mysqli);

    // create aa nice message for user

    $display_block = "
		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	    <title>New Topic Added</title>
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
		<a class=\"nav-link active\" aria-current=\"page\" href=\"index.php\">Topic</a>
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
		d=\"M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z\"
              />
		</svg>
		</label>
		<input class=\"form-check-input\" type=\"checkbox\" id=\"lightSwitch\" />
		</div>
		</div>
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i> New Topic added</h1>
		<div class=\"alert alert-success\" role=\"alert\">The <strong>".$t_title_p."</strong> topic has been created.</div>";

    echo $display_block;

	// redirect user to topic
	
    header( "Refresh:1; url= showtopic.php?topic_id=".$topic_id, true, 303);

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
		<script src=\"inc/switch.js\"></script>		
		</body>
		</html>";

	echo $display_block;

}

?>
