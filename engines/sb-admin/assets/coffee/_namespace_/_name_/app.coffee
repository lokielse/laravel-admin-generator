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

  .state('users', {
      url: "/users",
      templateUrl: "users.html",
      controller: 'UserController'
    })

  .state('photos', {
      url: "/photos",
      templateUrl: "photos.html",
      controller: 'PhotoController'
    })

  .state('third-one', {
      url: "/third-one",
      templateUrl: "third-one.html",
      controller: 'ThirdOneController'
    })

  .state('third-two', {
      url: "/third-two",
      templateUrl: "third-two.html",
      controller: 'ThirdTwoController'
    })