<?php
/*
OpenForum - A basic open forum using bootstrap 5
Authors - Julie Meloni & ic-myXMB
Show Topic
This is the showtopic.php
*/

// connect db

include("config/connect.php");

doDB();

// check for required info from the query string

if (!isset($_GET["topic_id"])) {

	header("Location: index.php");
	exit;

}

// verify the topic exists

$verify_topic_sql = "SELECT topic_title FROM forum_topics WHERE topic_id = '".$_GET["topic_id"]."'";

$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) {

	// this topic does not exist

	$display_block = "<div class=\"alert alert-danger\" role=\"alert\">You have selected an invalid topic.<br/>
	Please <a href=\"index.php\">try again</a>.</div>";

} else {

	// get the topic title

	while ($topic_info = mysqli_fetch_array($verify_topic_res)) {

		$topic_title = stripslashes($topic_info['topic_title']);

	}

	// gather the posts

	$get_posts_sql = "SELECT post_id, post_text, DATE_FORMAT(post_create_time, '%b %e %Y at %r') AS fmt_post_create_time, post_owner FROM forum_posts WHERE topic_id = '".$_GET["topic_id"]."' ORDER BY post_create_time ASC";
	
	$get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));

	// create the display string

	$display_block = "    <p>Showing posts for the <strong>".$topic_title."</strong> topic:</p>
	<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\" class=\"table table-responsive\">
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

	 	$display_block .= "
		<tr>
		<td width=\"35%\" valign=\"top\">".$post_owner."<br/>[".$post_create_time."]</td>
		<td width=\"65%\" valign=\"top\">".$post_text."<br/><br/>
		<a class=\"btn btn-outline-secondary btn-sm float-end\" href=\"replytopost.php?post_id=".$post_id."\" role=\"button\"><strong><i class=\"fa-solid fa-reply\"></i> REPLY TO POST</strong></a></td>
		</tr>";

	}

	// free results

	mysqli_free_result($get_posts_res);
	mysqli_free_result($verify_topic_res);

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "
	</table>";

}

// topic title if empty

if (empty($topic_title)) {

  $topic_title = '';

}

// page title

$title = "Posts in ".$topic_title." Topic";

// add header

include("inc/header.php");

// echo body open container row

echo "
<body>
<div class=\"container\">		
 <div class=\"row\">
";

// add switch

include("inc/switch.php");

// echo h1

echo "<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i> Posts in Topic</h1>
";

// echo display block

echo $display_block; 

// echo button and close container / row

echo "
	<p><a class=\"btn btn-primary\" href=\"index.php\" role=\"button\"><i class=\"fa-solid fa-list\"></i> Topic List</a></p>
 </div>
</div>
";

// add footer

include("inc/footer.php");

// echo closing body and html

echo "
</body>
</html>
";

?>
