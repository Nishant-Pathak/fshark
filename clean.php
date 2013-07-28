<?php
include_once("include/header.php");
include_once("navbar.php");
$output;
$error;
exec("rm -rf caps/*.pcap* 2>&1", $output, $error);
if($error != 0)
   echo $output;
else
   echo "Everything crystal clear.";

include_once("include/footer.php");
?>
