<?php
namespace cloudTrace;
$path = substr($_SERVER['REQUEST_URI'],1);

?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
           <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
    <a class="brand" href="/">WebShark</a>
         <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Guest</a>
            </p>
            <ul class="nav">
              <li <?if($path == "") echo "class='active'"; ?>><a href="/">Home</a></li>
              <li <?if($path == "explore.php") echo "class='active'"; ?>><a href="/explore.php">Explore</a></li>
              <li <?if($path == "about.php") echo "class='active'"; ?>><a href="/about.php">About</a></li>
              <li <?if($path == "contact.php") echo "class='active'"; ?>><a href="/contact.php">Contact</a></li>
            </ul>
         </div>
    </div>
  </div>
</div>
<div class="container">
