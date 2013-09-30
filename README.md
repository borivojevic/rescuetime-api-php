rescuetime-api-php [![Build Status](https://travis-ci.org/borivojevic/rescuetime-api-php.png?branch=master)](https://travis-ci.org/borivojevic/rescuetime-api-php)
========

PHP wrapper library for [RescueTime][] API

At this point RescueTime API provides single endpoint to fetch detailed and complicated data. The data is read-only through the API.

Initial release of RescueTime API is targeted at bringing developers the prepared and pre-organized data structures already familiar through the reporting views of www.rescuetime.com.
Keep in mind this is a draft interface, and may change in the future. RescueTime do intend to version the interfaces though, so it is likely forward compatible.

### Installation ###

Recommend way to install this package with [Composer][]. Add borivojevic/rescuetime-api-php to your composer.json file.

``` json
{
    "require": {
        "borivojevic/rescuetime-api-php": "1.*"
    }
}
```

To install composer run:

```
curl -s http://getcomposer.org/installer | php
```

To install composer dependences run:

```
php composer.phar install
```

You can autoload all dependencies by adding this to your code:

```
require 'vendor/autoload.php';
```

### Usage ###

``` php
$Client = new \RescueTime\Client($apiKey);
$activities = $Client->getActivities("rank");
```

### What data is returned? ###

TODO ...

### Contributing ###

Patches and pull requests are welcome. Take a look at [Contributing guidelines][] for further info.

### Versioning ###

The library uses [Semantic Versioning][]

### Copyright and License ###

The library is licensed under the MIT license.

[RescueTime]: https://www.rescuetime.com
[Composer]: http://getcomposer.org/
[Semantic Versioning]: http://semver.org/
[Contributing guidelines]: https://github.com/borivojevic/rescuetime-api-php/blob/master/CONTRIBUTING.md