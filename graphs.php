<?php
include_once("include/lib.php");
include_once("include/headangular.php");
include_once("include/header.php");
include_once("navbar.php");
?>
<div class="container" ng-controller="graphs" ng-init="defaultPlot()">
<form>
  <fieldset>
    <legend>Config Ploting</legend>
    <div class="form-group">
      <label for="cap">Capture File:</label>
      <select type="text" class="form-control" ng-model="cap" id="cap" >
<?
   exec("ls caps | grep -v __ 2>&1 ", $output , $error);
   if($error == 0)
      foreach($output as $fileName){
?>
        <option><?echo $fileName;?></option>
<?
   }
?>
     </select>
    </div>
    <div class="form-group">
      <label for="filter">Filter</label>
      <input type="text" class="form-control" ng-model="filter" id="filter" >
    </div>
    <div class="form-group">
      <label for="xaxis">On X-Axis</label>
      <select type="text" class="form-control" ng-model="xaxis" id="xaxis" >
        <option>Packet</option>
      </select>
    </div>
    <div class="form-group">
      <label for="yaxis">On Y-Axis</label>
      <select type="text" class="form-control" ng-model="yaxis" id="yaxis">
        <option>Time</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default" ng-click="fetchAndPlot()">Submit</button>
  </fieldset>
  </form>
  <div id="graphs">
  </div>
  <div class="spinner" ng-show="ShowSpinner"> </div>
</div>
<?
include_once("include/footer.php");
?>
