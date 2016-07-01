Generation
==========

### Create a new instance named `admin`
```
php artisan admin:new admin
```

### Create a new entity `post` for the `admin-demo` instance
```
php artisan admin:entity:new post admin-demo
```
use `template` option for this
```
php artisan admin:entity:new post admin-demo --template=box
```
use multiple `template` option for this
```
php artisan admin:entity:new post admin-demo --template=api,box,edit-modal
```

## Native templates

- api
- box
- table
- edit-modal

more options use `php artisan admin:entity:new -h`

## Generate assets
```
gulp default
gulp watch
```