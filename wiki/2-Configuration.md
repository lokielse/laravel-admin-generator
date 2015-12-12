Configuration 配置
=================

Laravel
----------------------------

### `config/admin.php`
```php
return [
    'bower'     => [
        'directory' => 'bower_components'
    ],
    'namespace' => 'console',
    'instances' => [
        'admin' => [
            'domain' => 'admin.console.example.com',
            'prefix' => '',
            'ng_app' => 'app',
        ]
    ]
];
```

### `app\Http\routes.php`
```
$namespace = config('console.namespace');
$instances = config('console.instances', []);

foreach ($instances as $name => $instance) {

    $attributes = [
        'domain' => $instance['domain'],
        'prefix' => $instance['prefix']
    ];

    Route::group($attributes, function () use ($namespace, $name, $instance) {
        Route::get('/{path?}', function () use ($namespace, $name) {
            return view("{$namespace}/{$name}/app", compact('namespace', 'name'));
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
    var namespace = 'console';
    var instances = [{
        name: 'admin'
    }];

    _.each(instances, function (instance) {
        mix.coffee([
            namespace + '/' + instance.name + '/app.coffee',
            namespace + '/' + instance.name + '/**/**'
        ], elixir.config.get('public.js.outputFolder') + '/' + namespace + '/' + instance.name + '/app.js');

        mix.sass([namespace + '/' + instance.name + '/app.sass'], elixir.config.get('public.css.outputFolder') + '/' + namespace + '/' + instance.name);

        mix.ngTemplateCache('/' + namespace + '/' + instance.name + '/**/*.html', elixir.config.get('public.js.outputFolder') + '/' + namespace + '/' + instance.name, null, {
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
