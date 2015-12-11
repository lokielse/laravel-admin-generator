app.controller 'PhotoController', ($scope, ngTableParams, User, $uibModal, $timeout)->
  $scope.defaultPhotos = [
    (src: 'http://img-36.chongai.in/photos/2015/12/11/73a460d4cb2d2c10.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/517d1df6bc67715a.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/f1497874dea4aeea.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/127c9613743e8967.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/ea23c7a9f323d7bb.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/be2cc6111b9ea547.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/bf6931ce9c4b5952.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/11/f1c97242963556a5.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/30f92c1de7c82ef3.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/ea1c86f02f66d69d.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/ee3ef047b72b81c2.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/38b92093315b3104.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/41b5054d83dd1a4d.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/a7afb7e05455d8c3.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/e336069db56209a4.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/f3af5bffd6e33c8a.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/c85762cb3e4165e1.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/87fa19fd1e5b2a12.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/ff5746a0ae0ca43d.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/18ca766e20d6db0f.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/e3e92c15cc11c3b8.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/f10ecee1e0356213.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/7eb73ecf40bd3b11.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/d3f10415d1d08dc8.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/0c38f735f698d918.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/44a39e84290b36d3.jpg@!fwm-webp')
    (src: 'http://img-36.chongai.in/photos/2015/12/10/9c40754c7e15fda9.jpg@!fwm-webp')
  ]

  $scope.reload = ->
    $scope.photos = []
    $timeout ->
      $scope.photos = $scope.shuffle($scope.defaultPhotos)

  $scope.remove = (photo)->
    index = $scope.photos.indexOf(photo)
    if index > -1
      $scope.photos.splice(index, 1)


  $scope.shuffle = (o) ->
    j = undefined
    x = undefined
    i = o.length
    while i
      j = Math.floor(Math.random() * i)
      x = o[--i]
      o[i] = o[j]
      o[j] = x
    o

  $scope.reload()