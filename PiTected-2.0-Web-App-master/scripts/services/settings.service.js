angular.module('pitectionApp')

.service('settingsService', function($http){
    this.getSensors = function(callback){
         $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/getPagedLogs.php?log_type=current'
        }).then(function successCallback(response) {
            console.log(response.data);
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
    
    this.editSensor = function(sensorName, sensorID, callback){
        $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/editSystem.php?edit_type=editSensor&id='+sensorID+"&name="+sensorName
        }).then(function successCallback(response) {
            console.log(response.data);
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
    
    this.addSensor = function(sensorName, sensorType, nodeID, callback){
        $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/editSystem.php?edit_type=addSensor&nodeID='+nodeID+"&name="+sensorName+"&sensorType="+sensorType
        }).then(function successCallback(response) {
            console.log(response.data);
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
    
    this.addSensorType = function(sensorTypeName,callback){
        $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/editSystem.php?edit_type=addSensorType&sensorTypeName='+sensorTypeName
        }).then(function successCallback(response) {
            console.log(response.data);
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
   
})