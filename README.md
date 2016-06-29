[![Build Status](https://travis-ci.org/borivojevic/rescuetime-api-php.png?branch=master)](https://travis-ci.org/borivojevic/rescuetime-api-php)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/borivojevic/rescuetime-api-php/badges/quality-score.png?s=688bb689ba8d980c06526783e139e8efc13528c5)](https://scrutinizer-ci.com/g/borivojevic/rescuetime-api-php/)
[![Code Coverage](https://scrutinizer-ci.com/g/borivojevic/rescuetime-api-php/badges/coverage.png?s=0e6ffb9bfbbf1e31aa7fd2ff8d19657eda881129)](https://scrutinizer-ci.com/g/borivojevic/rescuetime-api-php/)
[![Latest Stable Version](https://poser.pugx.org/borivojevic/rescuetime/v/stable.png)](https://packagist.org/packages/borivojevic/rescuetime)

rescuetime-api-php
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
        "borivojevic/rescuetime": "2.*"
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

use RescueTime\RequestQueryParameters as Params;
use RescueTime\Client;

$client = new Client($apiKey);

// Basic example
$activities = $client->getActivities(new Params(['perspective' => 'rank']));

foreach ($activities as $activity) {
    echo $activity->getActivityName();
    echo $activity->getProductivity();
}

// Fetch activities for past week
$activities = $client->getActivities(
    new Params([
        'perspective' => 'interval',
        'resolution_time' => 'day',
        'restrict_begin' => new \DateTime("-6 day"),
        'restrict_end' => new \DateTime("today")
    ])
);

// Fetch productivity data grouped by activity
$activities = $client->getActivities(
    new Params([
        'perspective' => 'interval',
        'resolution_time' => 'day',
        'restrict_begin' => new \DateTime("-6 day"),
        'restrict_end' => new \DateTime("today"),
        'restrict_kind' => 'activity'
    ])
);

// Fetch productivity data grouped by category
$activities = $client->getActivities(
    new Params([
        'perspective' => 'interval',
        'resolution_time' => 'day',
        'restrict_begin' => new \DateTime("-6 day"),
        'restrict_end' => new \DateTime("today"),
        'restrict_kind' => 'category'
    ])
);

// Fetch daily productivity report data for past two weeks
$daily_summary = $client->getDailySummary();

foreach ($daily_summary as $day_summary) {
    echo $day_summary->getTotalDurationFormatted();
    echo $day_summary->getVeryDistractingHours();
    echo $day_summary->getVeryDistractingDurationFormatted();
}
```

You can build more complex queries and filter down the data by providing other query parameters:

``` php
$client->getActivities(
    new Params([
        "perspective" => <rank|interval|member>,
        "resolution_time" => <month|week|day|hour>,
        "restrict_group" => <group name>,
        "restrict_user" => <user name/user email>,
        "restrict_begin" => <\DateTime>,
        "restrict_end" => <\DateTime>,
        "restrict_kind" => <category|activity|productivity|document>,
        "restrict_project" => <project name>,
        "restrict_thing" => <category name/activity name/overview name>,
        "restrict_thingy" => <document name/activity name>
    ])
);
```

Each query parameter is explained in more details in official [HTTP Query Interface documentation][].

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
