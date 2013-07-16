<?php
namespace fshark;
session_start();
include_once("include/header.php");
?>

<?

$file_name = $_SESSION['capName'];
exec("tshark -i - <"."caps/".$file_name." > caps/".$file_name.".txt", $output , $error);
if($error != 0)
    echo "Unable to open cap file !!!";

$lines = file("caps/".$file_name.".txt");
$colors = array("#ff7f2a", "#ffd332", "#1bae44", "#008fc7",
    "#09c0e3", "#CC5480", "#ef3124", "#ffbe00",
    "#db4c3c", "#c5881c", "#6a93c7", "#386398",
    "#669999", "#993333", "#006600", "#990099",
    "#ff9966", "#99ff99", "#9999ff", "#cc6600",
    "#33cc33", "#cc99ff", "#ff6666", "#99cc66",
    "#009999", "#cc3333", "#9933ff", "#ff0000",
    "#0000ff", "#00ff00", "#ffcc99", "#999999",
    "#ff3333", "#6666ff", "#ffff00", "#000000");

$protoArr = array();


if(count($lines) != 0){
?>
    <table border="1">
    <tr>
      <td><h3>No.</h3></td>
      <td><h3>Time</h3></td>
      <td><h3>Source</h3></td>
      <td><h3>Destination</h3></td>
      <td><h3>Protocol</h3></td>
      <td><h3>Length</h3></td>
      <td><h3>Info</h3></td> 
    </tr>
<?
    foreach ($lines as $line_num => $line) {
        $returnValue = preg_split('/( | -> |->)/', $line, 6, PREG_SPLIT_NO_EMPTY);
        $time = $returnValue[0];
        $src = $returnValue[1];
        $dst = $returnValue[2];
        $proto = $returnValue[3];
        $length = $returnValue[4];
        $info = $returnValue[5];
        if(!in_array($proto, $protoArr))
            array_push($protoArr,$proto);
        $color = $colors[array_search($proto, $protoArr)];
?>
        <tr bgcolor="<?echo $color?>">
          <td><?echo $line_num + 1;?></td>
          <td><?echo $time;?></td>
          <td><?echo $src;?></td>
          <td><?echo $dst;?></td>
          <td><?echo $proto;?></td>
          <td><?echo $length;?></td>
          <td><?echo $info;?></td>
        </tr> 
<?
    }
    echo "</table>";
}
else
    echo "Nothing to display";

include_once("include/footer.php");
?>
