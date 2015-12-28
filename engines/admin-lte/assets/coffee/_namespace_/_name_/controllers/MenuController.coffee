app.controller 'MenuController', ($scope)->
  $scope.menus = [
    (title: 'MAIN NAVIGATION', header: true)
    (title: 'Dashboard', state: 'dashboard', icon: 'dashboard', menus: [])
    (title: 'General', icon: 'cloud', menus: [
      (title: 'User', icon: 'circle-o', state: 'general.users'),
      (title: 'Photo', icon: 'circle-o', state: 'general.photos'),
      (title: '2nd', icon: 'circle-o', menus: [
        (title: '3rd 1', icon: 'circle-o', state: 'general.second.third-one')
        (title: '3rd 2', icon: 'circle-o', state: 'general.second.third-two')
      ]),
    ])
  ]
