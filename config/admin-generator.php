<?php

return [
    'bower'          => [
        'directory' => 'bower_components'
    ],
    'namespace'      => 'console',
    'templates_path' => base_path('resources/admin-templates'),
    'instances'      => [
        'admin' => [
            'engine'    => 'admin-lte',
            'domain'    => 'admin.console.example.com',
            'prefix'    => '',
            'ng_app' => 'app',
        ]
    ]
];