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

  app.controller('ProductFilterController', ['$rootScope', '$scope', '$log', function ProductFilterController($rootScope, $scope, $log) {
    $scope.name = "ProductFilterController";

    function init() {
      //
    }

    function selectFilter(value) {
      $rootScope.$broadcast('filterSelected', {'filter': $scope.prodFilter.title, 'value': value});
    }

    // set public methods
    $scope.selectFilter = selectFilter;

    // call init
    init();
  }]);
}());
