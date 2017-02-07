var editData ;
var app = angular.module('service',[]);
app.controller('serviceController',function($scope,$timeout,$http,$sce){
   $scope.getallservice = function(){
       $http({
                method:'POST',
                url : serverUrl+'dashboard/getallservicedata',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            }).success(function(response){
                console.log(response);
            });
   }
});

