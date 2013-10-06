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
        "borivojevic/rescuetime": "1.*"
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

The main entry point of the library is the `RescueTime\Client` class. API methods require to be signed with valid `api_key` parameter which you have to provide as a first argument of the constructor. You can obtain RescueTime API key on [API Key Management][] console page.

``` php
<?php
$Client = new \RescueTime\Client($apiKey);

// Basic example
$activities = $Client->getActivities("rank");

foreach ($activities as $activity) {
    echo $activity->getActivityName();
    echo $activity->getProductivity();
}

// Fetch activities for past week
$activities = $this->Client->getActivities(
    "interval",
    "day",
    null,
    null,
    new \DateTime("-6 day"),
    new \DateTime("today")
);

// Fetch productivity data grouped by activity
$activities = $this->Client->getActivities(
    "interval",
    "day",
    null,
    null,
    new \DateTime("-6 day"),
    new \DateTime("today"),
    "activity"
);

// Fetch productivity data grouped by category
$activities = $this->Client->getActivities(
    "interval",
    "day",
    null,
    null,
    new \DateTime("-6 day"),
    new \DateTime("today"),
    "category"
);
```

You can build more complex queries and filter down the data by providing other query parameters:

``` php
$this->Client->getActivities(
    <perspective>,
    <resolution_time>,
    <restrict_group>,
    <restrict_user>,
    <restrict_begin>,
    <restrict_end>,
    <restrict_kind>,
    <restrict_project>,
    <restrict_thing>,
    <restrict_thingy>
);
```

Each query parameter is explained in more details in official [HTTP Query Interface documentation][]

For a working example of an app build on top of rescuetime-api-php library take a look at [borivojevic/rescuetime-statusboard][].

### Contributing ###

Patches and pull requests are welcome. Take a look at [Contributing guidelines][] for further info.

### Versioning ###

The library uses [Semantic Versioning][]

### Copyright and License ###

The library is licensed under the MIT license.

[RescueTime]: https://www.rescuetime.com
[Composer]: http://getcomposer.org/
[API Key Management]: https://www.rescuetime.com/anapi/manage
[HTTP Query Interface documentation]: https://www.rescuetime.com/anapi/setup/documentation#http
[borivojevic/rescuetime-statusboard]: https://github.com/borivojevic/rescuetime-statusboard
[Semantic Versioning]: http://semver.org/
[Contributing guidelines]: https://github.com/borivojevic/rescuetime-api-php/blob/master/CONTRIBUTING.md