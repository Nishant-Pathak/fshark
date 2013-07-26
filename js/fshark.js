angular.module('cloudShark', ['ui.bootstrap']);
function uploadCapController($scope){

  $scope.submit = function(){

  };

}

function navigationbar($scope){
  
}

function explorepkt($scope, $http, $templateCache){
   $scope.method = 'GET';
   $scope.packets = [];
   $scope.alerts = [];
   $scope.filter = undefined;
   $scope.availableFilters = ["arp", "cifs", "dns", "mapi", "smb2"
                             ] ;              // save in alphbatical order only max 5 in aline
   $scope.fetch = function() {
      $scope.code = null;
      $scope.response = null;
      $scope.url = 'nitro.php?cap='+$scope.cap+'&filter='+$scope.filter;
 
      $http({method: $scope.method, url: $scope.url, cache: $templateCache}).
         success(function(data, status) {
            if(data.errorcode == -1){
               $scope.alerts.push({type: "error" ,msg: data.message});
            }
            $scope.status = status;
            $scope.data = data;
            $scope.packets = data.cap;
         }).
         error(function(data, status) {
            $scope.data = data || "Unable to process request.";
            $scope.status = status;
            $scope.alerts.push({type: "error" ,msg: $scope.data});
         });
      };

      $scope.closeAlert = function(index) {
      $scope.alerts.splice(index, 1);
   };

}
