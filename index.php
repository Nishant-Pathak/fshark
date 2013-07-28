<?php
include_once("include/lib.php");
include_once("include/header.php");
include_once("navbar.php");
?>
<div class="container">
  <h1>Cloud Trace - free and open-source packet analyzer</h1>
  <p>Cloud Trace provides...<br> .</p>
  <form name="uploadCap" enctype="multipart/form-data" ng-controller="uploadCapController" ng-submit="submit()" method="POST" action="upload.php">
    <fieldset>
      <legend>Provide Packet Capture</legend>
      Capture file: <input id="cap" ng-model="cap" name="cap" required type="file" accept="application/vnd.tcpdump.pcap, application/x-gzip">
      <hr />
      <span class="help-block">Upload Network capture files. Now you can upload </br> 
                               gzip compressed and rar files too. We support upload files </br>
                               upto 30 MB .</span>
      <input type="submit" value="Submit" class="btn">
    </fieldset>
  </form>

</div> <!-- /container -->

<?php
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = "Guest";
}
include_once("include/footer.php");
?>
