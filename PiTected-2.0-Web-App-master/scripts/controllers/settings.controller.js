angular.module('pitectionApp')

.controller('settingsController', function($scope, settingsService){
    $scope.sensors = [];
    $scope.isValid = true;
    $scope.sensorTypeSubmitted = false;
    
    settingsService.getSensors(function(result){
        $scope.sensors = result;
    });
    
    $scope.updateSensor = function(index, sensorName, sensorID){
        if(sensorName === "" || sensorName === undefined){
           $scope.isValid = false;
        }
        settingsService.editSensor(sensorID, sensorName, function(result){
            
        })
    }

    $scope.addSensor = function(){
    //  settingsService.addSensor($scope.addSensorName, $scope.sensorType, $scope.addSensorNodeID, function(result){
         
    //  })
    console.log($scope.sensorTypeID);
    }
    $scope.addSensorType = function(){
        settingsService.addSensorType($scope.addSensorTypeName, function(result){
            if(result.result){
                 $scope.sensorTypeSubmitted = true;
            }
        })
       
    }
})