Laravel Admin Generator
=======================

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

An Admin Panel Generator for Laravel 5

You can create one admin panel in few seconds with this package!!!
You can create many admin panel in few seconds with this package!!!

just type `php artisan admin:new my-admin`

## Features

* Fast, very fast
* Few config before boot your admin instance
* Structured already, just focus on your business
* Custom templates yourself
* Integrate with AdminLTE, SBAdmin
* Multiple instances in one laravel support

## Screenshot
![Screenshot](/screenshots/AdminLTE.png "Screenshot")

## Software && Lang

* AngularJs
* Bootstrap
* SB Admin
* AdminLTE
* CoffeeScript
* Sass
* Gulp

## Install

Via Composer

``` bash
$ composer require lokielse/laravel-admin-generator
```

More about this please visit [Installation](docs/1-Installation.md) and [Configuration](docs/2-Configuration.md)

## Usage

Create a new instance named `admin-demo`
```
//create an console demo with AdminLTE
php artisan admin:new admin-demo --engine=admin-lte

//or create an console demo with SB-Admin
php artisan admin:new admin-demo --engine=sb-admin
```

Create a new entity `post` for the instance `admin-demo`
```
php artisan admin:entity:new post admin-demo
```

More usages please visit [Commands](docs/3-Commands.md)


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## Credits

- [Lokielse][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lokielse/laravel-admin-generator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/lokielse/laravel-admin-generator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/lokielse/laravel-admin-generator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/lokielse/laravel-admin-generator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lokielse/laravel-admin-generator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lokielse/laravel-admin-generator
[link-travis]: https://travis-ci.org/lokielse/laravel-admin-generator
[link-scrutinizer]: https://scrutinizer-ci.com/g/lokielse/laravel-admin-generator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/lokielse/laravel-admin-generator
[link-downloads]: https://packagist.org/packages/lokielse/laravel-admin-generator
[link-author]: https://github.com/lokielse
[link-contributors]: ../../contributors
