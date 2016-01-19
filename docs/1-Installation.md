Installation
============

Laravel
------

```bash
composer require lokielse/laravel-admin-generator
```

### `config/app.php`
```php
'providers' => [
    Lokielse\AdminGenerator\AdminGeneratorServiceProvider::class
]
```

### Publish config and templates
```bash
php artisan vendor:publish --provider="Lokielse\AdminGenerator\AdminGeneratorServiceProvider" --tag=config
php artisan vendor:publish --provider="Lokielse\AdminGenerator\AdminGeneratorServiceProvider" --tag=templates
```

NPM
---
```bash
npm install laravel-elixir-ng-templates@^0.1.2 --save
npm install laravel-elixir-ngtemplatecache@^0.2.0 --save
npm install underscore --save
```

Bower
-----
```bash
bower install bower install admin-lte#~2.3.2 --save
bower install startbootstrap-sb-admin-2#~1.0.7 --save
bower install ng-table#~1.0.0 --save
bower install angular-bootstrap#^0.14.0 --save
bower install html5shiv respond --save
bower install angular-resource#~1.4.0 --save
bower install angular-ui-router#~0.2.15 --save
bower install angular-masonry --save
```

