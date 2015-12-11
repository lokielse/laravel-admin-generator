Installation 安装
================

Laravel
------

```bash
composer require lokielse/laravel-admin:~1.0.0
```

### `config/app.php`
```php
'providers' => [
    Lokielse\Admin\AdminServiceProvider::class
]
```

### Publish config first
```bash
php artisan vendor:publish --provider="Lokielse\Admin\AdminServiceProvider" --tag="config"
```

NPM
---
```bash
npm install laravel-elixir-ng-templates@^0.1.2 --save
npm install underscore --save
```

Bower
-----
```bash
bower install startbootstrap-sb-admin-2#~1.0.7 --save
bower install ng-table#~1.0.0 --save
bower install angular-bootstrap#^0.14.0 --save
bower install html5shiv respond --save
bower install angular-resource#~1.4.0 --save
bower install angular-ui-router#~0.2.15 --save
bower install angular-masonry --save
```

