this.app = angular.module('app', ['templates', 'ngResource', 'ui.router', 'ui.bootstrap', 'ngTable', 'wu.masonry'])

this.app.config ($stateProvider, $urlRouterProvider, $locationProvider)->
  $urlRouterProvider.otherwise("/dashboard")
  $locationProvider.html5Mode(true)

  $stateProvider

  .state('dashboard', {
      url: "/dashboard",
      templateUrl: "dashboard.html"
      controller: 'DashboardController'
    })

  .state('general', {
      abstract: true,
      template: "<ui-view>",
    })

  .state('general.users', {
      url: "/users",
      templateUrl: "users.html",
      controller: 'UserController'
    })

  .state('general.photos', {
      url: "/photos",
      templateUrl: "photos.html",
      controller: 'PhotoController'
    })

  .state('general.second', {
      abstract: true,
      template: "<ui-view>",
    })

  .state('general.second.third-one', {
      url: "/third-one",
      templateUrl: "third-one.html",
      controller: 'ThirdOneController'
    })

  .state('general.second.third-two', {
      url: "/third-two",
      templateUrl: "third-two.html",
      controller: 'ThirdTwoController'
    })