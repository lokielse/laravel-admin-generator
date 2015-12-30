Generation
==========

### Create a new instance named `admin`
```
php artisan console:new admin
```

### Create a new entity `post` for the `admin` instance
```
php artisan console:entity admin post
```
use `template` option for this
```
php artisan console:entity admin post -t table
```
use multiple `template` option for this
```
php artisan console:entity admin post -t table,edit-modal
```

more options use `php artisan console:entity -h`

## Generate assets
```
gulp default
gulp watch
```