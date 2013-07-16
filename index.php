<html><body><h1>Fshark Demo</h1>
<form action="#" method="post" enctype="multipart/form-data">
Capture file: <input type="file" name="cap"><br>
<input type="submit" value="Submit">
</form>

<?php
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
    echo exec("tshark -i - <"."caps/".$file_name." > caps/".$file_name.".txt");
        $lines = file("caps/".$file_name.".txt");
        echo "<table>";
            foreach ($lines as $line_num => $line) {
                        if($line_num > 1) {
                                        echo "<tr>";
                                                    echo "<td>".$line."</td>";
                                                    echo "</tr>";
                                                            }
                            }
        echo "</table>";
        echo exec("rm -rf "."caps/".$file_name."*");

}
?>
</body>
</html>
