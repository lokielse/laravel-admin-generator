app.controller '_TheEntity_Controller', ($scope, ngTableParams, _TheEntity_, $uibModal)->
  $scope.filter =
    _: ''

  $scope._theEntities_ = []
  $scope.pagination =
    total: 1000
    page: 10
    page_size: 25

  $scope.reload = ->
    _TheEntity_.get().$promise.then((result)->
      $scope._theEntities_ = result.data
    , ()->
      console.error('load error')
    )

  $scope.reload()