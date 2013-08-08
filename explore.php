<?php
namespace fshark;
include_once("include/headangular.php");
include_once("include/header.php");
include_once("navbar.php");

?>
   <div ng-controller="explorepkt" ng-init="defaultFetch()" class="container">
    <form class="form-inline">
      Capture Files: <select ng-model="cap">
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
      Filter: <input type="text" ng-model="filter" typeahead="filter for filter in availableFilters | filter:$viewValue">
      Packet Coloring Enable: <input type="checkbox" ng-model="IsProtocolColorScheme">
      <button class="btn" ng-click="fetch()">Filter</button>
      </form>
      <hr />
      <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
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
    <tr ng-style="{'background-color':packet.color}"  ng-repeat="packet in packets" ng-show="!ShowSpinner" >
      <td>{{packet.number}}</td>
      <td>{{packet.time}}</td>
      <td>{{packet.src}}</td>
      <td>{{packet.dst}}</td>
      <td>{{packet.proto}}</td>
      <td>{{packet.length}}</td>
      <td>{{packet.info}}</td>
      </tr>
    </table>
      <div class="spinner" ng-show="ShowSpinner"> </div>
    </div>    <!--  main div ends here -->
<?
include_once("include/footer.php");
?>
