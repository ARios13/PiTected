/**
 * Created by Rob on 2/12/2016.
 */
angular.module('pitectionApp')

.service('sessionService', function($http, $location){
    var self = this;

    self.checkSession = function($scope){
        $http({
            method: 'GET',
            url: url+ '/PiTected-Web-App/php/getSession.php?username='+$scope.username+"&session="+sessionStorage.getItem('session'),
        }).then(function successCallback(response) {
            if(response.data.result){
               console.log("Session ok");
            }
            else{
                //Kick the user back to the login screen
                $location.path('/');
            }

        }, function errorCallback(response) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
            console.error(response.data);
        });
    }

     self.sessionTimeout = function($scope){
            setTimeout(function(){
                $scope.$apply(function(){
                    $scope.sessionPopup = false;//Open the popup window
                });
            },3000);
    }
    self.destroySession = function(){
        console.log("Destroying your session");
        sessionStorage.removeItem('session');
       $location.path('/');
    }

})
//Service to handle logins for users
    .service('login', function($http,$location,sessionService){
        this.verify = function(username, password, callback){
            $http({
                method: 'GET',
                url: url + '/PiTected-Web-App/php/getUserData.php?username='+username+"&password="+ password,
            }).then(function successCallback(response) {
                console.log(response.data);
                if(response.data.result){
                    // Save data to sessionStorage
                    sessionStorage.setItem('session', response.data.session);
                    sessionStorage.setItem('username', username);
                   $location.path('/dashboard');
                }
                else {
                    //invalid credentials
                   callback(response.data);
                }

            }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });
        }
    })
