<?php
/*
OpenForum - (base source) - A basic open forum
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
		<head>
		<title>Add a Topic</title>
		</head>
		<body>
		<h1>Add a Topic</h1>
		<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<p><strong>Your E-Mail Address:</strong><br/>
		<input type=\"text\" name=\"topic_owner\" size=\"40\" maxlength=\"150\"></p>
		<p><strong>Topic Title:</strong><br/>
		<input type=\"text\" name=\"topic_title\" size=\"40\" maxlength=\"150\"></p>		
		<p><strong>Topic Description:</strong><br/>
		<textarea name=\"topic_description\" rows=\"4\" cols=\"40\" wrap=\"virtual\"></textarea>
		<p><strong>First Post Message:</strong><br/>
		<textarea name=\"post_text\" rows=\"8\" cols=\"40\" wrap=\"virtual\"></textarea>
		<p><input type=\"submit\" name=\"submit\" value=\"Add Topic\"></p>
		</form>
		</body>
		</html>";

} else if ($do_page) {

	// escape user inputs for security

    $topic_title = mysqli_real_escape_string($mysqli, $_POST["topic_title"]);
    $topic_description = mysqli_real_escape_string($mysqli, $_POST["topic_description"]);
    $topic_owner = mysqli_real_escape_string($mysqli, $_POST["topic_owner"]);
    $post_text = mysqli_real_escape_string($mysqli, $_POST["post_text"]);

	// check for required items from form

	if ((!$topic_owner) || (!$topic_title) || (!$topic_description) || (!$post_text)) {
        
        // redirect

		header("Location: addtopic.php");

		exit;

	}

    // inputs
    
	$topic_title = htmlspecialchars($topic_title);
    $topic_description = htmlspecialchars($topic_description);
    $post_text = htmlspecialchars($post_text);

	// create and issue the first query

	$add_topic_sql = "INSERT INTO forum_topics (topic_title, topic_description, topic_create_time, topic_owner) VALUES ('".$topic_title."', '".$topic_description."', now(), '".$topic_owner."')";
		
	$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

	// get the id of the last query

	$topic_id = mysqli_insert_id($mysqli);

	// create and issue the second query

	$add_post_sql = "INSERT INTO forum_posts (topic_id, post_text, post_create_time, post_owner) VALUES ('".$topic_id."', '".$post_text."', now(), '".$topic_owner."')";
		
	$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

	// close connection to MySQL

	mysqli_close($mysqli);

    // create a nice message for user

    $display_block = "
	<!DOCTYPE html>
	<html lang=\"en\">
	<meta charset=\"UTF-8\">
	<head>
	<title>New Topic Added</title>
	</head>
	<body>
	<h1>New Topic added</h1>
    <p>The <strong>".$topic_title."</strong> topic has been created.</p>";

    echo $display_block;

	// redirect user to topic
	
    header( "Refresh:1; url= showtopic.php?topic_id=".$topic_id, true, 303);

    $display_block = "
	</body>
	</html>";

	echo $display_block;

}

?>
