angular.module('pitectionApp')

.controller('loginController', function($scope,login){
   
    $scope.invalidLogin = true;
    $scope.userLogin = function(){
      login.verify($scope.username, $scope.password, function(result){
          if(result.result){
              
          }else{
              $scope.invalidLogin = false;
              $scope.loginError = "Invalid credentials";
          }
      })
    }

})