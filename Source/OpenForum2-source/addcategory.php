<?php
/*
OpenForum2 - (base source) - A basic open forum
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

	// escape user inputs for security

    $category_title = mysqli_real_escape_string($mysqli, $_POST["category_title"]);
    $category_description = mysqli_real_escape_string($mysqli, $_POST["category_description"]);
    $category_owner = mysqli_real_escape_string($mysqli, $_POST["category_owner"]);
    $topic_title = mysqli_real_escape_string($mysqli, $_POST["topic_title"]);
    $topic_description = mysqli_real_escape_string($mysqli, $_POST["topic_description"]);
    $post_text = mysqli_real_escape_string($mysqli, $_POST["post_text"]);

	// check for required items from form

	if ((!$category_owner) || (!$category_title) || (!$category_description) || (!$topic_title) || (!$topic_description) ||  (!$post_text)) {
        
        // redirect
        
		header("Location: addcategory.php");

		exit;
		
	}

	// inputs
	
    $category_owner = htmlspecialchars($category_owner);
	$category_title = htmlspecialchars($category_title);
	$category_description = htmlspecialchars($category_description);
	$topic_title = htmlspecialchars($topic_title);
    $topic_description = htmlspecialchars($topic_description);
    $post_text = htmlspecialchars($post_text);

    // create and issue the first query

	// add the category

	$add_category_sql = "INSERT INTO forum_categories (category_title, category_description, category_create_time, category_owner) VALUES ('$category_title', '$category_description_p', now(), '$category_owner')";
		
	$add_topic_res = mysqli_query($mysqli, $add_category_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

	$category_id = mysqli_insert_id($mysqli);

    // create and issue the second query

	// add the topic

	$add_category_sql = "INSERT INTO forum_topics (category_id, topic_title, topic_description, topic_create_time, topic_owner) VALUES ('$category_id', '$topic_title_p', '$topic_description', now(), '$category_owner')";
		
	$add_topic_res = mysqli_query($mysqli, $add_category_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

    $topic_id = mysqli_insert_id($mysqli);

	// create and issue the third query

	// add the post

	$add_post_sql = "INSERT INTO forum_posts (topic_id, category_id, post_text, post_create_time, post_owner) VALUES ('$topic_id', '$category_id', '$post_text', now(), '$category_owner')";
		
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
	<p>The <strong>".$category_title."</strong> category has been created.</p>";

	echo $display_block;

	// redirect user to topic
	
    header( "Refresh:3; url= showcategory.php?category_id=".$category_id, true, 303);

    $display_block = "
	</body>
	</html>";

	echo $display_block;

}

?>
