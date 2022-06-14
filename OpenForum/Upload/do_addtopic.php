<?php
/*
OpenForum - A basic open forum using bootstrap 5
Authors - Julie Meloni & ic-myXMB
Do Add Topic
This is the do_addtopic.php
*/

// connect db

include("config/connect.php");

doDB();

// check for required fields from the form

if ((!$_POST["topic_owner"]) || (!$_POST["topic_title"]) || (!$_POST["post_text"])) {

	header("Location: addtopic.php");
	exit;

}

// inputs

$_POST["topic_owner"] = htmlspecialchars($_POST["topic_owner"]);
$_POST["topic_title"] = htmlspecialchars($_POST["topic_title"]);
$_POST["topic_description"] = htmlspecialchars($_POST["topic_description"]);
$_POST["post_text"] = htmlspecialchars($_POST["post_text"]);

// create and issue the first query

$add_topic_sql = "INSERT INTO forum_topics (topic_title, topic_description, topic_create_time, topic_owner) VALUES ('".$_POST["topic_title"]."','".$_POST["topic_description"]."', now(), '".$_POST["topic_owner"]."')";

$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

// get the id of the last query

$topic_id = mysqli_insert_id($mysqli);

// create and issue the second query

$add_post_sql = "INSERT INTO forum_posts (topic_id, post_text,post_create_time, post_owner) VALUES ('".$topic_id."', '".$_POST["post_text"]."', now(), '".$_POST["topic_owner"]."')";
	
$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

// close connection to MySQL

mysqli_close($mysqli);

// create nice message for user

$display_block = "<div class=\"alert alert-success\" role=\"alert\">The <strong>".$_POST["topic_title"]."</strong> topic has been created.</div>";


// page title

$title = "New Topic Added";

// add header

include("inc/header.php");

// echo open body container and row

echo "
<body>
<div class=\"container\">		
<div class=\"row\">
";

// add switch

include("inc/switch.php");

echo "
<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-dots\"></i> New Topic Added</h1>
";

// echo block

echo $display_block;

// redirect user to topic

header( "Refresh:1; url= showtopic.php?topic_id=".$topic_id, true, 303);

// echo close container and row

echo "
</div>
</div>
";

// add footer

include("inc/footer.php");

// echo close body and html

echo "
</body>
</html>
";

?>
