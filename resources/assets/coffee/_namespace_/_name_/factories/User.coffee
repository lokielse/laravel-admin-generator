app.factory 'User', ($resource)->
  $resource('/api/admin/users/:id', {}, (update: (method: 'PUT', params: (id: '@id'))))