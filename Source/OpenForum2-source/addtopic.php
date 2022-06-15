<?php
/*
OpenForum2 - (base source) - A basic open forum
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

// do_page ! = $_POST or = $_POST

$do_page = $_POST;

if (!$do_page) {

	// showing the form; check for required item in query string

	// GET

	// category

	$c_id_g = $_GET["category_id"];

	if (!isset($c_id_g)) {

        // redirect

		header("Location: index.php");
		exit;

	}

	// still have to verify the category

	$verify_sql = "SELECT category_id, category_title FROM forum_categories WHERE category_id = '".$c_id_g."'";

	$verify_res = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($verify_res) < 1) {

		// this category does not exist

		header("Location: index.php");
		exit;

	} else {

		// get the category id and title

		while($category_info = mysqli_fetch_array($verify_res)) {
			$category_id = $category_info['category_id'];
			$category_title = stripslashes($category_info['category_title']);
		}

		// echo form page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<head>
		<title>Add Topic in: ".$category_title."</title>
		</head>
		<body>
		<h1>Add Topic in: ".$category_title."</h1>
		<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<p><strong>Your E-Mail Address:</strong><br/>
		<input type=\"text\" name=\"topic_owner\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Topic Title:</strong><br/>
		<input type=\"text\" name=\"topic_title\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Topic Description:</strong><br/>
		<textarea name=\"topic_description\" rows=\"4\" cols=\"40\" wrap=\"virtual\"></textarea>
		<p><strong>First Post Message:</strong><br/>
		<textarea name=\"post_text\" rows=\"8\" cols=\"40\" wrap=\"virtual\"></textarea>
		<input type=\"hidden\" name=\"category_id\" value=\"$category_id\">		
		<p><input type=\"submit\" name=\"submit\" value=\"Add Topic\"></p>
		</form>
		</body>
		</html>";
	}

	// free result

	mysqli_free_result($verify_res);

	// close connection to MySQL

	mysqli_close($mysqli);

} else if ($do_page) {

	// check for required items from form

	// POST

	// category

	$c_id_p = $_POST["category_id"];
    
    // topic

    $t_title_p = $_POST["topic_title"];
    $t_description_p = $_POST["topic_description"];
    $t_owner_p = $_POST["topic_owner"];

    // post

    $p_text_p = $_POST["post_text"];


	if ((!$t_owner_p) || (!$c_id_p) || (!$t_title_p) || (!$t_description_p) || (!$p_text_p)) {

		// redirect

		header("Location: index.php");
		exit;

	}

    // inputs
    
	$t_title_p = htmlspecialchars($t_title_p);
    $t_description_p = htmlspecialchars($t_description_p);
    $p_text_p = htmlspecialchars($p_text_p);		

    // create and issue the first query

	// add the topic

	$add_topic_sql = "INSERT INTO forum_topics (category_id, topic_title, topic_description, topic_create_time, topic_owner) VALUES ('".$c_id_p."', '".$t_title_p."', '".$t_description_p."', now(), '".$t_owner_p."')";
		
	$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

	// topic id

    //$t_id_p =  mysqli_insert_id($mysqli);
    
	$topic_id = mysqli_insert_id($mysqli);

	// create and issue the second query

	// add the post

	$add_post_sql = "INSERT INTO forum_posts (topic_id, category_id, post_text, post_create_time, post_owner) VALUES ('".$topic_id."', '".$c_id_p."', '".$p_text_p."', now(), '".$t_owner_p."')";
		
	$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

	// close connection to MySQL

	mysqli_close($mysqli);

	// create a nice message for the user

	$display_block = "
	<!DOCTYPE html>
	<html lang=\"en\">
	<meta charset=\"UTF-8\">
	<title>New Topic Added</title>
	<body>
	<h1>New Topic added</h1>
	<p>The <strong>".$t_title_p."</strong> topic has been created.</p>";

	echo $display_block;

	// redirect user to topic
	
	//header("Location: showtopic.php?topic_id=".$topic_id);
	//exit;
	
    header( "Refresh:1; url= showtopic.php?topic_id=".$topic_id, true, 303);

    $display_block = "
	</body>
	</html>";

	echo $display_block;

}

?>
