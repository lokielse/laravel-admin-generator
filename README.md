Laravel Console
================

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


A console panel generator with AngularJs-Bootstrap-SBAdmin for Laravel 5

## Software environment

* AngularJs
* Bootstrap
* SB Admin
* CoffeeScript
* Sass
* Gulp

## Install

Via Composer

``` bash
$ composer require lokielse/laravel-console
```

More about this please visit [Installation](wiki/1-Installation.md) and [Configuration](wiki/2-Configuration.md)

## Usage

Create a new instance named `admin`
```
php artisan console:new admin
```

Create a new entity `post` for the instance `admin`
```
php artisan console:entity admin post
```

More usages please visit the bellow wiki [Generation](wiki/3-Generation.md)


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## Credits

- [Lokielse][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lokielse/laravel-console.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/lokielse/laravel-console/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/lokielse/laravel-console.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/lokielse/laravel-console.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lokielse/laravel-console.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lokielse/laravel-console
[link-travis]: https://travis-ci.org/lokielse/laravel-console
[link-scrutinizer]: https://scrutinizer-ci.com/g/lokielse/laravel-console/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/lokielse/laravel-console
[link-downloads]: https://packagist.org/packages/lokielse/laravel-console
[link-author]: https://github.com/lokielse
[link-contributors]: ../../contributors
