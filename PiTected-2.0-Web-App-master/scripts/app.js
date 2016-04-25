
var url = "http://localhost";

// var r = /\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/;
// var a = document.location.href;
// var cutURl = a.match(r);
// console.log(cutURl[0]);
// var url = "http://" + cutURl[0];

angular.module('pitectionApp', ['ngRoute', 'ngResource'])

.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
})

.config(function($routeProvider){
    $routeProvider
        .when('/', {
            templateUrl: 'index.html',
            controller: 'loginController'
        })

        .when('/dashboard', {
            templateUrl: 'dashboard.html',
            controller: 'dashboardController'
        })
        
        .when('/settings', {
            templateUrl: 'settings.html',
            controller: 'settingsController'
        })
        
        .when('/register', {
            templateUrl: 'register.html',
            controller:'registerController'
        }
        );
});

