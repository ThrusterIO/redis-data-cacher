# RedisDataCacher Component

[![Latest Version](https://img.shields.io/github/release/ThrusterIO/redis-data-cacher.svg?style=flat-square)]
(https://github.com/ThrusterIO/redis-data-cacher/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)]
(LICENSE)
[![Build Status](https://img.shields.io/travis/ThrusterIO/redis-data-cacher.svg?style=flat-square)]
(https://travis-ci.org/ThrusterIO/redis-data-cacher)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ThrusterIO/redis-data-cacher.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/redis-data-cacher)
[![Quality Score](https://img.shields.io/scrutinizer/g/ThrusterIO/redis-data-cacher.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/redis-data-cacher)
[![Total Downloads](https://img.shields.io/packagist/dt/thruster/redis-data-cacher.svg?style=flat-square)]
(https://packagist.org/packages/thruster/redis-data-cacher)

[![Email](https://img.shields.io/badge/email-team@thruster.io-blue.svg?style=flat-square)]
(mailto:team@thruster.io)

The Thruster RedisDataCacher Component.


## Install

Via Composer

``` bash
$ composer require thruster/redis-data-cacher
```

## Usage

```php
$redis = new \Redis();
$redis->connection('127.0.0.1', 6379);

$redisDriver = new RedisDriver($redis);
$dataCacher = new DataCacher($redisDriver, new FooCacher());
```


## Testing

``` bash
$ composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## License

Please see [License File](LICENSE) for more information.
