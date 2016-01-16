app.controller '_Entity_EditModalController', ($scope, $modalInstance, _entity_, readonly, _Entity_)->
  $scope._entity_ = _entity_
  $scope.readonly = readonly

  $scope.ok = ->
    _Entity_.update(_entity_).$promise.then((result)->
      console.log(result)
    )

    $modalInstance.close($scope._entity_)

  $scope.cancel = ->
    $modalInstance.close()
