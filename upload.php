<?php
namespace fShark;
include_once("include/header.php");
$allowedExts = array("pcap");
if(isset($_FILES["cap"])){
    $temp = explode(".", $_FILES["cap"]["name"]);
    $extension = end($temp);
    if ($_FILES["cap"]["error"] > 0)
    {   
        echo "Error: " . $_FILES["cap"]["error"] . "<br>";
    }
    elseif(!in_array($extension, $allowedExts)){
        echo "Not supported file type";
        echo "File name with format ".$extension." not supported";
    }   
    else
    {   
        echo "Upload: " . $_FILES["cap"]["name"] . "<br>";
        echo "Type: " . $_FILES["cap"]["type"] . "<br>";
        echo "Size: " . ($_FILES["cap"]["size"] / 1024) . " kB<br>";
        echo "Stored in: " . $_FILES["cap"]["tmp_name"];
    }
    $tmp_file_name = $_FILES['cap']['tmp_name'];
    $file_name = time().$_FILES["cap"]["name"];
    move_uploaded_file($tmp_file_name, 'caps/'.$file_name);
    $_SESSION['capName'] = $file_name;
    header("Location: explore.php");
    include_once("include/footer.php");
}
?>
