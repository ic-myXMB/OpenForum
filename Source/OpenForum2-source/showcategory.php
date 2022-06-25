<?php
/*
OpenForum2 - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
Show Category
This is the showcategory.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// check for required info from the query string

// IF GET

// escape user inputs for security

$category_id = mysqli_real_escape_string($mysqli, $_GET["category_id"]);

if (!isset($category_id)) {

    // redirect

	header("Location: index.php");

	exit;

}

// verify the category exists

$verify_category_sql = "SELECT category_title FROM forum_categories WHERE category_id = '".$category_id."'";

$verify_category_res =  mysqli_query($mysqli, $verify_category_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_category_res) < 1) {

	// this category does not exist

	$display_block = "<p><em>You have selected an invalid category.<br/>
	Please <a href=\"index.php\">try again</a>.</em></p>";

} else {

	// get the category title

	while ($category_info = mysqli_fetch_array($verify_category_res)) {
		
		$category_title = stripslashes($category_info['category_title']);

	}

	// gather the topics

	$get_topics_sql = "SELECT topic_id, topic_title, topic_description, DATE_FORMAT(topic_create_time, '%b %e %Y at %r') AS fmt_topic_create_time, topic_owner FROM forum_topics WHERE category_id = '".$category_id."' ORDER BY topic_create_time ASC";
	
	$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

	// create the display string

		$display_block = "
		<p>Showing topics for the <strong>".$category_title."</strong> category:</p>
		<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\">
		<tr>
		<th align=\"left\">TOPIC TITLE</th>
		<th># of POSTS</th>
		</tr>";

	while ($topics_info = mysqli_fetch_array($get_topics_res)) {

		$topic_id = $topics_info['topic_id'];
		$topic_title = stripslashes($topics_info['topic_title']);		
		$topic_description = nl2br(stripslashes($topics_info['topic_description']));
		$topic_create_time = $topics_info['fmt_topic_create_time'];
		$topic_owner = stripslashes($topics_info['topic_owner']);

		// get number of posts

		$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE topic_id = '".$topic_id."'";
		
		$get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

		while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {

			$num_posts = $posts_info['post_count'];
		}

		// add to display

		$display_block .= "
		<tr>
		<td><a href=\"showtopic.php?topic_id=".$topic_id."\"><strong>".$topic_title."</strong></a><br/>
		".$topic_description."<br/>
		Created on ".$topic_create_time." by ".$topic_owner."</td>
		<td align=\"center\">".$num_posts."</td>
		</tr>";
	}

	// free results

	mysqli_free_result($get_topics_res);
	mysqli_free_result($get_num_posts_res);
	mysqli_free_result($verify_category_res);

	//echo $_GET["category_id"];

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "</table>";
}

// if empty

if (empty($category_title)) {

	$category_title = '';

}

// if empty

if (empty($category_id)) {

	$category_id = '';

}

	    // echo page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<head>
		<title>Topics in: ".$category_title."</title>
		</head>
		<body>
		<h1>Topics in: ".$category_title."</h1>";
        
        echo $display_block;

		echo"
		<p>Would you like to return to the <a href=\"index.php\">Category List</a>?</p>
		<p>Would you like to <a href=\"addtopic.php?category_id=".$category_id."\">add a topic</a>?</p>
		</body>
		</html>";

?>
