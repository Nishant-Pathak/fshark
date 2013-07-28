<?php
namespace fshark;
include_once("include/header.php");
include_once("navbar.php");

?>
   <div ng-controller="explorepkt" ng-init="defaultFetch()">
      Capture Files: <select ng-model="cap">
<?
   if(isset($_SESSION["caps"]))
      foreach($_SESSION["caps"] as $key => $value){
?>
        <option><?echo $key;?></option>
<?
   }
?>
      </select>
      Filter: <input type="text" ng-model="filter" typeahead="filter for filter in availableFilters | filter:$viewValue">
      <button class="btn" ng-click="fetch()">Filter</button></br>
      <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert><hr />
      <pagination boundary-links="true" on-select-page="pageChanged(page)" num-pages="noOfPages" current-page="currentPage" class="pagination-right" previous-text="'&lsaquo;'" next-text="'&rsaquo;'" first-text="'&laquo;'" last-text="'&raquo;'"></pagination>

    <table class="table table-bordered table-hover table-condensed">
    <tr>
      <th>No.</th>
      <th>Time</th>
      <th>Source</th>
      <th>Destination</th>
      <th>Protocol</th>
      <th>Length</th>
      <th>Info</th>
    </tr>
    <tr ng-style="{'background-color':packet.color}"  ng-repeat="packet in packets">
      <td>{{packet.number}}</td>
      <td>{{packet.time}}</td>
      <td>{{packet.src}}</td>
      <td>{{packet.dst}}</td>
      <td>{{packet.proto}}</td>
      <td>{{packet.length}}</td>
      <td>{{packet.info}}</td>
    </table>
    <div class="spinner" ng-show="ShowSpinner"> </div>
    </div>
<?
include_once("include/footer.php");
?>
