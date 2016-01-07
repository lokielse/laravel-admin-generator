app.factory '_TheEntity_', ($resource)->
  $resource('/api/admin/_the-entities_/:id', {}, (update: (method: 'PUT', params: (id: '@id'))))