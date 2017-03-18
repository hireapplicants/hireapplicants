var app = angular.module('service',[]);
app.controller('packagelistController',function($scope,$http,$sce){
   $scope.getallservice = function(){
       $http({
                method:'POST',
                url : serverUrl+'common/servicelist',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            }).success(function(response){
                console.log(response);
            });
   };
   $scope.getallservice();
});

