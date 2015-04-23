/**
 * 1415 Lib Tech WordPress Theme - Snowboard Finder - http://www.lib-tech.com
 * Authors: brian.behrens@mervin.com & tony.keller@mervin.com - http://www.mervin.com
 */

(function() {
  'use strict';

  var app = angular.module('boardFinder.snowboard', []);

  app.directive("snowboard", function snowboard() {
    return {
      restrict: 'E',
      scope: { snowboard: '=' },
      replace: true,
      controller: "SnowboardController as snowboardCtrl",
      templateUrl: '/wp-content/themes/1415-Lib-Tech-WordPress-Theme/_/apps/snowboard-finder/results/snowboard.html'
    };
  });

  app.controller('SnowboardController', ['$scope', '$log', 'config', function SnowboardController($scope, $log, config) {
    $scope.name = "SnowboardController";
    $scope.config = config;
    $scope.currentImg = "";
    $scope.currentSku = "";
    // $scope.snowboard ... assigned via directive scope and attribute on directive

    function init() {
      $scope.currentImg = $scope.snowboard.variations[0].colorwayImg[0];
      $scope.currentSku = $scope.snowboard.variations[0].sku;
    }

    function getLink() {
      return $scope.snowboard.link + '?sku=' + $scope.currentSku;
    }

    function updateColorway(url, sku, e) {
      e.preventDefault();
      $scope.currentImg = url;
      $scope.currentSku = sku;
    }

    // set public methods
    $scope.getLink = getLink;
    $scope.updateColorway = updateColorway;

    // call init
    init();
  }]);
}());
