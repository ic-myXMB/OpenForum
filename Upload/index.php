<?php
/*
OpenForum - A basic open forum using bootstrap 5
Authors - Julie Meloni & ic-myXMB
Topic List
This is the index.php
*/

// connect db

include("config/connect.php");

doDB();

// gather the topics

$get_topics_sql = "SELECT topic_id, topic_title, topic_description, DATE_FORMAT(topic_create_time,  '%b %e %Y at %r') aS fmt_topic_create_time, topic_owner FROM forum_topics ORDER BY topic_create_time DESC";

$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1) {

	// there are no topics, so say so

	$display_block = "<div class=\"alert alert-danger\" role=\"alert\">No topics exist.</div>";

} else {

	// create the display string

	$display_block = "
	<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\" class=\"table table-responsive\">
	<tr>
	<th>TOPIC TITLE</th>
	<th class=\"text-center\"># of POSTS</th>
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
		<td class=\"align-middle\" align=\"center\">".$num_posts."</td>
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

?>
<?php

// page title

$title = "Topics in My Forum";

// include header

include("inc/header.php");

?>

<body>

<?php

// add switch

include("inc/switch.php");

?>

<div class="container">		
<div class="row">
<h1 class="mt-1"><i class="fa-solid fa-comment-dots"></i> Forum Topics</h1>
<p>Showing topics for the <strong>Forum</strong>:</p>
<?php

// display block

 echo $display_block; 

 ?>

<p><a class="btn btn-primary" href="addtopic.php" role="button"><i class="fa-solid fa-plus"></i> Add Topic</a></p>
</div>
</div>

<?php

// add footer

include("inc/footer.php");

?>

</body>
</html>
