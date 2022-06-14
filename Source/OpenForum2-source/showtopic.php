<?php
/*
OpenForum - A basic open forum
Authors - Julie Meloni & ic-myXMB
Show Topic
This is the showtopic.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// check for required info from the query string

// IF GET

// topic

$t_id_g = $_GET["topic_id"];

if (!isset($_GET["topic_id"])) {

    // redirect

	header("Location: index.php");
	exit;

}


// verify the topic exists

// verify topic id exists for the post_id delete form

$verify_topic_id_sql = "SELECT topic_id FROM forum_topics WHERE topic_id = '".$t_id_g."'";

$verify_topic_id_res =  mysqli_query($mysqli, $verify_topic_id_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_id_res) < 1) {

	// this topic does not exist

	$display_block = "<p><em>You have selected an invalid topic.<br/>
	Please <a href=\"index.php\">try again</a>.</em></p>";

} else {

	// get the topic id

	while ($topic_info = mysqli_fetch_array($verify_topic_id_res)) {
		$topic_id = $topic_info['topic_id'];
	}
}

// verify the topic exists

// verify the topic title

$verify_topic_sql = "SELECT topic_title FROM forum_topics WHERE topic_id = '".$t_id_g."'";

$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {

	// this topic does not exist

	$display_block = "<p><em>You have selected an invalid topic.<br/>
	Please <a href=\"index.php\">try again</a>.</em></p>";

} else {

	// get the topic title

	while ($topic_info = mysqli_fetch_array($verify_topic_res)) {

		$topic_title = stripslashes($topic_info['topic_title']);

	}

	// gather the posts

	$get_posts_sql = "SELECT post_id, post_text, DATE_FORMAT(post_create_time, '%b %e %Y at %r') AS fmt_post_create_time, post_owner FROM forum_posts WHERE topic_id = '".$t_id_g."' ORDER BY post_create_time ASC";
	
	$get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));

	// create the display string

		$display_block = "
		<p>Showing all posts for the <strong>".$topic_title."</strong> topic:</p>
		<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\">
		<tr>
		<th>AUTHOR</th>
		<th>POST</th>
		</tr>";

	while ($posts_info = mysqli_fetch_array($get_posts_res)) {

		$post_id = $posts_info['post_id'];
		$post_text = nl2br(stripslashes($posts_info['post_text']));
		$post_create_time = $posts_info['fmt_post_create_time'];
		$post_owner = stripslashes($posts_info['post_owner']);

		// add to display

		//echo $post_id;

	 	$display_block .= "
		<tr>
		<td width=\"35%\" valign=\"top\">".$post_owner."<br/>[".$post_create_time."]</td>
		<td width=\"65%\" valign=\"top\">".$post_text."<br/><br/>
		<a href='replytopost.php?post_id=".$post_id."'><strong>REPLY TO POST</strong></a>
        <a href=\"javascript:void(0);\" onclick=\"document.getElementById('deleteForm').submit();\" role=\"button\"><strong>DELETE POST</strong></a>
		<form id=\"deleteForm\" method=\"POST\" action=\"delete.php?post_id=".$post_id."\">
		<input type=\"hidden\" name=\"topic_id\" value=\"$topic_id\">
		<input type=\"hidden\" name=\"topic_title\" value=\"$topic_title\">		
		<input type=\"hidden\" name=\"post_id\" value=\"$post_id\">	
		<input type=\"hidden\" name=\"post_owner\" value=\"$post_owner\">			
		</td>
		</tr>";

	}
	
	// free results

    mysqli_free_result($verify_topic_id_res);
	mysqli_free_result($get_posts_res);	
	mysqli_free_result($verify_topic_res);

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "</table>";

}

	    // echo page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<title>Posts in: ".$topic_title."</title>
		</head>
		<body>
		<h1>Posts in: ".$topic_title."</h1>";
        
        echo $display_block;

		echo"
		<p>Would you like to return to the <a href=\"index.php\">Category List</a>?</p>
		</body>
		</html>";
		
?>

