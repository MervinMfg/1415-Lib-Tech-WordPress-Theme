/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
  'use strict';

  var app = angular.module('boardFinder.contour', []);

  app.directive("contour", function contour() {
    return {
      restrict: 'E',
      scope: {
        title: '@',
        subtitle: '@',
        image: '@',
        description: '@'
      },
      replace: true,
      controller: "ContourController as contourCtrl",
      templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/why/contour.html'
    };
  });

  app.controller('ContourController', ['$scope', '$log', function ContourController($scope, $log) {
    $scope.name = "ContourController";
    $scope.contourImage = "";

    function init() {
      toggleAnimation(false);
    }

    function toggleAnimation(bool) {
      if (bool) {
        $scope.contourImage = '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/diy/' + $scope.image + '.gif';
      } else {
        $scope.contourImage = '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/img/diy/' + $scope.image + '.png';
      }
    }

    // set public methods
    $scope.toggleAnimation = toggleAnimation;

    // call init
    init();
  }]);
}());
