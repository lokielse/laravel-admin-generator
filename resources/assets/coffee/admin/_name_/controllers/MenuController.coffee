app.controller 'MenuController', ($scope)->
  $scope.menus = [
    (title: '仪表盘', state: 'dashboard', icon: 'dashboard', menus: [])

    (title: '常规', state: 'dashboard', icon: 'cloud', menus: [
      (title: '用户', state: 'users'),
      (title: '照片', state: 'photos'),
      (title: '二级菜单', menus: [
        (title: '三级菜单1', state: 'users')
        (title: '三级菜单2', state: 'photos')
      ]),
    ])
  ]
