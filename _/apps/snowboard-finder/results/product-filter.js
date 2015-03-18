/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
  'use strict';

  var app = angular.module('boardFinder.productFilter', []);

  app.directive("productFilter", function productFilter() {
    return {
      restrict: 'E',
      bindToController: true,
      controller: "ProductFilterController as productFilterCtrl",
      templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/results/product-filter.html'
    };
  });

  app.controller('ProductFilterController', ['$rootScope', '$scope', '$log', 'user', function ProductFilterController($rootScope, $scope, $log, user) {
    $scope.name = "ProductFilterController";
    $scope.user = user;

    function init() {
      //
    }

    function selectFilter(value) {
      $rootScope.$broadcast('filterSelected', {'filter': $scope.prodFilter.title, 'value': value});
    }

    function getUserValue() {
      var returnValue = "";
      switch($scope.prodFilter.title) {
        case 'Ability':
          returnValue = $scope.user.ability;
          break;
        case 'Terrain':
          returnValue = $scope.user.terrain;
          break;
        case 'Flex':
          returnValue = $scope.user.flex;
          break;
      }
      return returnValue;
    }

    function getSelectTitle() {
      var returnValue = "select";
      if(getUserValue() != "Default") {
        returnValue = "remove";
      }
      return returnValue;
    }

    function resetUserValue() {
      switch($scope.prodFilter.title) {
        case 'Ability':
          $scope.user.ability = "Default";
          break;
        case 'Terrain':
          $scope.user.terrain = "Default";
          break;
        case 'Flex':
          $scope.user.flex = "Default";
          break;
      }
    }

    // set public methods
    $scope.selectFilter = selectFilter;
    $scope.getUserValue = getUserValue;
    $scope.getSelectTitle = getSelectTitle;
    $scope.resetUserValue = resetUserValue;

    // call init
    init();
  }]);
}());
