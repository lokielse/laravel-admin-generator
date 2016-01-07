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
php artisan admin:entity:new post admin-demo --template=table
```
use multiple `template` option for this
```
php artisan admin:entity:new post admin-demo --template=table,edit-modal
```

more options use `php artisan admin:entity:new -h`

## Generate assets
```
gulp default
gulp watch
```