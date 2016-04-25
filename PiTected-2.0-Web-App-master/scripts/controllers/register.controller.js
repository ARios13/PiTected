angular.module('pitectionApp')

.controller('registerController', function($scope, registerService){
    $scope.submitSuccessful = false;
    $scope.showError = false;
    
    registerService.getGeneratedPin(function(pin){
        $scope.generatedPin = pin || "Could not connect";
    });
    
    $scope.submitRegistration = function(){
        registerService.registerUser($scope.username, $scope.password, 
        $scope.generatedPin, $scope.systemPassword, function(res){
            if(res.result){
                $scope.submitSuccessful = true;
            }
            else{
                $scope.showError = true;
                $scope.submitError = res.description;
            }
        });
    }
})