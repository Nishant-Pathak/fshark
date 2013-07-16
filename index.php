<?php
namespace fshark;
include_once("include/lib.php");
include_once("include/header.php");
?>

<h1>Fshark Demo</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
Capture file: <input type="file" name="cap"><br>
<input type="submit" value="Submit">
</form>

<?php
if(!isset($_SESSION['user'])){
    session_start();
    $_SESSION['user'] = "Guest";
}
include_once("include/footer.php");
?>
