app.controller 'UserEditModalController', ($scope, $modalInstance, user, readonly, User)->
  $scope.user = user
  $scope.readonly = readonly

  $scope.ok = ->
    User.update(user).$promise.then((result)->
      console.log(result)
#      $defer.resolve(result.data)
    )

    $modalInstance.close($scope.user)

  $scope.cancel = ->
    $modalInstance.close()
