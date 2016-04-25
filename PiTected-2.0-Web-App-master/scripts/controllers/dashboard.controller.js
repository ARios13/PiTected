angular.module('pitectionApp')

.controller('dashboardController',function($scope, newsfeedService, $interval){
    $scope.logTypes = {"System": "system", "Sensors": "sensors", "All":"all"};
    $scope.selectedLogType = 'all';
    $scope.newsfeed =[];
    $scope.sensors = [];
    
    newsfeedService.getPagedFeed('current', function(result){
      $scope.sensors = result;
    });
    
    $interval(function(){
      console.log("Udating sensor status");
      newsfeedService.getPagedFeed('current', function(result){
          $scope.sensors = result;
      });
      
      
    } , 10000);
    
    newsfeedService.getPagedFeed($scope.selectedLogType, function(result){
      $scope.newsfeed = result;
    });
    
    $scope.changeNewsFeedType = function(){
      newsfeedService.getPagedFeed($scope.selectedLogType, function(result){
      $scope.newsfeed = result;
    });
    }
    
    $scope.scrollToTop= function(){window.scrollTo(0,0);}
    
    window.onscroll = function() {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
         newsfeedService.getMoreFeed($scope.selectedLogType, function(nextRows){
           if(nextRows.length > 0){
             console.log("loading more results");
             for(i in nextRows){
               $scope.newsfeed.push(nextRows[i]);
             }
           }else{console.log("No more logs left to load");}
          
        })
      }
    };
  
  
})
