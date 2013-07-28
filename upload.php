<?php
namespace fShark;
include_once("include/header.php");
include_once("include/lib.php");

$allowedExts = array("pcap", "pcapng", "gz");
if(isset($_FILES["cap"])){
   $temp = explode(".", $_FILES["cap"]["name"]);
   $extension = end($temp);
   if ($_FILES["cap"]["error"] > 0)
   {   
      echo "Error: " . $_FILES["cap"]["error"] . "<br>";
   }
   elseif(!in_array($extension, $allowedExts)){
      echo "<span>Not supported file type.</br>";
      echo "File name with format ".$extension." not supported</br></span>";
      echo "<a href='/'>Return to home page</a></br>";
      return;
   }   
   else
   {   
      echo "Upload: " . $_FILES["cap"]["name"] . "<br>";
      echo "Type: " . $_FILES["cap"]["type"] . "<br>";
      echo "Size: " . ($_FILES["cap"]["size"] / 1024) . " kB<br>";
      echo "Stored in: " . $_FILES["cap"]["tmp_name"];
   }
   $tmp_file_name = $_FILES['cap']['tmp_name'];
   $file_name = session_id().$_FILES["cap"]["name"];
   if(!isset($_SESSION["caps"])){
      $_SESSION["caps"] = array();
   }
   SetMyCookie("lastFile", $_FILES["cap"]["name"]);
    
   $_SESSION["caps"][$_FILES["cap"]["name"]]  = $file_name;
   move_uploaded_file($tmp_file_name, 'caps/'.$file_name);
   header("Location: explore.php");
}
?>
