<?php
namespace cloudTrace;
$path = substr($_SERVER['REQUEST_URI'],1);

?>
<div class="navbar navbar-fixed-top" ng-controller="navigationbar">
  <div class="navbar-inner">
    <div class="container">
    <a class="brand" href="/">Cloud Trace</a>
         <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Guest</a>
            </p>
            <ul class="nav">
              <li <?if($path == "") echo "class='active'"; ?>><a href="/">Home</a></li>
              <li <?if($path == "about.php") echo "class='active'"; ?>><a href="/about.php">About</a></li>
              <li <?if($path == "contact.php") echo "class='active'"; ?>><a href="/contact.php">Contact</a></li>
            </ul>
         </div>
    </div>
  </div>
</div>
