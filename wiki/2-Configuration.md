Configuration 配置
=================

Laravel
----------------------------

### `config/admin.php`
```php
return [
    'bower'     => [
        'directory' => public_path('bower_components')
    ],
    'instances' => [
        'default' => [
            'domain' => 'dev.admin.example.com',
            'prefix' => '',
            'ng_app' => 'app',
        ],
    ]
];
```

### `app\Http\routes.php`
```
$instances = config('admin.instances');

foreach ($instances as $name => $instance) {
    Route::group([
        'domain' => $instance['domain'],
        'prefix' => $instance['prefix']
    ], function () use ($name, $instance) {
        Route::get('/{path?}', function () use ($name, $instance) {
            return view("admin/{$name}/app", compact('name', 'instance'));
        });
    });
}
```


### Gulp `gulpfile.js`
----------------------------

```javascript
var elixir = require('laravel-elixir');
var _ = require('underscore');
require('laravel-elixir-ngtemplatecache');

elixir(function (mix) {
    var instances = [{
        name: 'default'
    }];

    _.each(instances, function (instance) {
        mix.coffee([
            'admin/' + instance.name + '/app.coffee',
            'admin/' + instance.name + '/**/**'
        ], elixir.config.get('public.js.outputFolder') + '/admin/' + instance.name + '/app.js');

        mix.sass(['admin/' + instance.name + '/app.sass'], elixir.config.get('public.css.outputFolder') + '/admin/' + instance.name);

        mix.ngTemplateCache('/admin/' + instance.name + '/**/*.html', elixir.config.get('public.js.outputFolder') + '/admin/' + instance.name, null, {
            templateCache: {
                standalone: true
            },
            htmlmin: {
                collapseWhitespace: true,
                removeComments: true
            }
        });
    });
});
```
