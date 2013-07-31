angular.module('cloudShark', ['ui.bootstrap' , 'ngCookies']);

function uploadCapController($scope){

  $scope.submit = function(){

  };

}

function explorepkt($scope, $http, $templateCache, $cookies){

   $scope.maxPacketsToDisplay = 2000;             // due to browser performance
   $scope.method = 'GET';
   $scope.packets = [];
   $scope.alerts = [];
   $scope.filter = undefined;
   $scope.availableFilters = ["arp", "cifs", "dns", "mapi", "smb2"
                             ] ;              // save in alphbatical order only max 5 in aline

   $scope.pageChanged= function (pageNo) {
      $scope.currentPage = pageNo;
      min = (pageNo - 1) * $scope.maxPacketsToDisplay;
      max = min + $scope.maxPacketsToDisplay;
      if($scope.data.cap == undefined)
         $scope.packets = []; 
      else
         $scope.packets = $scope.data.cap.slice(min, max);
   };

   $scope.setNoOfPages = function () {
      if($scope.data.cap == undefined)
         $scope.noOfPages = 0;
      else
         $scope.noOfPages = Math.ceil($scope.data.cap.length / $scope.maxPacketsToDisplay);
   };

   $scope.cleanPage = function() {
     $scope.packets = [];
     $scope.setNoOfPages();
     $scope.pageChanged(1);
   };

   $scope.fetch = function(file) {

      $scope.alerts = [];                              //delete all earlier alerts
      $scope.ShowSpinner = true;                       //add show spinner

      if(file!= undefined){
        $scope.cap = file;
      }
      $scope.code = null;
      $scope.response = null;
      $scope.url =  'nitro.php?cap='         + $scope.cap
                   +'&filter='               + $scope.filter
                   +'&IsProtocolColorScheme='+ $scope.IsProtocolColorScheme;
 
      $http({method: $scope.method, url: $scope.url, cache: $templateCache}).
         success(function(data, status) {
            if(data.errorcode == -1  || data.cap == undefined){
               msg = data.message;
               if(data.errorcode != -1)
                  msg = "nothing to display !!!";
               $scope.alerts.push({type: "error" ,msg: msg});
            }
            $scope.ShowSpinner = false;
            $scope.status = status;
            $scope.data = data;
            $scope.setNoOfPages();
            $scope.pageChanged(1);
         }).
         error(function(data, status) {
            $scope.ShowSpinner = false;
            $scope.data = data || "Unable to process request.";
            $scope.status = status;
            $scope.alerts.push({type: "error" ,msg: $scope.data});
         }
      );
   };

   $scope.closeAlert = function(index) {
      $scope.alerts.splice(index, 1);
   };

   $scope.defaultFetch = function() {
      $scope.fetch($cookies['lastFile']);
   };
}

