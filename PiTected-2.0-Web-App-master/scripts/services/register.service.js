angular.module('pitectionApp')

.service('registerService', function($http){
    this.getGeneratedPin = function(callback){
         $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/generatePin.php'
        }).then(function successCallback(response) {
            console.log(response.data);
            callback(response.data.pin);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
    
    this.registerUser = function(username, password, pin, systemPassword, callback){
        $http({
            method: 'GET',
            url: url + "/PiTected-Web-App/php/registerUser.php?username="+ username + "&password=" + password +
            "&pin=" + pin + "&passphrase=" + systemPassword
        }).then(function successCallback(response) {
            console.log(response);
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
})