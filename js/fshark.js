function uploadCapController($scope){
  
  $scope.alert;

  $scope.submit = function(){

/*    var _fileName = document.getElementById('cap').value;
    var re = /(?:\.([^.]+))?$/;
    var ext = re.exec(_fileName)[1];
    if(ext != 'pcap'){
      this.addAlert("error", "Please check file extension !!");
      return false;
    }
    else
      this.closeAlert();
  };
*/
  $scope.addAlert = function(_type, _msg) {
    $scope.alert = { type : _type , msg : _msg};
  };

  $scope.closeAlert = function() {
    $scope.alert = {};
  };    
}

