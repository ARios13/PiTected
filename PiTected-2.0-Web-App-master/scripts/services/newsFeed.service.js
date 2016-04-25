/**
 * Created by Rob on 2/25/2016.
 */
angular.module('pitectionApp')

.service('newsfeedService', function($http){
    var self = this;
    var min = 0;
    var max = 10;
    self.getFeed = function(logType, callback){
        $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/getPagedLogs.php?log_type='+ logType
        }).then(function successCallback(response) {
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
    
    self.getPagedFeed = function(logType, callback){
          min = 0;
          max = 10;
        $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/getPagedLogs.php?log_type='+ logType+"&lowLimit="+min+"&highLimit="+max
        }).then(function successCallback(response) {
                        console.log(response.data);
            callback(response.data);

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }
    
    self.getMoreFeed = function(logType, callback){
        min += 10;
        max += 10;
        $http({
            method: 'GET',
            url: url + '/PiTected-Web-App/php/getPagedLogs.php?log_type='+ logType+"&lowLimit="+min+"&highLimit="+max
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