<?php
/*
OpenForum2 - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
Reply to Post
This is the replytopost.php
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

	// GET

	$p_id_g = $_GET["post_id"];

	// showing the form; check for required item in query string

	if (!isset($p_id_g)) {

		// redirect

		header("Location: index.php");
		exit;

	}

	// still have to verify category id

	$verify_cat_sql = "SELECT ft.category_id FROM forum_posts AS fp LEFT JOIN forum_topics AS ft ON fp.category_id = ft.category_id WHERE fp.post_id = '".$p_id_g."'";

	$verify_cat_res = mysqli_query($mysqli, $verify_cat_sql) or die(mysqli_error($mysqli));


	if (mysqli_num_rows($verify_cat_res) < 1) {

		// this category does not exist

		// redirect

		header("Location: index.php");
		exit;

	}

		// get the category id

		while($topic_info = mysqli_fetch_array($verify_cat_res)) {

			$category_id = $topic_info['category_id'];

		}	

	// still have to verify topic and post

	$verify_sql = "SELECT ft.topic_id, ft.topic_title FROM forum_posts AS fp LEFT JOIN forum_topics AS ft ON fp.topic_id = ft.topic_id WHERE fp.post_id = '".$p_id_g."'";

	$verify_res = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($verify_res) < 1) {

		// this post or topic does not exist

		// redirect

		header("Location: index.php");
		exit;


	} else {

		// get the topic id and title

		while($topic_info = mysqli_fetch_array($verify_res)) {

			$topic_id = $topic_info['topic_id'];
			$topic_title = stripslashes($topic_info['topic_title']);

		}
        
        // echo form page 
        
		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<head>
		<title>Post Reply in: ".$topic_title."</title>
		</head>
		<body>
		<h1>Post Reply in: ".$topic_title."</h1>
		<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<p><strong>Your E-Mail Address:</strong><br/>
		<input type=\"text\" name=\"post_owner\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Post Text:</strong><br/>
		<textarea name=\"post_text\" rows=\"8\" cols=\"40\" wrap=\"virtual\"></textarea>
		<input type=\"hidden\" name=\"topic_id\" value=\"$topic_id\">
		<input type=\"hidden\" name=\"category_id\" value=\"$category_id\">		
		<p><input type=\"submit\" name=\"submit\" value=\"Add Post\"></p>
		</form>
		</body>
		</html>";

	}

	// free result

	mysqli_free_result($verify_cat_res);
	mysqli_free_result($verify_res);

	// close connection to MySQL

	mysqli_close($mysqli);


} else if ($do_page) {

	// check for required items from form

	// POST

	// category

	$c_id_p = $_POST["category_id"];

	// topic

	$t_id_p = $_POST["topic_id"];

	// post

    $p_text_p = $_POST["post_text"];
	$p_owner_p = $_POST["post_owner"];

	if ((!$t_id_p) || (!$c_id_p) || (!$p_text_p) || (!$p_owner_p)) {
        
        // redirect
        
		header("Location: index.php");
		exit;

	}

	// inputs
	
    $p_owner_p = htmlspecialchars($p_owner_p);
	$p_text_p = htmlspecialchars($p_text_p);	

	// add the post

	$add_post_sql = "INSERT INTO forum_posts (topic_id, category_id, post_text, post_create_time, post_owner) VALUES ('".$t_id_p."', '".$c_id_p."', '".$p_text_p."', now(), '".$p_owner_p."')";
		
	$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

	// close connection to MySQL

	mysqli_close($mysqli);

	// redirect user to topic
	
	header("Location: showtopic.php?topic_id=".$t_id_p);
	exit;

}

?>
