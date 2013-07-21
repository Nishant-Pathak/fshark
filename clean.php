<?php
include_once("include/header.php");
include_once("navbar.php");
$output;
$error;
exec("rm -rf caps/1*", $output, $error);
if($error != 0)
   echo "Unable to clean !!!";
else
   echo "Everything crystal clear.";

include_once("include/footer.php");
?>
