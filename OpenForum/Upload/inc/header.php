<?php 
/*
OpenForum - A basic open forum using bootstrap 5
Authors - Julie Meloni & ic-myXMB
Header
This is the header.php
*/

echo "<!DOCTYPE html>
 <html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title> ".$title."</title>
    <!-- Bootstrap CSS -->
    <link href=\"inc/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- Font Awesome CSS -->
    <link href=\"inc/fontawesome/css/all.min.css\" rel=\"stylesheet\">   
  </head>
<!-- Navbar -->
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
  <div class=\"container-fluid\">
    <a class=\"navbar-brand\" href=\"index.php\"><i class=\"fa-solid fa-message\"></i> OpenForum</a>
    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
      <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">
        <li class=\"nav-item\">
          <a class=\"nav-link active\" aria-current=\"page\" href=\"index.php\">Topics</a>
        </li>
        <li class=\"nav-item\">
          <a class=\"nav-link\" href=\"addtopic.php\">Add Topic</a>
        </li>
    </div>
  </div>
</nav>";

?>
