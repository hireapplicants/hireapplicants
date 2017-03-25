var app = angular.module('service',[]);
app.controller('packagelistController',function($scope,$http,$sce){
   $scope.getallservice = function(){
       $http({
                method:'POST',
                url : serverUrl+'common/servicelist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            }).success(function(response){
                $scope.serviceList = response.data[0].service_id;
            });
   };
   $scope.getallservice();
});

