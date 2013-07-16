<?php
session_start();
$output;
$error;
exec("rm -rf caps/*", $output, $error);
if($error != 0)
    echo "Unable to clean !!!";
else
    echo "Everything crystal clear.";

?>
