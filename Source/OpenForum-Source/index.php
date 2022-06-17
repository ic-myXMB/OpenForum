<?php
/*
OpenForum - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
Topic List
This is the index.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// gather the topics

$get_topics_sql = "SELECT topic_id, topic_title, topic_description, DATE_FORMAT(topic_create_time,  '%b %e %Y at %r') aS fmt_topic_create_time, topic_owner FROM forum_topics ORDER BY topic_create_time DESC";

$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1) {

	// there are no topics, so say so

	$display_block = "<p><em>No topics exist.</em></p>";

} else {

	// create the display string

	$display_block = "	
		<p>Showing all topics in the <strong>Forum</strong>:</p>
		<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\">
		<tr>
		<th align=\"left\">TOPIC TITLE</th>
		<th># of POSTS</th>
		</tr>";

	while ($topic_info = mysqli_fetch_array($get_topics_res)) {

		$topic_id = $topic_info['topic_id'];
		$topic_title = stripslashes($topic_info['topic_title']);
		$topic_description = nl2br(stripslashes($topic_info['topic_description']));
		$topic_create_time = $topic_info['fmt_topic_create_time'];
		$topic_owner = stripslashes($topic_info['topic_owner']);

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

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "</table>";

}

	    // echo page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<title>Topics in: My Forum</title>
		</head>
		<body>
		<h1>Topics in: My Forum</h1>";
        
        // echo display
        
        echo $display_block;

		echo"
		<p>Would you like to <a href=\"addtopic.php\">add a topic</a>?</p>
		</body>
		</html>";

?>
