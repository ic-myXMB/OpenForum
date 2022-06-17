<?php
/*
OpenForum2 - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
Delete Post
This is the delete.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// post 

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

// if post_id delete

// escape user inputs for security

$post_id = mysqli_real_escape_string($mysqli, $_POST["post_id"]);

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
	<title>Deleted Post in: ".$topic_title."</title>
	<body>
	<h1>Deleted Post in: ".$topic_title."</h1>
	<p>The post by: <strong>".$post_owner."</strong> has been deleted.</p>";

	echo $display_block;

	// redirect user to topic
	
    header( "Refresh:3; url= showtopic.php?topic_id=".$topic_id, true, 303);

    $display_block = "
	</body>
	</html>";

	echo $display_block;

}

?>
