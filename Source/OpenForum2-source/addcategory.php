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
		<head>
		<title>Add Category</title>
		</head>
		<body>
		<h1>Add Category</h1>
		<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<p><strong>Your E-Mail Address:</strong><br/>
		<input type=\"text\" name=\"category_owner\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Category Title:</strong><br/>
		<input type=\"text\" name=\"category_title\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Category Description:</strong><br/>
		<textarea name=\"category_description\" rows=\"4\" cols=\"40\" wrap=\"virtual\"></textarea>
		<p><strong>Topic Title:</strong><br/>
		<input type=\"text\" name=\"topic_title\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Topic Description:</strong><br/>
		<textarea name=\"topic_description\" rows=\"4\" cols=\"40\" wrap=\"virtual\"></textarea>
		<p><strong>First Post Message:</strong><br/>
		<textarea name=\"post_text\" rows=\"8\" cols=\"40\" wrap=\"virtual\"></textarea>
		<p><input type=\"submit\" name=\"submit\" value=\"Add Category\"></p>
		</form>
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
	<html>
	<head>
	<title>New Category Added</title>
	<body>
	<h1>New Category added</h1>
	<p>The <strong>".$c_title_p."</strong> category has been created.</p>";

	echo $display_block;

	// redirect user to topic
	
	//header("Location: showcategory.php?category_id=".$category_id);
	//exit;
	
    header( "Refresh:3; url= showcategory.php?category_id=".$category_id, true, 303);

    $display_block = "
	</body>
	</html>";

	echo $display_block;

}

?>
