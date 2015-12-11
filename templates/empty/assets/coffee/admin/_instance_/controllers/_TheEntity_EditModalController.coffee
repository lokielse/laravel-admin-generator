app.controller '_TheEntity_EditModalController', ($scope, $modalInstance, _theEntity_)->
  $scope._theEntity_ = _theEntity_

  $scope.hello = 'world'

  $scope.ok = ->
    $modalInstance.close($scope._theEntity_)

  $scope.cancel = ->
    $modalInstance.close()
