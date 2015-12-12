<?php

return [
    'bower'          => [
        'directory' => 'bower_components'
    ],
    'namespace'      => 'console',
    'templates_path' => base_path('resources/console-templates'),
    'instances'      => [
        'admin' => [
            'domain' => 'admin.console.example.com',
            'prefix' => '',
            'ng_app' => 'app',
        ]
    ]
];