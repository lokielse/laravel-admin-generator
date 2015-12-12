app.controller 'PhotoController', ($scope, ngTableParams, User, $uibModal, $timeout)->
  $scope.defaultPhotos = [
    (src: 'http://ww2.sinaimg.cn/bmiddle/6a80ebf7gw1eywq3b91tnj20qd14146m.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/6a80ebf7gw1eywq39y9rqj20qm13s1kx.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6a80ebf7gw1eywq455pzuj216o1s04qr.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6a80ebf7gw1eywq46m1h5j20qh141dmt.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/6a80ebf7gw1eywq4ecewgj216o1s07wi.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/6a80ebf7gw1eywq4fj56hj21410qjwj7.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/652af228gw1eyvoa07jlzj20p00xctiy.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/652af228gw1eyvokatarfj20ku0qcgq6.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/652af228gw1eyvokict85j20kc0qf459.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/6e90f99bgw1eyuxkye0ukj21f424o7rh.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6e90f99bgw1eyuxlcby91j21944y8kjl.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/6e90f99bgw1eyuxksfaecj21111jk4bm.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/6e90f99bgw1eyuxkozc4uj21kw11xqbp.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/6e90f99bgw1eyuxkv3uvoj21kw11xqq6.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6e90f99bgw1eyuxkqprb1j21kw11x119.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6e90f99bgw1eyuxl160qvj21kw11xaw8.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6e90f99bgw1eyuxl4vpjtj21f424o1kx.jpg')
    (src: 'http://ww1.sinaimg.cn/bmiddle/6e90f99bgw1eyuxlf9h1ej21kw11x7hq.jpg')
    (src: 'http://ww3.sinaimg.cn/bmiddle/9cbe82e3gw1eyvzb80ia7j21hn1ocnpf.jpg')
    (src: 'http://ww3.sinaimg.cn/bmiddle/9cbe82e3gw1eyvzbhowztj21hk1qf4qs.jpg')
    (src: 'http://ww3.sinaimg.cn/bmiddle/9cbe82e3gw1eyvzbs4mg2j21hm21fx6t.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/9cbe82e3gw1eyvzayuzz7j21b91nie83.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/005titUvjw1eyvwqmbgasj311h1awb29.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/005titUvjw1eyvwlw3sy1j316o1hc4al.jpg')
    (src: 'http://ww4.sinaimg.cn/bmiddle/005titUvjw1eyvwlv7bjqj311i1awdpg.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/005titUvjw1eyvwm0orm3j311h1cdx6p.jpg')
    (src: 'http://ww2.sinaimg.cn/bmiddle/005titUvjw1eyvwlwxg23j316o1hcala.jpg')
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