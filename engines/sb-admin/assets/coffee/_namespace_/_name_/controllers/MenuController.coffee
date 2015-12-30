app.controller 'MenuController', ($scope)->
  $scope.menus = [
    (title: 'Dashboard', state: 'dashboard', icon: 'dashboard', menus: [])

    (title: 'General', state: '*', icon: 'cloud', menus: [
      (title: 'User', state: 'general.users'),
      (title: 'Photo', state: 'general.photos'),
      (title: '2nd', state: '*', menus: [
        (title: '3rd 1', state: 'general.second.third-one')
        (title: '3rd 2', state: 'general.second.third-two')
      ]),
    ])
  ]
