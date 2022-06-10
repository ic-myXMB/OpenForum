<?php
/*
OpenForum - A basic open forum using bootstrap 5
Authors - Julie Meloni & ic-myXMB
Add Topic
This is the addtopic.php
*/

// page title

$title = "Add a Topic";

// add header

include("inc/header.php");

// echo add topic page

echo "
<body>
";



// echo add topic

echo "  <div class=\"container\">		
    <div class=\"row\">
  ";

// add switch

include("inc/switch.php");

echo "<h1 class=\"mt-1\"><i class=\"fa-solid fa-comment-medical\"></i> Add a Topic</h1>
<form class=\"was-validated\" method=\"post\" action=\"do_addtopic.php\">
<div class=\"mb-3\">
<label for=\"FormControlInputEmail\" class=\"form-label\">Email address:</label>
<input id=\"FormControlInputEmail\" class=\"form-control\" type=\"text\" name=\"topic_owner\" placeholder=\"name@example.com\" maxlength=\"150\" required/>
    <div class=\"invalid-feedback\">
      Please enter an email address.
    </div>
     <div class=\"valid-feedback\">
      Thanks for entering an email address.
    </div>   
</div>
<div class=\"mb-3\">
<label for=\"FormControlInputTopicTitle\" class=\"form-label\">Topic Title:</label>
<input id=\"FormControlInputTopicTitle\" class=\"form-control\" type=\"text\" name=\"topic_title\" maxlength=\"150\" placeholder=\"Required\" required/>
    <div class=\"invalid-feedback\">
      Please enter a topic title.
    </div>
    <div class=\"valid-feedback\">
      Thanks for entering a topic title.    
    </div>
</div>
<div class=\"mb-3\">
<label for=\"FormControlTextareaTopicDescription\" class=\"form-label\">Topic Description:</label>
<textarea id=\"FormControlTextareaTopicDescription\" class=\"form-control\" name=\"topic_description\" rows=\"4\" placeholder=\"Required\" required></textarea>
    <div class=\"invalid-feedback\">
      Please enter a topic description.
    </div>
    <div class=\"valid-feedback\">
      Thanks for entering a topic description.
    </div>    
</div>
<div class=\"mb-3\">
<label for=\"FormControlTextareaPostText\" class=\"form-label\">First Post Message:</label>
<textarea id=\"FormControlTextareaPostText\" class=\"form-control\" name=\"post_text\" rows=\"8\" placeholder=\"Required\" required></textarea>
    <div class=\"invalid-feedback\">
      Please enter a topic first post message.
    </div>
    <div class=\"valid-feedback\">
      Thanks for entering a topic first post message.
    </div>
</div>
<p><button class=\"btn btn-primary\" type=\"submit\"><i class=\"fa-solid fa-plus\"></i> Add Topic</button></p>
</form>
</div>
</div>";

// add footer

include("inc/footer.php");

// echo body html close

echo "
</body>
</html>
";

?>
