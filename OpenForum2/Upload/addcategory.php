<?php
/*
OpenForum - A basic open forum
Authors - Julie Meloni & ic-myXMB
Add Category
This is the addcategory.php
*/
// connect db

// include

include("config/connect.php");

// do DB

doDB();

// check to see if we're showing the form or adding the post

// do_page ! = $_POST or = $_POST

$do_page = $_POST;

if (!$do_page) {
        
        // echo form page
	
		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">		
		<head>
		<title>Add Category</title>
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
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-medical\"></i> Add Category</h1>
		<form class=\"was-validated\" method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<div class=\"mb-3\">
		<label for=\"FormControlInputEmail\" class=\"form-label\">Email address:</label>
		<input id=\"FormControlInputEmail\" class=\"form-control\" type=\"text\" name=\"category_owner\" maxlength=\"150\" placeholder=\"name@example.com\" required>
        <div class=\"invalid-feedback\">
        Please enter an email address.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering an email address.
        </div>
		</div>
		<div class=\"mb-3\">
		<label for=\"FormControlInputCategoryTitle\" class=\"form-label\">Category Title:</label>
		<input id=\"FormControlInputCategoryTitle\" class=\"form-control\" type=\"text\" name=\"category_title\" maxlength=\"150\" placeholder=\"Required\" required>
        <div class=\"invalid-feedback\">
        Please enter a category title
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering a category title.
        </div>		
		</div>
		<div class=\"mb-3\">
		<label for=\"FormControlTextareaCategoryDescription\" class=\"form-label\">Category Description:</label>
		<textarea id=\"FormControlTextareaCategoryDescription\" class=\"form-control\" name=\"category_description\" rows=\"4\" placeholder=\"Required\" required></textarea>
        <div class=\"invalid-feedback\">
        Please enter a category description.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering a category description
        </div>		
		</div>
		<div class=\"mb-3\">
		<label for=\"FormControlInputTopicTitle\" class=\"form-label\">Topic Title:</label>
		<input id=\"FormControlInputTopicTitle\" class=\"form-control\" type=\"text\" name=\"topic_title\" maxlength=\"150\" placeholder=\"Required\" required></p>
        <div class=\"invalid-feedback\">
        Please enter a topic title.
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
		<p><button class=\"btn btn-primary\" type=\"submit\"><i class=\"fa-solid fa-plus\"></i> Add Category</button></p>
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
		<script src=\"inc/switch.js\"></script>		
		</body>
		</html>";

} 

else if ($do_page) {



	// check for required items from form

	// POST

    // category
    $c_title_p = $_POST["category_title"];
    $c_description_p = $_POST["category_description"];
    $c_owner_p = $_POST["category_owner"];

    // topic
    $t_title_p = $_POST["topic_title"];
    $t_description_p = $_POST["topic_description"];

    // post
    $p_text_p = $_POST["post_text"];

	if ((!$c_owner_p) || (!$c_title_p) || (!$c_description_p) || (!$t_title_p) || (!$t_description_p) ||  (!$p_text_p)) {
        
        // redirect
        
		header("Location: addcategory.php");
		exit;
		
	}
    
    // inputs
    
    $c_owner_p = htmlspecialchars($c_owner_p);
	$c_title_p = htmlspecialchars($c_title_p);
	$c_description_p = htmlspecialchars($c_description_p);
	$t_title_p = htmlspecialchars($t_title_p);
    $t_description_p = htmlspecialchars($t_description_p);
    $p_text_p = htmlspecialchars($p_text_p);

    // create and issue the first query

	// add the category

	$add_category_sql = "INSERT INTO forum_categories (category_title, category_description, category_create_time, category_owner) VALUES ('".$c_title_p."', '".$c_description_p."', now(), '".$c_owner_p ."')";
		
	$add_topic_res = mysqli_query($mysqli, $add_category_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

    //$c_id_p = mysqli_insert_id($mysqli);
	$category_id = mysqli_insert_id($mysqli);


    // create and issue the second query

	// add the topic

	$add_category_sql = "INSERT INTO forum_topics (category_id, topic_title, topic_description, topic_create_time, topic_owner) VALUES ('".$category_id."', '".$t_title_p."', '".$t_description_p."', now(), '".$c_owner_p."')";
		
	$add_topic_res = mysqli_query($mysqli, $add_category_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

    //$t_id_p = mysqli_insert_id($mysqli);
    $topic_id = mysqli_insert_id($mysqli);

	// create and issue the third query

	// add the post

	$add_post_sql = "INSERT INTO forum_posts (topic_id, category_id, post_text, post_create_time, post_owner) VALUES ('".$topic_id."', '".$category_id."', '".$p_text_p ."', now(), '".$c_owner_p."')";
		
	$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

	// close connection to MySQL

	mysqli_close($mysqli);

	// create a nice message for the user

	$display_block = "
		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>New Category Added</title>
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
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i> New Category added</h1>
        <div class=\"alert alert-success\" role=\"alert\">The <strong>".$c_title_p."</strong> category has been created.</div>";

	echo $display_block;

		// redirect user to topic
	
		//header("Location: showcategory.php?category_id=".$category_id);
		//exit;
	
		header( "Refresh:3; url= showcategory.php?category_id=".$category_id, true, 303);

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
