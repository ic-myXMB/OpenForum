<?php
/*
OpenForum2 - (base source) - A basic open forum
Authors - Julie Meloni & ic-myXMB
Category List
This is the index.php
*/

// connect db

// include

include("config/connect.php");

// do DB

doDB();

// gather the categories

$get_categories_sql = "SELECT category_id, category_title, category_description, DATE_FORMAT(category_create_time,  '%b %e %Y at %r') aS fmt_category_create_time, category_owner FROM forum_categories ORDER BY category_create_time DESC";

$get_categories_res = mysqli_query($mysqli, $get_categories_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_categories_res) < 1) {

	// there are no categories, so say so

	$display_block = "<p><em>No categories exist.</em></p>";

} else {

	// create the display string

		$display_block = "
		<p>Showing all categories in the <strong>Forum</strong>:</p>
		<table width=\"100%\" cellpadding=\"3\" cellspacing=\"1\" border=\"1\">
		<tr>
		<th align=\"left\">CATEGORY TITLE</th>
		<th># of TOPICS</th>
		</tr>";

	while ($category_info = mysqli_fetch_array($get_categories_res)) {

		$category_id = $category_info['category_id'];
		$category_title = stripslashes($category_info['category_title']);
		$category_description = nl2br(stripslashes($category_info['category_description']));
		$category_create_time = $category_info['fmt_category_create_time'];
		$category_owner = stripslashes($category_info['category_owner']);

		// get number of topics

		$get_num_topics_sql = "SELECT COUNT(topic_id) AS topic_count FROM forum_topics WHERE category_id = '".$category_id."'";
		
		$get_num_topics_res = mysqli_query($mysqli, $get_num_topics_sql) or die(mysqli_error($mysqli));

		while ($topics_info = mysqli_fetch_array($get_num_topics_res)) {

			$num_topics = $topics_info['topic_count'];

		}

		// add to display

		$display_block .= "
		<tr>
		<td><a href=\"showcategory.php?category_id=".$category_id."\"><strong>".$category_title."</strong></a><br/>
		".$category_description."<br/>
		Created on ".$category_create_time." by ".$category_owner."</td>
		<td align=\"center\">".$num_topics."</td>
		</tr>";
		
	}

	// free results

	mysqli_free_result($get_categories_res);
	mysqli_free_result($get_num_topics_res);

	// close connection to MySQL

	mysqli_close($mysqli);

	// close up the table

	$display_block .= "</table>";
}

	    // echo page

		echo "		<!DOCTYPE html>
		<html lang=\"en\">
		<meta charset=\"UTF-8\">
		<title>Categories in: My Forum</title>
		</head>
		<body>
		<h1>Categories in: My Forum</h1>";
        
        echo $display_block;

		echo"
		<p>Would you like to <a href=\"addcategory.php\">add a category</a>?</p>
		</body>
		</html>";

?>
