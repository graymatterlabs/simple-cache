# PSR-16 Simple Cache Implementations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/graymatterlabs/simple-cache.svg?style=flat-square)](https://packagist.org/packages/graymatterlabs/simple-cache)
[![Tests](https://github.com/graymatterlabs/simple-cache/actions/workflows/run-tests.yml/badge.svg?branch=master)](https://github.com/graymatterlabs/simple-cache/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/graymatterlabs/simple-cache.svg?style=flat-square)](https://packagist.org/packages/graymatterlabs/simple-cache)

Runtime implementations that satisfy the PSR-16 specification. Currently supported are array, "null-object", and cookie-based implementations.

## Installation

You can install the package via composer:

```bash
composer require graymatterlabs/simple-cache:^1.0
```

## Usage

```php
$cache = new ArrayCache(); // new CookieCache('cookie-name');

$cache->set($key, $value, $ttl); // bool
$cache->setMultiple($values, $ttl); // bool
$cache->get($key, $default); // $value|$default
$cache->getMultiple($keys, $default); // iterator|$default
$cache->delete($key); // bool
$cache->deleteMultiple($keys); // bool
$cache->has($key); // bool
$cache->clear();
```

## Testing

```bash
composer test
```

## Changelog

Please see the [Release Notes](../../releases) for more information on what has changed recently.

## Credits

- [Ryan Colson](https://github.com/ryancco)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
