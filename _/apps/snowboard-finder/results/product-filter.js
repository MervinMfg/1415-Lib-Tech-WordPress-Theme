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

  app.controller('ProductFilterController', ['$scope', '$log', function ProductFilterController($scope, $log) {
    $scope.name = "ProductFilterController";
    $scope.currentImg = "";
    $scope.currentSku = "";

    function init() {
      $log.log('product filter');
    }

    // set public methods
    // $scope.getLink = getLink;

    // call init
    init();
  }]);
}());
