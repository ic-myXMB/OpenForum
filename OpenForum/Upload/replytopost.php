<?php
/*
OpenForum - A basic open forum using bootstrap 5
Authors - Julie Meloni & ic-myXMB
Reply to Post
This is the replytopost.php
*/

// connect db

include("config/connect.php");

doDB();

// check to see if we're showing the form or adding the post

if (!$_POST) {

	// showing the form check for required item in query string

	if (!isset($_GET["post_id"])) {

		header("Location: index.php");
		exit;	

	}

	// still have to verify topic and post

	$verify_sql = "SELECT ft.topic_id, ft.topic_title FROM forum_posts AS fp LEFT JOIN forum_topics AS ft ON fp.topic_id = ft.topic_id WHERE fp.post_id = '".$_GET["post_id"]."'";

	$verify_res = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($verify_res) < 1) {

		// this post or topic does not exist

		header("Location: index.php");
		exit;


	} else {

		// get the topic id and title

		while($topic_info = mysqli_fetch_array($verify_res)) {

			$topic_id = $topic_info['topic_id'];
			$topic_title = stripslashes($topic_info['topic_title']);

		}

        // page title 

		$title = "Post Your Reply in ".$topic_title."";

		// add header

        include("inc/header.php");

        // echo switch

		echo "
		<body>
		<div class=\"container\">
		<div class=\"row\">
        ";
        // add switch

        include("inc/switch.php");
        echo "
		<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-medical\"></i> Post Your Reply in $topic_title</h1>
		<form class=\"was-validated\" method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
		<div class=\"mb-3\">
		<label for=\"FormControlInputEmail\" class=\"form-label\">Email address:</label>
		<input id=\"FormControlInputEmail\" class=\"form-control\" type=\"text\" name=\"post_owner\" placeholder=\"name@example.com\" maxlength=\"150\" required>
		<div class=\"invalid-feedback\">
        Please enter an email address.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering an email address.
        </div> 		
        </div>
        <div class=\"mb-3\">
		<label for=\"FormControlTextareaPostText\" class=\"form-label\">Post Message:</label>
		<textarea id=\"FormControlTextareaPostText\" class=\"form-control\" name=\"post_text\" rows=\"8\" placeholder=\"Required\" required></textarea>
		<div class=\"invalid-feedback\">
        Please enter a post message.
        </div>
        <div class=\"valid-feedback\">
        Thanks for entering a post message.
        </div>  
        </div>
		<input type=\"hidden\" name=\"topic_id\" value=\"$topic_id\">
		<p><button class=\"btn btn-primary\" type=\"submit\"><i class=\"fa-solid fa-plus\"></i> Add Post</button></p>
		</form>
        </div>
        </div>
        ";

        // add footer

        include("inc/footer.php");

        // echo body html close

        echo "
        </body>
        </html>
        ";

	}

	// free result

	mysqli_free_result($verify_res);

	// close connection to MySQL

	mysqli_close($mysqli);

} else if ($_POST) {

	// check for required items from form

	if ((!$_POST["topic_id"]) || (!$_POST["post_text"]) || (!$_POST["post_owner"])) {

		header("Location: index.php");
		exit;
		
	}

	// add the post

	$add_post_sql = "INSERT INTO forum_posts (topic_id, post_text,post_create_time, post_owner) VALUES ('".$_POST["topic_id"]."', '".$_POST["post_text"]."', now(), '".$_POST["post_owner"]."')";
		
	$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

	// close connection to MySQL

	mysqli_close($mysqli);

	// redirect user to topic
	
	header("Location: showtopic.php?topic_id=".$_POST["topic_id"]);
	exit;

}

?>
