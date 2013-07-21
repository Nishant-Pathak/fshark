function uploadCapController($scope){

  $scope.submit = function(){

  };

}

function navigationbar($scope){
  
}

function explorepkt($scope, $http, $templateCache){
   $scope.method = 'GET';
   $scope.packets = [];
   $scope.fetch = function() {
   $scope.code = null;
   $scope.response = null;
   $scope.url = 'nitro.php?cap='+$scope.cap;
 
   $http({method: $scope.method, url: $scope.url, cache: $templateCache}).
      success(function(data, status) {
         $scope.status = status;
         $scope.data = data;
         $scope.packets = data.cap;
      }).
      error(function(data, status) {
         $scope.data = data || "Unable to process request.";
         $scope.status = status;
    });
  };

}
